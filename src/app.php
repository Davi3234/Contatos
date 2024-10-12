<?php

require_once __DIR__ . '/routers.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$url = rtrim($url, '/');

if (array_key_exists($url, $rotas)) {
    require_once __DIR__ . '/' . $rotas[$url];
} else {
    http_response_code(404);
    echo "Erro 404: Página não encontrada!";
}
