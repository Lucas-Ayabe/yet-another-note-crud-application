<?php

namespace Source\Http\Routing\Factories;

use Source\Http\Routing\Adapters\FastRouteRouterAdapter;
use Source\Http\Routing\Router;
use Source\Http\Routing\RouterFactory;

class FastRouteRouterFactory implements RouterFactory
{
    public function create(): Router
    {
        return new FastRouteRouterAdapter(
            httpMethod: $_SERVER['REQUEST_METHOD'],
            uri: $_SERVER['REQUEST_URI']
        );
    }
}
