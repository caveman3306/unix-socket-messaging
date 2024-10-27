<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Sources\App;

try {
    $app = new App();
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}