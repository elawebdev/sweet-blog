<?php

declare(strict_types=1);

namespace SweetBlog\Repositories;

use PDO;
use SweetBlog\Core\Database\Database;
use SweetBlog\Entities\PostEntity;

final readonly class PostRepository
{
    public function __construct(
        private Database $database,
    ) {}

    public function fetchPost(string $slug): PostEntity|false
    {
        $stmt = $this->database->pdo->prepare('SELECT * FROM posts WHERE slug = :slug LIMIT 1;');
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);

        /**
         * @var PostEntity|false
         */
        return $stmt->fetch();
    }
}
