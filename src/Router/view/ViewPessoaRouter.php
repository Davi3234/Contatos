<?php
use Src\Controller\PessoaController;

$method = $_SERVER['REQUEST_METHOD'];

$action = explode("&", str_replace('/view/pessoas', "", $url))[0];

$actions = [
  '' => [PessoaController::class, 'viewConsulta'],
  '/cadastro' => [PessoaController::class, 'viewCadastro'],
  '/edicao' => [PessoaController::class, 'viewEdicao'],
  '/visualizar' => [PessoaController::class, 'visualizar'],
];

$controller = new $actions[$action][0];
$function = $actions[$action][1];

$controller->$function($_GET);