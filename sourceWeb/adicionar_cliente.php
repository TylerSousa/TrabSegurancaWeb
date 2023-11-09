<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Outros campos conforme necessário

    // Validação dos campos, lógica de verificação, etc.

    // Crie uma instância de Vendedor com os dados do formulário
    $cliente = new Cliente($nome, $email);

    // Defina a senha do vendedor (você pode usar a função setSenha definida em Vendedor)
    $cliente->setSenha($password);

    // Salve o vendedor no banco de dados
    if ($cliente->save()) {
        // Inserção bem-sucedida, redirecione para uma página de sucesso
        header("Location: index.php?sucesso=Cliente adicionado com sucesso");
        exit();
    } else {
        // Erro na inserção, redirecione para uma página de erro
        header("Location: index.php?erro=Erro ao adicionar o cliente");
        exit();
    }
}
