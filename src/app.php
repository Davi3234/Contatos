<?php

use Src\Core\Router;

require_once __DIR__ . '/routers.php';

if (!isset($_GET['url']))
  $_GET['url'] = $_SERVER['REQUEST_URI'];

$router = new Router();

