<?php

define('ALL_PATHS', [
		'home' => ['title' => 'Home', 'url' => '/view'],
		'consultaPessoa' => ['title' => 'Consulta de Pessoas', 'url' => '/view/pessoas'],
		'cadastroPessoa' => ['title' => 'Cadastro de Pessoa', 'url' => '/view/pessoas/cadastro'],
		'edicaoPessoa' => ['title' => 'Edição de Pessoa', 'url' => '/view/pessoas/edicao'],
		'visualizarPessoa' => ['title' => 'Visualização de Pessoa', 'url' => '/view/pessoas/visualizar'],
		'consultaContato' => ['title' => 'Consulta de Contatos', 'url' => '/view/contatos'],
		'cadastroContato' => ['title' => 'Cadastro de Contato', 'url' => '/view/contatos/cadastro'],
		'edicaoContato' => ['title' => 'Edição de Contato', 'url' => '/view/contatos/edicao'],
		'visualizarContato' => ['title' => 'Visualização de Contato', 'url' => '/view/contatos/visualizar'],
	]
);

define('VIEW_PATH', __DIR__.'/View/');

require_once __DIR__ . '/routers.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$url = rtrim($url, '/');

$input = file_get_contents("php://input");

$data = json_decode($input, true) ?? [];

if(str_contains($url, 'api')){
	header('Content-Type: application/json');
}

foreach($rotas as $rota => $arquivo){
	if (str_starts_with($url, $rota)) {
		require_once __DIR__ . '/' . $arquivo;
		exit;
	}
}