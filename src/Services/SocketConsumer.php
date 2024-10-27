<?php

declare(strict_types=1);

namespace Sources\Services;

use Sources\Models\SocketMessage;

class SocketConsumer extends SocketRunnable
{
    public function run(): void {
        $socket = $this->socketService->create();
        $this->socketService->bind($socket);
        $this->socketService->listen($socket);

        while (true) {
            $acceptedSocket = $this->socketService->accept($socket);
            echo 'Connection established.' . PHP_EOL;

            while (true) {
                $message = $this->socketService->read($acceptedSocket, SocketMessage::LENGTH);

                if ($message->text === '') {
                    continue;
                }
                if ($message->text === 'exit') {
                    break;
                }

                echo 'Message: ' . $message->text . PHP_EOL;
            }

            $this->socketService->close($acceptedSocket);
            echo 'Connection disposed.' . PHP_EOL;
        }
    }
}