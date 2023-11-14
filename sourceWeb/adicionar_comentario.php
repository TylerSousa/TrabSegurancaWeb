<?php
// adicionar_comentario.php

require_once '../autoloadclass.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Certifique-se de que os dados do formulário estão presentes e são válidos
    if (isset($_POST['reserva_id'], $_POST['comentario']) && is_numeric($_POST['reserva_id'])) {
        $reserva_id = $_POST['reserva_id'];
        $comentario = $_POST['comentario'];

        // Encontre a reserva
        $reserva = Reserva::find($reserva_id);

        if ($reserva) {
            // Adicione o comentário à reserva
            $reserva->setComentarioCliente($comentario);

            // Somente salve o comentário, não a reserva inteira novamente
            $reserva->saveComentario();

            // Redirecione de volta para a página de reservas
            header('Location: minhas_reservas.php');
            exit;
        } else {
            echo "Reserva não encontrada.";
        }
    } else {
        echo "Dados do formulário inválidos.";
    }
} else {
    echo "Acesso inválido ao script.";
}
?>
