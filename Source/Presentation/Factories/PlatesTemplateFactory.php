<?php

namespace Source\Presentation\Factories;

use League\Plates\Engine as Plates;
use Source\Presentation\Adapters\PlatesTemplateAdapter;
use Source\Presentation\Template;
use Source\Presentation\TemplateFactory;

class PlatesTemplateFactory implements TemplateFactory
{
    public function create(...$args): Template
    {
        return new PlatesTemplateAdapter(new Plates('../Source/Presentation/Views'));
    }
}
