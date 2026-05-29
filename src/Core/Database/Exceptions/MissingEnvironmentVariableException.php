<?php

declare(strict_types=1);

namespace SweetBlog\Core\Database\Exceptions;

use LogicException;

final class MissingEnvironmentVariableException extends LogicException {}
