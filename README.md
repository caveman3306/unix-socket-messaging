# Unix Socket Messaging

Sending messages via unix socket.

## Install

```bash
cd [project-dir]
docker-compose up -d
docker exec -it unix-socket-messaging-php sh -c "composer install"
```

## Launch

In first terminal start consumer.
```bash
docker exec -it unix-socket-messaging-php sh -c "php public/index.php --route=messaging/consume"
```

In second terminal start producer.
```bash
docker exec -it unix-socket-messaging-php sh -c "php public/index.php --route=messaging/produce"
```
