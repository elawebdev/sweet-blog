<?php

declare(strict_types=1);

namespace SweetBlog\Repositories;

use PDO;
use SweetBlog\Core\Database\Database;
use SweetBlog\Entities\PostListItemEntity;

final readonly class PostListRepository
{
    public function __construct(
        private Database $database,
    ) {}

    /**
     * Fetches a list of recent posts from the database.
     *
     * @param int $limit Maximum number of posts to fetch
     *
     * @return list<PostListItemEntity> List of recent posts
     */
    public function fetchRecentPosts(int $limit = 5): array
    {
        $stmt = $this->database->pdo->prepare(
            'SELECT slug, title FROM posts WHERE status = "published" ORDER BY created_at DESC LIMIT :limit;',
        );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        /**
         * @var list<PostListItemEntity>
         */
        return $stmt->fetchAll(PDO::FETCH_CLASS, PostListItemEntity::class);
    }
}
