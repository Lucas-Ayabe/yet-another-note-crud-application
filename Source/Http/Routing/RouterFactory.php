<?php

namespace Source\Http\Routing;

interface RouterFactory
{
    public function create(): Router;
}
