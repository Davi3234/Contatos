<?php

use Src\Controller\PessoaController;

$method = $_SERVER['REQUEST_METHOD'];

$action = str_replace('/api/pessoas', "", $url);

if (preg_match('/^\/(\d+)$/', $action, $matches)) {
  $action = '/:id';
  $id = $matches[1];
} else {
  $id = null;
}

$actions = [
  'POST' => [
        '' => [PessoaController::class, 'inserePessoa', $data],
    ],
  'PUT' => [
        '/:id' => [PessoaController::class, 'alteraPessoa', [...$data, 'id' => $id]]
    ],
  'DELETE' => [
        '/:id' => [PessoaController::class, 'removePessoa', [...$data, 'id' => $id]]
    ],
  'GET' => [
        '' => [PessoaController::class, 'listAll', $_GET]
    ],
];

$controller = new $actions[$method][$action][0];
$function = $actions[$method][$action][1];
$controller->$function($actions[$method][$action][2]);
