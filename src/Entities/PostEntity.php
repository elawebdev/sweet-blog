<?php

declare(strict_types=1);

namespace SweetBlog\Entities;

final class PostEntity
{
    public private(set) string $title;
    public private(set) string $content;
    public private(set) string $created_at;
    public private(set) string $handle;
}
