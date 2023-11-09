<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Obtenha o ID do cliente da sessão
$cliente_id = $_SESSION['cliente_id'];

// Obtenha as reservas do cliente
$reservas = Reserva::search(['cliente_id' => $cliente_id]);

?>

<h1>Minhas Reservas</h1>

<table>
    <tr>
        <th>Atividade</th>
        <th>Status</th>
    </tr>
    <?php foreach ($reservas as $reserva) { ?>
        <tr>
            <td>
                <?php
                $atividade = Atividade::find($reserva->getAtividade_id());
                echo $atividade->getNome();
                ?>
            </td>
            <td><?php echo $reserva->getStatus(); ?></td>
        </tr>
    <?php } ?>
</table>

<?php include 'includes/footer.php'; ?>
