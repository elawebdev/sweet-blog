<?php

declare(strict_types=1);

namespace SweetBlog\Core\ViewData;

final class NotFoundData implements ViewData
{
    public private(set) string $title = '' {
        get {
            return htmlentities($this->title, ENT_QUOTES, 'UTF-8');
        }
        set(string $value) {
            $this->title = trim($value);
        }
    }

    public private(set) string $message = '' {
        get {
            return htmlentities($this->message, ENT_QUOTES, 'UTF-8');
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
