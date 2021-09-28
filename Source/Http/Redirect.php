<?php

namespace Source\Http;

class Redirect
{
    public function __construct(string $url)
    {
        header("Location: $url");
        exit;
    }

    public function __toString()
    {
        return "";
    }
}
