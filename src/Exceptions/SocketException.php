<?php

declare(strict_types=1);

namespace Sources\Exceptions;

use Exception;
use Throwable;

class SocketException extends Exception
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = $message . ' ' . socket_strerror(socket_last_error()) . '.';
        parent::__construct($message, $code, $previous);
    }
}