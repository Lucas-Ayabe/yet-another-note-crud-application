<?php

namespace Source\Http\Controllers;

use Source\Presentation\Template;

class HttpErrorController
{
    public function __construct(private Template $template)
    {
    }

    public function notFound(): string
    {
        return $this->template->render('not-found');
    }

    public function methodNotAllowed(): string
    {
        return $this->template->render('method-not-allowed');
    }
}
