<?php

namespace Source\Presentation;

interface Template
{
    public function render(string $view, array $data = []): string;
    public function print(string $view, array $data = []): void;
}
