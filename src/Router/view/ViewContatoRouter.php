<?php
use Src\Controller\ContatoController;

$method = $_SERVER['REQUEST_METHOD'];

$action = explode("&", str_replace('/view/contatos', "", $url))[0];

$actions = [
  '' => [ContatoController::class, 'viewConsulta'],
  '/cadastro' => [ContatoController::class, 'viewCadastro'],
  '/edicao' => [ContatoController::class, 'viewEdicao'],
  '/visualizar' => [ContatoController::class, 'visualizar'],
];

$controller = new $actions[$action][0];
$function = $actions[$action][1];

$controller->$function($_GET);