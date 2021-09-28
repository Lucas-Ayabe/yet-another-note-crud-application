<?php

namespace Source\Main;

use Source\Http\Controllers\NoteController;
use Source\Http\Routing\Router;

class Application
{
    public function __construct(
        private Router $router,
        private NoteController $noteController
    ) {
    }

    public function run(): void
    {
        echo $this->router
            ->get('/', [$this->noteController, 'list'])
            ->post('/', [$this->noteController, 'create'])
            ->dispatch();
    }
}
