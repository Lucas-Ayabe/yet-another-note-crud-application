<?php

namespace Source\Http\Controllers;

use Source\Domain\Note\Note;
use Source\Domain\Note\NoteRepository;
use Source\Http\Redirect;
use Source\Presentation\Template;

use function Source\Util\mapRequestMultipleDataToArray;

class NoteController
{
    public function __construct(
        private Template $template,
        private NoteRepository $noteRepository
    ) {
    }

    public function index(): string
    {
        return $this->template->render('create');
    }

    public function list(): string
    {
        echo "<pre>";
        var_dump($this->noteRepository->list());
        return "";
    }

    public function create(): string
    {
        $notes = mapRequestMultipleDataToArray(filter_input_array(INPUT_POST));
        if (empty($notes)) {
            return new Redirect("/");
        }

        $this->noteRepository->addAll(
            array_map(
                fn ($note) => Note::fromProperties($note['title'], $note['body']),
                $notes
            )
        );

        return "";
    }
}
