<?php

use SweetBlog\Core\ViewData\NotFoundData;

if (!isset($viewData)) {
    throw new \LogicException('Missing view data transfer object.');
}

if (!$viewData instanceof NotFoundData) {
    throw new \LogicException('Invalid view data transfer object.');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $viewData->title ?></title>
</head>
<body>
    <h1><?= $viewData->title ?></h1>
    <p><?= $viewData->message ?></p>
</body>
</html>
