<?php
require_once '../autoloadclass.php';

if (isset($_GET['id'])) {
    $atividadeId = $_GET['id'];

    // Encontre a atividade pelo ID
    $atividade = Atividade::find($atividadeId);

    if ($atividade) {
        // Chame o método delete para excluir a atividade
        if ($atividade->delete()) {
            header("Location: minhas_atividades.php?sucesso=Atividade eliminada com sucesso");
            exit();
        } else {
            header("Location: minhas_atividades.php?erro=Falha na exclusão da atividade");
            exit();
        }
    } else {
        header("Location: minhas_atividades.php?erro=Atividade não encontrada");
        exit();
    }
} else {
    header("Location: minhas_atividades.php?erro=ID da atividade não especificado");
    exit();
}
