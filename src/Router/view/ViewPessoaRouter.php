<?php
use Src\Controller\PessoaController;

$method = $_SERVER['REQUEST_METHOD'];

$action = str_replace('/view/pessoas', "", $url);

$actions = [
  '' => [PessoaController::class, 'viewConsulta'],
  '/cadastro' => [PessoaController::class, 'viewCadastro'],
  '/edicao' => [PessoaController::class, 'viewEdicao'],
];

$controller = new $actions[$action][0];
$function = $actions[$action][1];

$controller->$function();