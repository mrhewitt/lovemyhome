<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

require_once __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../src/app.php';

$app->run();