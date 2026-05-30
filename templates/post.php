<?php

declare(strict_types=1);

use SweetBlog\Core\View\Exceptions\InvalidViewData;
use SweetBlog\Core\View\Exceptions\MissingViewDataException;
use SweetBlog\DTOs\PostData;

if (!isset($data)) {
    throw new MissingViewDataException();
}

if (!$data instanceof PostData) {
    throw new InvalidViewData();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $data->title ?>></title>
</head>
<body>
<h1><?= $data->title ?></h1>
<?= $data->content ?>
<p>Published on <?= $data->createdAt ?> by <?= $data->author ?></p>
</body>
</html>
