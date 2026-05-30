<?php

declare(strict_types=1);

use SweetBlog\Core\View\Exceptions\InvalidViewData;
use SweetBlog\Core\View\Exceptions\MissingViewDataException;
use SweetBlog\DTOs\HomeData;

if (!isset($data)) {
    throw new MissingViewDataException();
}

if (!$data instanceof HomeData) {
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
<section>
    <?php if ($data->postList === []): ?>
        <p>No posts were found.</p>
    <?php else: ?>
        <nav>
            <ul>
                <?php foreach ($data->postList as $postListItem): ?>
                    <li><a href="/<?= $postListItem->slug ?>"><?= $postListItem->title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
</section>
</body>
</html>
