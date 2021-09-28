<?php

namespace Source\Http\Routing\Adapters;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Source\Http\Controllers\HttpErrorController;
use Source\Http\Controllers\MainController;
use Source\Http\Routing\Router;
use Source\Presentation\Factories\PlatesTemplateFactory;

use function FastRoute\simpleDispatcher;

class FastRouteRouterAdapter implements Router
{
    private string $uri = "";
    private array $routeDefinitions = [];

    public function __construct(
        private string $httpMethod,
        string $uri
    ) {
        $queryStart = strpos($uri, '?');
        $this->uri = rawurldecode($queryStart ? substr($uri, 0, $queryStart) : $uri);
    }

    private function addRouteDefinition(string $method, string $uri, callable $handler): self
    {
        $this->routeDefinitions[] = [
            'method' => $method,
            'uri' => $uri,
            'handler' => $handler
        ];

        return $this;
    }

    public function get(string $uri, callable $handler): Router
    {
        return $this->addRouteDefinition('GET', $uri, $handler);
    }

    public function post(string $uri, callable $handler): Router
    {
        return $this->addRouteDefinition('POST', $uri, $handler);
    }

    public function put(string $uri, callable $handler): Router
    {
        return $this->addRouteDefinition('PUT', $uri, $handler);
    }

    public function delete(string $uri, callable $handler): Router
    {
        return $this->addRouteDefinition('DELETE', $uri, $handler);
    }

    public function patch(string $uri, callable $handler): Router
    {
        return $this->addRouteDefinition('PATCH', $uri, $handler);
    }

    public function options(string $uri, callable $handler): Router
    {
        return $this->addRouteDefinition('OPTIONS', $uri, $handler);
    }

    public function route(string $method, $uri, callable $handler): Router
    {
        return $this->addRouteDefinition($method, $uri, $handler);
    }

    public function dispatch(): ?string
    {
        $routeInfo = simpleDispatcher(function (RouteCollector $collector) {
            foreach ($this->routeDefinitions as $route) {
                $collector->addRoute(
                    $route['method'],
                    $route['uri'],
                    $route['handler']
                );
            }
        })->dispatch($this->httpMethod, $this->uri);
        $result = $routeInfo[0];

        $template = (new PlatesTemplateFactory())->create();
        $httpErrorController = new HttpErrorController($template);

        return match ($result) {
            Dispatcher::NOT_FOUND => $httpErrorController->notFound(),
            Dispatcher::METHOD_NOT_ALLOWED => $httpErrorController->methodNotAllowed(),
            Dispatcher::FOUND => $routeInfo[1](...$routeInfo[2])
        };
    }
}
