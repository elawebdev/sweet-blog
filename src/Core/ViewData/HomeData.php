<?php

declare(strict_types=1);

namespace SweetBlog\Core\ViewData;

final class HomeData implements ViewData
{
    public private(set) string $title = '' {
        get {
            return htmlentities($this->title, ENT_QUOTES, 'UTF-8');
        }
        set(string $value) {
            $this->title = trim($value);
        }
    }

    public function __construct(string $title)
    {
        $this->title = $title;
    }
}
