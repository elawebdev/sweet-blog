<?php

declare(strict_types=1);

use SweetBlog\Application;
use SweetBlog\Autoloader;

$rootDirectory = dirname(__DIR__);

require "$rootDirectory/src/Autoloader.php";

$autoloader = new Autoloader();
$autoloader->register();

$application = new Application($rootDirectory);
$application->run();
