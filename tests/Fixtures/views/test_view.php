<?php

use Tests\Fixtures\ViewData\ViewTestData;

if (!isset($viewData)) {
    throw new \LogicException('Missing view data transfer object.');
}

if (!$viewData instanceof ViewTestData) {
    throw new \LogicException('View data transfer object must be instance of ViewTestData.');
}
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= $viewData->title ?? '' ?></title>
    <meta charset="UTF-8">
</head>
<body>
<h1><?= $viewData->title ?? '' ?></h1>
<p>OK</p>
</body>
</html>
