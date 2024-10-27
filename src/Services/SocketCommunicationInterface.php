<?php

declare(strict_types=1);

namespace Sources\Services;

use Socket;
use Sources\Models\SocketMessage;

interface SocketCommunicationInterface
{
    public function create(): Socket;

    public function bind(Socket $socket): void;

    public function listen(Socket $socket): void;

    public function accept(Socket $socket): Socket;

    public function connect(Socket $socket): void;

    public function read(Socket $socket, int $length): SocketMessage;

    public function write(Socket $socket, SocketMessage $message): void;

    public function close(Socket $socket): void;
}