<?php

namespace Source\Presentation;

interface TemplateFactory
{
    public function create(...$args): Template;
}
