<?php
// alterar_estado_atividade.php

include 'includes/top.php';
require_once '../autoloadclass.php';

// ... (código existente)

$vendedor_id = $_SESSION['vendedor_id'];
$atividade_id = $_GET['id'];

// Obtenha a atividade específica do vendedor
$atividade = Atividade::getAtividadeByIdAndVendedor($atividade_id, $vendedor_id);

// Verifique se a atividade foi encontrada
if (!$atividade) {
    header('Location: minhas_atividades.php'); // Redirecione de volta para a página principal se a atividade não for encontrada
    exit;
}

/// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha o novo estado do formulário
    $novoEstado = isset($_POST['novo_estado']) ? $_POST['novo_estado'] : '';

    // Valide o novo estado (você pode adicionar mais validações conforme necessário)

    // Atualize o estado da atividade
    $atividade->setEstado($novoEstado);
    $atividade->update(); // Use o método update() em vez de save() se você já o tiver implementado

    // Redirecione de volta para a página principal com uma mensagem de sucesso
    header('Location: minhas_atividades.php?sucesso=Estado da atividade alterado com sucesso');
    exit;
}
?>

<div class="container mt-3">
    <div class="row">
        <div class="col mt-2">
            <h2>Alterar Estado da Atividade</h2>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="novo_estado" class="form-label">Novo Estado</label>
                    <select name="novo_estado" class="form-select">
                        <option value="realizada">Realizada</option>
                        <option value="adiada">Adiada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
