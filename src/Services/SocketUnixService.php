<?php

declare(strict_types=1);

namespace Sources\Services;

use Socket;
use Sources\Exceptions\SocketException;
use Sources\Models\SocketMessage;

class SocketUnixService implements SocketCommunicationInterface
{
    protected const SOCKET = '/var/tmp/socket';

    /**
     * @throws SocketException
     */
    public function create(): Socket
    {
        $socket = socket_create(AF_UNIX, SOCK_STREAM, IPPROTO_IP);

        if ($socket === false) {
            throw new SocketException('Create socket error.');
        }

        return $socket;
    }

    /**
     * @throws SocketException
     */
    public function bind(Socket $socket): void
    {
        if (file_exists(self::SOCKET)) {
            unlink(self::SOCKET);
        }

        $bind = socket_bind($socket, self::SOCKET);

        if ($bind === false) {
            throw new SocketException('Bind socket error.');
        }
    }

    /**
     * @throws SocketException
     */
    public function listen(Socket $socket): void
    {
        $listen = socket_listen($socket);

        if ($listen === false) {
            throw new SocketException('Listen socket error.');
        }
    }

    /**
     * @throws SocketException
     */
    public function accept(Socket $socket): Socket
    {
        $acceptedSocket = socket_accept($socket);

        if ($acceptedSocket === false) {
            throw new SocketException('Accept socket error.');
        }

        return $acceptedSocket;
    }

    /**
     * @throws SocketException
     */
    public function connect(Socket $socket): void
    {
        $connect = socket_connect($socket, self::SOCKET);

        if ($connect === false) {
            throw new SocketException('Connect socket error.');
        }
    }

    /**
     * @throws SocketException
     */
    public function read(Socket $socket, int $length): SocketMessage
    {
        $read = socket_read($socket, $length, PHP_NORMAL_READ);

        if ($read === false) {
            throw new SocketException('Read socket error.');
        }

        return new SocketMessage(trim($read));
    }

    /**
     * @throws SocketException
     */
    public function write(Socket $socket, SocketMessage $message): void
    {
        $write = socket_write($socket, $message->text, $message->length());

        if ($write === false) {
            throw new SocketException('Write socket error.');
        }
    }

    public function close(Socket $socket): void
    {
        socket_close($socket);
    }
}