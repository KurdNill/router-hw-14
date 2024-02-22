<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function addRoute(string $path, array $route)
    {
        $this->routes[$path] = $route;
    }

    public function dispatch(string $path = '/'): string
    {
        if (str_contains($path, '?')) {
            $path = substr($path, 0, strpos($path, '?'));
        }
        $method = strtolower($_SERVER['REQUEST_METHOD']);


        foreach ($this->routes as $routePath => $routeMethods) {
            if ($routePath === $path) {
                $controllerAction = $routeMethods[$method];
                [$controller, $action] = explode('@', $controllerAction);
                break;
            }
        }

        if (!class_exists($controller)) {
            throw new \Exception('Клас не існує', 404);
        }

        if (!method_exists($controller, $action)) {
            throw new \Exception('Метод не існує', 404);
        }

        $controllerObject = new $controller;
        if ($controllerObject->before($action)) {
            $response = $controllerObject->$action();
            $controllerObject->after($action);
        }

        return json_response($response['code'], [
            'data' => $response['body'],
            'errors' => $response['errors']
        ]);
    }
}