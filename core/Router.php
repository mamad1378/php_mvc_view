<?php

namespace Core;

class Router
{
    private static array $routes = [];

    public static function addRoute(string $uri, array $controllerAction): void
    {
        static::$routes[$uri] = $controllerAction;
    }

    public static function dispatch(string $requestUri): bool
    {

        if (array_key_exists($requestUri, self::$routes)) {
            echo self::callMethod(self::$routes[$requestUri][0], self::$routes[$requestUri][1]);
            return true;
        }

        $uri = (substr($requestUri, -1) == '/') ? substr($requestUri, 0, -1) : $requestUri;

        if (in_array(substr($uri, 1), Config::get('SERVE_DIRS'), true) != false) {
            return false;
        }

        http_response_code(404);

        return true;
    }

    public static function callMethod(string $class, string $method): mixed
    {
        $class = new $class;
        return $class->$method();
    }
}
