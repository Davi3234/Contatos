<?php

use Src\Controller\PessoaController;

$method = $_SERVER['REQUEST_METHOD'];

$action = str_replace('/api/pessoas', "", $url);

$actions = [
  'POST' => [
        '' => [PessoaController::class, 'inserePessoa'],
    ],
  'PUT' => [
        '' => [PessoaController::class, 'alteraPessoa']
    ],
  'DELETE' => [
        '' => [PessoaController::class, 'removePessoa']
    ],
  'GET' => [
        '' => [PessoaController::class, 'listAll']
    ],
];

$controller = new $actions[$method][$action][0];
$function = $actions[$method][$action][1];

$controller->$function($_REQUEST);
