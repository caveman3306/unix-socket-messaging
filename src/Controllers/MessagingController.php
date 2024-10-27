<?php

declare(strict_types=1);

namespace Sources\Controllers;

use Sources\Services\SocketCommunicationInterface;
use Sources\Services\SocketConsumer;
use Sources\Services\SocketProducer;
use Sources\Services\SocketUnixService;

final class MessagingController
{
    private SocketCommunicationInterface $socketService;

    public function __construct()
    {
        $this->socketService = new SocketUnixService();
    }

    public function actionProduce(): void
    {
        $producer = new SocketProducer($this->socketService);
        $producer->run();
    }

    public function actionConsume(): void
    {
        $consumer = new SocketConsumer($this->socketService);
        $consumer->run();
    }
}