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

// Obtenha as reservas do cliente
$reservas = Reserva::search(['cliente_id' => $cliente_id]);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Reservas</title>
</head>
<body>

<div class="container mt-5">
    <h1>Minhas Reservas</h1>

    <?php if (empty($reservas)) : ?>
        <p>Você ainda não fez nenhuma reserva.</p>
    <?php else : ?>
        <table class="table table-striped table-responsive-md">
            <thead>
                <tr>
                    <th scope="col">Atividade</th>
                    <th scope="col">Status</th>
                    <th scope="col">Info</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva) : ?>
                    <?php
                    // Obtenha o ID do cliente associado à reserva
                    $cliente_id_reserva = $reserva->getCliente_id();

                    // Verifique se o cliente autenticado é o mesmo que fez a reserva
                    if ($cliente_id !== $cliente_id_reserva) {
                        // Se não for o mesmo cliente, ignore esta reserva
                        continue;
                    }
                    ?>
                    <tr>
                        <td>
                            <?php
                            $atividade = Atividade::find($reserva->getAtividade_id());
                            if ($atividade && $atividade->getId()) {
                                echo $atividade->getNome();
                            } else {
                                // Se a atividade não existe, exclua a reserva diretamente
                                Reserva::deleteById($reserva->getId());
                                continue;
                            }
                            ?>
                        </td>
                        <td><?php echo $reserva->getStatus(); ?></td>
                        <td>
                            <a href="detalhes_reservas.php?id=<?php echo $reserva->getId(); ?>"><i class="fas fa-info-circle"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
