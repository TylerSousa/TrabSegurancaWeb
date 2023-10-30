<?php
session_start();

if(!isset($_SESSION['active'])) {
    header('Location: login.php');
}

session_unset();

header('Location: index.php');

?>