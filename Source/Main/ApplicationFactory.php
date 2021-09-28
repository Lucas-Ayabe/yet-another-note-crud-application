<?php

namespace Source\Main;

interface ApplicationFactory
{
    public function create(): Application;
}
