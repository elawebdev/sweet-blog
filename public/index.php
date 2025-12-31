<?php

use SweetBlog\Autoloader;
use SweetBlog\SweetBlog;

require __DIR__ . '/../src/Autoloader.php';

new Autoloader()->register();

new SweetBlog(dirname(__DIR__))->init();
