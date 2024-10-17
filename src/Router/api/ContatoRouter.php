<?php

use Src\Controller\ContatoController;

$method = $_SERVER['REQUEST_METHOD'];

$action = str_replace('/api/contatos', "", $url);

if (preg_match('/^\/(\d+)$/', $action, $matches)) {
  $action = '/:id';
  $id = $matches[1];
} else {
  $id = null;
}

$actions = [
  'POST' => [
        '' => [ContatoController::class, 'insereContato', $data],
    ],
  'PUT' => [
        '/:id' => [ContatoController::class, 'alteraContato', [...$data, 'id' => $id]]
    ],
  'DELETE' => [
        '/:id' => [ContatoController::class, 'removeContato', [...$data, 'id' => $id]]
    ],
  'GET' => [
        '' => [ContatoController::class, 'listAll', $_GET]
    ],
];

$controller = new $actions[$method][$action][0];
$function = $actions[$method][$action][1];
$controller->$function($actions[$method][$action][2]);
