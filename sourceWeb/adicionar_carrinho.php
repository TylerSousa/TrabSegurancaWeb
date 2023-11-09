<?php

session_start();

require '../vendor/autoload.php';
require '../autoloadclass.php';

// Verifica se o parâmetro 'id' foi passado via GET
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); // Certifica-se de que é um número inteiro válido

    if (is_numeric($productId) && $productId > 0) {
        if (isset($_SESSION['carrinho'][$productId])) {
            $_SESSION['carrinho'][$productId]++;
        } else {
            $_SESSION['carrinho'][$productId] = 1;
        }
    }
}

header('Location: pratos.php');


?>
