<?php

namespace Source\Presentation\Adapters;

use League\Plates\Engine as Plates;
use Source\Presentation\Template;

class PlatesTemplateAdapter implements Template
{
    public function __construct(private Plates $templates)
    {
    }

    public function render(string $view, array $data = []): string
    {
        return $this->templates->render($view, $data);
    }

    public function print(string $view, array $data = []): void
    {
        echo $this->render($view, $data);
    }
}
