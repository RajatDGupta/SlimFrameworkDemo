<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

require_once('../api/user.php');

$app->run();		