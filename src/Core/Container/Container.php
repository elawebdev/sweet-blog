<?php

declare(strict_types=1);

namespace SweetBlog\Core\Container;

use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;
use SweetBlog\Core\Container\Exceptions\ContainerException;
use SweetBlog\Core\Container\Exceptions\MissingTypeHintException;
use SweetBlog\Core\Container\Exceptions\NotInstantiableException;
use SweetBlog\Core\Container\Exceptions\UnionTypeNotSupportedException;

/**
 * Dependency injection container with autowiring.
 */
final class Container
{
    /**
     * @var array<string, callable> Explicit bindings
     */
    private array $bindings = [];

    public function bind(string $id, callable $factory): void
    {
        $this->bindings[$id] = $factory;
    }

    /**
     * @param class-string $id
     */
    public function make(string $id): mixed
    {
        if (array_key_exists($id, $this->bindings)) {
            $instance = $this->bindings[$id]($this);

            if (!is_object($instance)) {
                throw new ContainerException(sprintf('Binding for %s must return an object.', $id));
            }

            return $instance;
        }

        return $this->autowire($id);
    }

    /**
     * @param class-string $id
     */
    private function autowire(string $id): object
    {
        // TODO: PHPStan complains about dead catch block.
        try {
            $reflector = new ReflectionClass($id);
        } catch (ReflectionException $e) {
            throw new ContainerException($e->getMessage());
        }

        if (!$reflector->isInstantiable()) {
            throw new NotInstantiableException($id);
        }

        $constructor = $reflector->getConstructor();

        if ($constructor === null) {
            return new $id();
        }

        if ($constructor->getNumberOfParameters() === 0) {
            return new $id();
        }

        $parameters = $constructor->getParameters();

        $dependencies = array_map(function (ReflectionParameter $parameter) use ($id) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if ($type === null) {
                throw new MissingTypeHintException(sprintf('Parameter %s in %s has no type hint.', $name, $id));
            }

            if ($type instanceof ReflectionUnionType) {
                throw new UnionTypeNotSupportedException(sprintf('Parameter %s in %s has a union type.', $name, $id));
            }

            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                // TODO: Resolve static analysis error in a better way.
                /**
                 * @var class-string $typeName
                 */
                $typeName = $type->getName();

                return $this->make($typeName);
            }

            throw new ContainerException(sprintf('Parameter %s in %s has an unsupported type.', $name, $id));
        }, $parameters);

        try {
            return $reflector->newInstanceArgs($dependencies);
        } catch (ReflectionException $e) {
            throw new ContainerException($e->getMessage());
        }
    }
}
