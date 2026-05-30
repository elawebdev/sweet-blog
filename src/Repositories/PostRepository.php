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
        $stmt = $this->database->pdo->prepare(
            'SELECT title, content, posts.created_at, users.handle FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE slug = :slug LIMIT 1;',
        );
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, PostEntity::class);

        /**
         * @var PostEntity|false
         */
        return $stmt->fetch();
    }
}
