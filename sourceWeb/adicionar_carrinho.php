<?php

session_start();

require '../vendor/autoload.php';

require '../autoloadclass.php';


if (isset($_SESSION['carrinho'][$_GET['id']])) {
    $_SESSION['carrinho'][$_GET['id']]++;
} else {
    $_SESSION['carrinho'][$_GET['id']] = 1;
}

header('Location: pratos.php');

?>
