<?php
// alterar_status_atividade.php

include 'includes/top.php';
require_once '../autoloadclass.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atividade_id = $_POST['atividade_id'];
    $novoEstado = $_POST['novo_estado'];

    // Obtenha a atividade específica do vendedor
    $atividade = Atividade::getAtividadeByIdAndVendedor($atividade_id, $_SESSION['vendedor_id']);

    if ($atividade) {
        // Atualize o estado da atividade
        $atividade->setEstado($novoEstado);
        $atividade->update();

        // Atualize as atividades do vendedor
        $atividadesAtualizadas = Atividade::search(['vendedor_id' => $_SESSION['vendedor_id']]);
        $_SESSION['atividades'] = $atividadesAtualizadas;

        // Redirecione de volta para a página principal com uma mensagem de sucesso
        header('Location: minhas_atividades.php?sucesso=Estado da atividade alterado com sucesso');
        exit;
    }
}

// Redirecione para a página principal se algo der errado
header('Location: minhas_atividades.php?erro=Erro ao alterar o estado da atividade');
exit;

?>
