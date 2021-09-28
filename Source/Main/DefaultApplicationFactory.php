<?php

namespace Source\Main;

use PDO;
use Source\Domain\Note\Mappers\ArrayNoteMapper;
use Source\Domain\Note\Repositories\SqliteNoteRepository;
use Source\Http\Controllers\NoteController;
use Source\Http\Routing\Factories\FastRouteRouterFactory;
use Source\Presentation\Factories\PlatesTemplateFactory;

class  DefaultApplicationFactory implements ApplicationFactory
{
    public static function make(): Application
    {
        return (new self())->create();
    }

    public function create(): Application
    {
        return new Application(
            router: (new FastRouteRouterFactory())->create(),
            noteController: new NoteController(
                template: (new PlatesTemplateFactory())->create(),
                noteRepository: new SqliteNoteRepository(
                    connection: new PDO("sqlite:../database/notes.db"),
                    toArrayMapper: new ArrayNoteMapper()
                )
            )
        );
    }
}
