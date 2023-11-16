<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Verifique se o cliente está autenticado
if (!isset($_SESSION['cliente_id']) || !is_numeric($_SESSION['cliente_id'])) {
    header('Location: login.php'); // Redirecione para a página de login se não estiver autenticado
    exit;
}

// Obtenha o ID do cliente da sessão
$cliente_id = $_SESSION['cliente_id'];

// Obtenha o ID da reserva da URL
$reserva_id = isset($_GET['id']) ? $_GET['id'] : null;

// Agora, você pode usar $reserva_id para obter os detalhes da reserva específica
$reserva = Reserva::find($reserva_id);

// Verifique se a reserva existe e pertence ao cliente autenticado
if (!$reserva || $reserva->getCliente_id() !== $cliente_id) {
    // Redirecione ou exiba uma mensagem de erro, pois a reserva não pertence ao cliente
    header('Location: erro.php');
    exit;
}

// Obtenha as informações da reserva e da atividade associada
$atividade_id = $reserva->getAtividade_id();
$atividade = Atividade::find($atividade_id);

// Verifique se o formulário de comentário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoComentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

    // Valide e salve o novo comentário
    if (!empty($novoComentario)) {
        $reserva->setComentarioCliente($novoComentario);
        $reserva->saveComentario();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Reserva</title>
</head>
<body>

    <div class="container mt-5">
        <h1>Detalhes da Reserva</h1>

        <h2>Informações da Atividade</h2>
        <p><strong>Nome:</strong> <?php echo $atividade->getNome(); ?></p>
        <p><strong>Descrição:</strong> <?php echo $atividade->getDescricao(); ?></p>
        <p><strong>Preço:</strong> <?php echo $atividade->getPreco(); ?>€</p>
        <p><strong>Data:</strong> <?php echo $atividade->getData(); ?></p>
        <p><strong>Localização:</strong> <?php echo $atividade->getLocalizacao(); ?></p>

        <!-- Adicione mais informações conforme necessário -->
        <p><strong>Status Atividade:</strong> <?php echo $atividade->getEstado(); ?></p> <!-- Exibe o estado da atividade -->

        <?php if ($atividade->getEstado() === 'realizada') { ?>
        <h2>Adicionar Comentário</h2>
        <form method="post">
            <textarea name="comentario" rows="4" cols="50"></textarea>
            <br>
            <button type="submit">Adicionar Comentário</button>
            <!-- Exibição do comentário do cliente -->
    <h2>Comentário do Cliente</h2>
    <p><?php echo $reserva->getComentarioCliente(); ?></p>

    <!-- Adicione mais informações da reserva conforme necessário -->
        </form>
    <?php } else { ?>
        <p>O comentário só pode ser adicionado quando a atividade estiver Realizada.</p>
    <?php } ?>

</div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
