<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router {
    protected $routes = [];

    private function registerRoute($method, $uri, $action) {
        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller, // 修正为 'controller'
            'controllerMethod' => $controllerMethod
        ];
    }

    public function error($httpCode = 404) {
        http_response_code($httpCode);
        loadView("error/{$httpCode}");
        exit;
    }

    // 添加GET路由
    public function addGet($uri, $controller) {
        $this->registerRoute('GET', $uri, $controller);
    }

    // 添加POST路由
    public function addPost($uri, $controller) {
        $this->registerRoute('POST', $uri, $controller);
    }

    // 添加DELETE路由
    public function addDelete($uri, $controller) {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    public function route($uri, $method) {
        $uriSegments = explode('/', trim($uri, '/'));
        foreach ($this->routes as $route) {
            $routeSegments = explode('/', trim($route['uri'], '/'));
            $match = false;
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method']) == strtoupper($method)) {
                $params = [];
                $match = true;
                for ($i = 0; $i < count($uriSegments); $i++) {
                    if ($routeSegments[$i] != $uriSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
            }
            if ($match) {
                $controllerClass = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                $controllerInstance = new $controllerClass();
                $controllerInstance->$controllerMethod($params);
                return;
            }
        }
        ErrorController::notFound();
    }
}
