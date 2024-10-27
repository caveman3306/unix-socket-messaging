<?php

declare(strict_types=1);

namespace Sources\Services;

abstract class SocketRunnable
{
    protected SocketCommunicationInterface $socketService;

    public function __construct(SocketCommunicationInterface $socketService)
    {
        $this->socketService = $socketService;
    }

    abstract public function run(): void;
}