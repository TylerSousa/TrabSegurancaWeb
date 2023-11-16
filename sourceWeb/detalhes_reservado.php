<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Obtenha o ID da atividade da URL
$atividade_id = isset($_GET['atividade_id']) ? $_GET['atividade_id'] : null;

// Buscar todas as reservas associadas a esta atividade
$reservas_atividade = Reserva::findReservaPorAtividade($atividade_id);
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

    <?php if (empty($reservas_atividade)) { ?>
        <p>Não há reservas para esta atividade.</p>
    <?php } else { ?>
        <div class="container mt-5">
            <?php foreach ($reservas_atividade as $reserva) { ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Detalhes da Reserva</h5>
                        <p class="card-text"><strong>Nome do Cliente:</strong> <?php echo obterNomeCliente($reserva->getCliente_id()); ?></p>
                        <p class="card-text"><strong>Nome da Atividade:</strong> <?php echo obterNomeAtividade($reserva->getAtividade_id()); ?></p>
                        <p class="card-text"><strong>Status:</strong> <?php echo $reserva->getStatus(); ?></p>
                        <p class="card-text"><strong>Detalhes de Pagamento:</strong> <?php echo $reserva->getDetalhesPagamento(); ?></p>
                        <p class="card-text"><strong>Comentário do Cliente:</strong> <?php echo $reserva->getComentarioCliente(); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php
function obterNomeCliente($cliente_id) {
    // Lógica para obter o nome do cliente com base no ID do cliente
    // Suponha que você tenha um método para buscar o nome do cliente na classe Cliente
    $cliente = Cliente::find($cliente_id);
    return $cliente ? $cliente->getNome() : 'Cliente não encontrado';
}

function obterNomeAtividade($atividade_id) {
    // Lógica para obter o nome da atividade com base no ID da atividade
    // Suponha que você tenha um método para buscar o nome da atividade na classe Atividade
    $atividade = Atividade::find($atividade_id);
    return $atividade ? $atividade->getNome() : 'Atividade não encontrada';
}
?>


</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
