<?php
  
define('VIEW', __DIR__.'/View/');

require_once __DIR__ . '/routers.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$url = rtrim($url, '/');

foreach($rotas as $rota => $arquivo){
    if (str_starts_with($url, $rota)) {
        require_once __DIR__ . '/' . $arquivo;
        exit;
    }
}