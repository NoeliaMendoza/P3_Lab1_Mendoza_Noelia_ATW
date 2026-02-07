<?php

namespace Framework;

class Router
{
    protected $routes = [];

    /**
     * Registra una ruta GET
     */
    public function get($uri, $action, $middleware = [])
    {
        $this->addRoute('GET', $uri, $action, $middleware);
    }

    /**
     * Registra una ruta POST
     */
    public function post($uri, $action, $middleware = [])
    {
        $this->addRoute('POST', $uri, $action, $middleware);
    }

    /**
     * Registra una ruta PUT
     */
    public function put($uri, $action, $middleware = [])
    {
        $this->addRoute('PUT', $uri, $action, $middleware);
    }

    /**
     * Registra una ruta DELETE
     */
    public function delete($uri, $action, $middleware = [])
    {
        $this->addRoute('DELETE', $uri, $action, $middleware);
    }

    /**
     * Añade una ruta al array de rutas
     */
    protected function addRoute($method, $uri, $action, $middleware = [])
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
            'middleware' => is_array($middleware) ? $middleware : [$middleware]
        ];
    }

    /**
     * Despacha la ruta correspondiente
     */
    public function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $this->getRequestMethod();

        foreach ($this->routes as $route) {
            if ($route['uri'] === $requestUri && $route['method'] === $requestMethod) {
                return $this->callAction($route['action'], $route['middleware']);
            }
        }

        // 404 Not Found
        http_response_code(404);
        echo view('errors.404');
        exit;
    }

    /**
     * Obtiene el método HTTP real (soporta method spoofing)
     */
    protected function getRequestMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        // Soporte para method spoofing con _method
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }

        return $method;
    }

    /**
     * Llama a la acción del controlador
     */
    protected function callAction($action, $middleware = [])
    {
        // Ejecutar middleware
        foreach ($middleware as $middlewareClass) {
            $middlewareInstance = new $middlewareClass();
            $middlewareInstance->handle();
        }

        // Si la acción es un array [Controlador, método]
        if (is_array($action)) {
            [$controller, $method] = $action;
            $controllerInstance = new $controller();
            return $controllerInstance->$method();
        }

        // Si es un callable
        if (is_callable($action)) {
            return $action();
        }

        throw new \Exception("Acción no válida");
    }
}