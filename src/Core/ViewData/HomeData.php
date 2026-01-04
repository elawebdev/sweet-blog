<?php

declare(strict_types=1);

namespace SweetBlog\Core\ViewData;

use SweetBlog\Utils\Html;

final class HomeData implements ViewData
{
    public private(set) string $title = '' {
        get {
            return Html::escape($this->title);
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
