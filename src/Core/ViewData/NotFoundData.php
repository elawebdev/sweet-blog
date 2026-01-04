<?php

declare(strict_types=1);

namespace SweetBlog\Core\ViewData;

use SweetBlog\Utils\Html;

final class NotFoundData implements ViewData
{
    public private(set) string $title = '' {
        get {
            return Html::escape($this->title);
        }
        set(string $value) {
            $this->title = trim($value);
        }
    }

    public private(set) string $message = '' {
        get {
            return Html::escape($this->message);
        }
        set(string $value) {
            $this->message = trim($value);
        }
    }

    public function __construct(string $title, string $message)
    {
        $this->title = $title;
        $this->message = $message;
    }
}
