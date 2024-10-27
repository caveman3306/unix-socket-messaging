<?php

declare(strict_types=1);

namespace Sources\Models;

final readonly class SocketMessage
{
    public const LENGTH = 1024;

    public function __construct(
        public string $text,
    ) {}

    public function length(): int
    {
        return strlen($this->text);
    }
}