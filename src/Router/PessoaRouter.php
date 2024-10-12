<?php

use Src\Controller\PessoaController;

$method = $_SERVER['REQUEST_METHOD'];

$pessoaController = new PessoaController();

$routes = [

];

switch ($method) {
    case 'GET':
        $pessoaController->getPessoa($_GET['id']);
        break;

    case 'POST':
        $args = json_decode(file_get_contents('php://input'), true);
        $pessoaController->inserePessoa($args);
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $args = json_decode(file_get_contents('php://input'), true);
            $pessoaController->alteraPessoa($args, $_GET['id']);
        } else {
            echo "ID da pessoa não informado!";
        }
        break;
        
        case 'DELETE':
        if (isset($_GET['id'])) {
            $pessoaController->removePessoa($_GET['id']);
        } else {
            echo "ID da pessoa não informado!";
        }
        break;
}
