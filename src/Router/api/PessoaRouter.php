<?php

use Src\Controller\PessoaController;

$method = $_SERVER['REQUEST_METHOD'];

$action = str_replace('/api/pessoas', "", $url);

$actions = [
  'POST' => [
        '' => [PessoaController::class, 'inserePessoa'],
    ],
  'PUT' => [
        '/:id' => [PessoaController::class, 'alteraPessoa']
    ],
  'DELETE' => [
        '/:id' => [PessoaController::class, 'removePessoa']
    ],
  'GET' => [
        '' => [PessoaController::class, 'listAll']
    ],
];


if (preg_match('/^\/(\d+)$/', $action, $matches)) {
  $action = '/:id';
  $id = $matches[1];
} else {
  $id = null;
}

$controller = new $actions[$method][$action][0];
$function = $actions[$method][$action][1];

if ($id !== null) {
  $controller->$function([...$data, 'id' => $id]);
} else {
  $controller->$function($data);
}
