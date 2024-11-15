<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Obtenha o ID da atividade da URL
$atividade_id = isset($_GET['id']) ? $_GET['id'] : null;

// Agora, você pode usar $atividade_id para obter os detalhes da atividade específica
$atividade = Atividade::find($atividade_id);

// Verifique se a atividade foi encontrada
if ($atividade) {
    // Obtenha a reserva associada à atividade (assumindo que há apenas uma reserva por atividade)
    $reserva = Reserva::search(['atividade_id' => $atividade_id]);
    $comentarioCliente = ($reserva && $reserva[0]) ? $reserva[0]->getComentarioCliente() : '';

    // Exibir os detalhes da atividade
} else {
    // Trate o caso em que a atividade não foi encontrada
    echo "Atividade não encontrada.";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Atividade</title>
</head>
<body>

<div class="container mt-5">
    <?php if ($atividade) { ?>
        <h1>Detalhes da Atividade</h1>

        <h2>Informações da Atividade</h2>
        <p><strong>Nome:</strong> <?php echo $atividade->getNome(); ?></p>
        <p><strong>Descrição:</strong> <?php echo $atividade->getDescricao(); ?></p>
        <p><strong>Preço:</strong> <?php echo $atividade->getPreco(); ?>€</p>
        <p><strong>Data:</strong> <?php echo $atividade->getData(); ?></p>
        <p><strong>Localização:</strong> <?php echo $atividade->getLocalizacao(); ?></p>
        <p><strong>Status:</strong> <?php echo $atividade->getEstado(); ?></p>
        
        <!-- Adicione mais informações conforme necessário -->

        <p><strong>Comentário do Cliente:</strong> <?php echo $comentarioCliente; ?></p>

        <?php
        // Verifique se o utilizador é um vendedor antes de exibir o botão "Atualizar"
        if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') {
        ?>
            <a href="atualizar_atividade.php?id=<?php echo $atividade->getId(); ?>" class="btn btn-primary">Atualizar Atividade</a>
        <?php } ?>

    <?php } else { ?>
        <p>Detalhes da atividade não disponíveis.</p>
    <?php } ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
