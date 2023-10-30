<?php

define('DS', DIRECTORY_SEPARATOR);

spl_autoload_register(function ($className) {
    // Converte o namespace da classe e o nome da classe em um caminho de arquivo
    $filePath = __DIR__ . DS .'src'. DS . str_replace('\\', DS, $className) . '.php';
    /* var_dump($filePath); */
    
    // Verifica se o arquivo existe e o inclui
    if (file_exists($filePath)) {
        include_once $filePath;
    } 
});
