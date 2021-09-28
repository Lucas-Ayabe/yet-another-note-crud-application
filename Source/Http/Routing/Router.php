<?php

namespace Source\Http\Routing;

interface Router
{
    public function route(string $method, $uri, callable $handler): self;

    public function get(string $uri, callable $handler): self;
    public function post(string $uri, callable $handler): self;
    public function put(string $uri, callable $handler): self;
    public function patch(string $uri, callable $handler): self;
    public function options(string $uri, callable $handler): self;
    public function delete(string $uri, callable $handler): self;

    public function dispatch(): ?string;
}
