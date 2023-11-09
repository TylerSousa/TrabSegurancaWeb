<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Obtenha o ID da atividade a partir dos parâmetros da URL
$atividade_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o cliente está autenticado e o ID do cliente está na sessão
    if (isset($_SESSION['cliente_id']) && is_numeric($_SESSION['cliente_id'])) {
        // Cliente autenticado, continue com a reserva
        $cliente_id = $_SESSION['cliente_id'];

        // Lidar com o envio do formulário (validação, processamento dos dados, etc.)

        // Exemplo de coleta dos dados de pagamento
        $numeroCartao = $_POST['numero_cartao'];
        $dataValidade = $_POST['data_validade'];
        $nomeTitular = $_POST['nome_titular'];

        // Crie um objeto Reserva com os dados
        $reserva = new Reserva($cliente_id, $atividade_id, 'Confirmada', "Detalhes de pagamento aqui");

        // Salve a reserva no banco de dados
        $reserva->save();

        // Exiba uma mensagem de confirmação para o usuário
        echo "Reserva realizada com sucesso!";
    } else {
        // Exiba uma mensagem de erro
        echo "Você precisa estar logado para fazer uma reserva.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Reserva</title>
</head>
<body>
    <h1>Reservar Atividade</h1>
    <form method="post">
        <!-- Outros campos do formulário, como nome, email, etc. -->

        <!-- Dados de pagamento -->
<label for="numero_cartao">Número do Cartão de Crédito:</label>
<input type="text" name="numero_cartao" id="numero_cartao" required>
<br>
<label for="data_validade">Data de Validade:</label>
<input type="text" name="data_validade" id="data_validade" required>
<br>
<label for="nome_titular">Nome do Titular:</label>
<input type="text" name="nome_titular" id="nome_titular" required>
<br>


        <input type="submit" value="Reservar">
    </form>
</body>
</html>

<?php include 'includes/footer.php'; ?>
