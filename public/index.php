<?php

use Source\Main\DefaultApplicationFactory;

require_once __DIR__ . "/../vendor/autoload.php";

define("BASE_URL", "http://localhost:8080");
$applicationFactory = new DefaultApplicationFactory();
$applicationFactory->create()->run();
