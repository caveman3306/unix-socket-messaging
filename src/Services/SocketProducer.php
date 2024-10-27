<?php

declare(strict_types=1);

namespace Sources\Services;

use Sources\Models\SocketMessage;

class SocketProducer extends SocketRunnable
{
    public function run(): void {
        $socket = $this->socketService->create();
        $this->socketService->connect($socket);

        echo 'Please type your message. If you want to finish please type "exit".' . PHP_EOL;

        while (true) {
            $stdin = fgets(STDIN, SocketMessage::LENGTH);
            $message = new SocketMessage($stdin);

            $this->socketService->write($socket, $message);

            if ($message->text === 'exit' . PHP_EOL) {
                break;
            }
        }

        $this->socketService->close($socket);
    }
}