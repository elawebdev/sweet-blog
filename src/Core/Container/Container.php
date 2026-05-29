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
     * @var array<string, callable(Container): mixed>
     */
    private array $bindings = [];

    /**
     * Binds a factory method to a given ID.
     *
     * @param string $id Class name
     * @param callable(Container): mixed $factory Factory method
     */
    public function bind(string $id, callable $factory): void
    {
        $this->bindings[$id] = $factory;
    }

    /**
     * Returns an instance of the given class from the container or autowires it.
     *
     * @template T of object
     * @param string|class-string<T> $id Class name
     *
     * @return ($id is class-string<T> ? T : object)
     */
    public function make(string $id): object
    {
        if (array_key_exists($id, $this->bindings)) {
            $instance = $this->bindings[$id]($this);

            if (!is_object($instance)) {
                throw new ContainerException(sprintf('Binding for %s must return an object.', $id));
            }

            return $instance;
        }

        /** @var class-string<object> $id */
        return $this->autowire($id);
    }

    /**
     * Automatically instantiates the given class with its dependencies.
     *
     * @template T of object
     * @param class-string<T> $id Class name
     *
     * @return T
     */
    private function autowire(string $id): object
    {
        $reflector = new ReflectionClass($id);

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
                return $this->make($type->getName());
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
