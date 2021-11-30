<?php

namespace Core;

class Route 
{
    public static function get(string $endpoint, array $class)
    {
        return self::registerRoute($endpoint, 'GET', $class);
    }

    public static function post(string $endpoint, array $class)
    {
        return self::registerRoute($endpoint, 'POST', $class);
    }

    public static function put(string $endpoint, array $class)
    {
        return self::registerRoute($endpoint, 'PUT', $class);
    }

    public static function delete(string $endpoint, array $class)
    {
        return self::registerRoute($endpoint, 'DELETE', $class);
    }

    protected static function call(string $routeName): string
    {
        return $routeName;
    }

    protected static function registerRoute(string $endpoint, string $method, array $class)
    {
        // register_rest_route( $namespace:string, $route:string, $args:array, $override:boolean )
        
        register_rest_route('wp/v2/sm-shop', $endpoint, array(
            'methods' => $method,
            'callback' => $class
        ), true );
    } 
    
}

