<?php
include 'includes/top.php';
require_once '../autoloadclass.php';
require_once '../vendor/autoload.php';

use Carbon\Carbon;

if (empty($_POST['email']) || empty($_POST['password'])) {
    $mensagem = urlencode('Utilizador/palavra-passe inválidos');
    header('Location: login.php?erro=' . $mensagem);
    exit;
}

// Verifique se é um cliente
$conn = MyConnect::getInstance();
$stmt = $conn->prepare("SELECT id, nome, email, senha 
                       FROM clientes 
                       WHERE email = ?");
$stmt->bind_param("s", $_POST['email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["senha"];
    $cliente_id = $row["id"];

    if (password_verify($_POST['password'], $hashed_password)) {
        $_SESSION['cliente_id'] = $cliente_id;
        $_SESSION['utilizador'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['active'] = true;
        $_SESSION['perfil'] = 'CLIENTE';
        $_SESSION['nome'] = $row['nome'];
        header('Location: index.php');
        exit;
    }
}

// Verifique se é um vendedor
$stmt = $conn->prepare("SELECT id, nome, email, senha 
                       FROM vendedores 
                       WHERE email = ?");
$stmt->bind_param("s", $_POST['email']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row["senha"];
    $vendedor_id = $row["id"];

    if (password_verify($_POST['password'], $hashed_password)) {
        $_SESSION['vendedor_id'] = $vendedor_id;
        $_SESSION['utilizador'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['active'] = true;
        $_SESSION['perfil'] = 'VENDEDOR';
        $_SESSION['nome'] = $row['nome'];
        header('Location: index.php');
        exit;
    }
}

$mensagem = urlencode('Utilizador/palavra-passe inválidos');
header('Location: login.php?erro=' . $mensagem);
exit;
?>
