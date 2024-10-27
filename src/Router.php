<?php

declare(strict_types=1);

namespace Sources;

use Sources\Exceptions\RouterException;

final class Router
{
    private const CONTROLLER_NAMESPACE = 'Sources\\Controllers\\';

    /**
     * @throws RouterException
     */
    public function forward(string $route): void
    {
        $parsedRoute = $this->parseRoute($route);
        [new $parsedRoute['controller'], $parsedRoute['action']]();
    }

    /**
     * @throws RouterException
     */
    private function parseRoute(string $route): array
    {
        $routeParts = explode('/', $route);

        if (count($routeParts) !== 2) {
            throw new RouterException("Route `$route` is not valid.");
        }

        $controller = self::CONTROLLER_NAMESPACE . ucfirst(strtolower($routeParts[0])) . 'Controller';
        $action = 'action' . ucfirst(strtolower($routeParts[1]));

        if (!class_exists($controller)) {
            throw new RouterException("Controller `$controller` not found.");
        }

        if (!method_exists($controller, $action)) {
            throw new RouterException("Action `$action` not found.");
        }

        return [
            'controller' => $controller,
            'action' => $action
        ];
    }
}