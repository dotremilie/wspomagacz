<?php

namespace Wspomagacz\Server\Core;

class Router {
    private array $routes = [];

    public function addRoute($method, $path, $controller, $action): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function dispatch($method, $path): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $path)) {
                $this->callControllerAction($route['controller'], $route['action']);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found - Server';
    }

    private function matchPath($routePath, $requestPath): bool
    {
        return rtrim($routePath, '/') === rtrim($requestPath, '/');
    }

    private function callControllerAction($controller, $action): void
    {
        $controllerInstance = new $controller();
        $controllerInstance->$action();
    }
}