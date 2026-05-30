<?php

declare(strict_types=1);

namespace SweetBlog\Entities;

final class PostEntity
{
    public private(set) int $id;
    public private(set) string $user_id;
    public private(set) string $slug;
    public private(set) string $title;
    public private(set) string $content;
    public private(set) string $status;
    public private(set) string $created_at;
}
