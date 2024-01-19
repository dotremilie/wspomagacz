<?php

namespace Wspomagacz\Core;

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
            if ($route['method'] === $method && ($params = $this->matchPath($route['path'], $path)) !== false) {
                $this->callControllerAction($route['controller'], $route['action'], $params);
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }

    private function matchPath($routePath, $requestPath): array|bool
    {
        $routePathParts = explode('/', trim($routePath, '/'));
        $requestPathParts = explode('/', trim($requestPath, '/'));

        if (count($routePathParts) !== count($requestPathParts)) {
            return false;
        }

        $params = [];

        foreach ($routePathParts as $index => $routePart) {
            if (str_starts_with($routePart, '{') && strrpos($routePart, '}') === strlen($routePart) - 1) {
                // This part of the route is a parameter
                $paramName = substr($routePart, 1, -1);
                $paramValue = urldecode($requestPathParts[$index]);
                $params[$paramName] = $paramValue;
            } elseif ($routePart !== $requestPathParts[$index]) {
                return false;
            }
        }

        return $params;
    }

    private function callControllerAction($controller, $action, array $params): void
    {
        $controllerInstance = new $controller();
        $controllerInstance->$action($params);
    }
}