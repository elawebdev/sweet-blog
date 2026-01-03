<?php

use SweetBlog\Core\ViewData\HomeData;

if (!isset($viewData)) {
    throw new \LogicException('Missing view data transfer object.');
}

if (!$viewData instanceof HomeData) {
    throw new \LogicException('Invalid view data transfer object.');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Blog</title>
</head>
<body>
    <h1>Sweet Blog</h1>
    <p>Hello, world!</p>
</body>
</html>
