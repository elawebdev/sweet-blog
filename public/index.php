<?php

declare(strict_types=1);

use SweetBlog\Application;
use SweetBlog\Autoloader;

require __DIR__ . '/../src/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->register();

$application = new Application();
$application->run();
