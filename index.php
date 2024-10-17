<?php

if(in_array($_SERVER['HTTP_SEC_FETCH_DEST'], ['empty', 'document'])){
  require_once "vendor/autoload.php";
  
  require_once "src/app.php";
  exit;
}
if(str_contains($_SERVER['SCRIPT_NAME'], '/public')){
  require_once __DIR__.'/public'.explode('/public', $_SERVER['SCRIPT_NAME'])[1];
}
