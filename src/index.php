<?php

use Weather\Script\CitiesWeatherConditionsScript;

require __DIR__ . '/../vendor/autoload.php';

/** @var \DI\Container $container */
$container = require_once  __DIR__ . '/bootstrap.php';

$container->get(CitiesWeatherConditionsScript::class)->run();
