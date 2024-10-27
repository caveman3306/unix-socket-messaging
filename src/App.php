<?php

declare(strict_types=1);

namespace Sources;

use Sources\Exceptions\ParameterException;
use Sources\Exceptions\RouterException;

final class App
{
    /**
     * @throws RouterException
     * @throws ParameterException
     */
    public function run(): void
    {
        $getOpt = getopt('', ['route:']);

        if (!isset($getOpt['route'])) {
            throw new ParameterException('Parameter --route is not set.');
        }

        $router = new Router();
        $router->forward($getOpt['route']);
    }
}