<?php

declare(strict_types=1);

namespace Tests\Fixtures\ViewData;

use SweetBlog\Core\ViewData\ViewData;

final class ViewTestData implements ViewData
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
