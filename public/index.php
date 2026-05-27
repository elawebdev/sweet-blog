<?php

declare(strict_types=1);

use SweetBlog\Autoloader;

require __DIR__ . '/../src/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->register();

echo 'Hello, world!';
