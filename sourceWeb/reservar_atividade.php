<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Verifica se o cliente está autenticado
if (!isset($_SESSION['cliente_id']) || !is_numeric($_SESSION['cliente_id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit;
}

// Obtem o ID da atividade a partir dos parâmetros da URL
$atividade_id = $_GET['id'];

// Inicializa a mensagem de erro
$erro = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o cliente está autenticado e o ID do cliente está na sessão
    if (isset($_SESSION['cliente_id']) && is_numeric($_SESSION['cliente_id'])) {
        // Cliente autenticado, continua com a reserva
        $cliente_id = $_SESSION['cliente_id'];

        // Coleta os dados de pagamento
        $numeroCartao = $_POST['numero_cartao'];
        $dataValidade = $_POST['data_validade'];
        $nomeTitular = $_POST['nome_titular'];

        // Validação dos campos
        if (empty($numeroCartao) || empty($dataValidade) || empty($nomeTitular)) {
            $erro = 'Todos os campos são obrigatórios.';
        } elseif (!preg_match('/^\d{16}$/', $numeroCartao)) {
            $erro = 'Número do cartão inválido.';
        } elseif (!preg_match('/^\d{4}-\d{2}$/', $dataValidade)) {
            $erro = 'Data de validade inválida. Utilize o formato AAAA-MM.';
        } else {
            // Cria um objeto Reserva com os dados
            $reserva = new Reserva($cliente_id, $atividade_id, 'Confirmada', $numeroCartao);

            // Salva a reserva no banco de dados
            $reserva->save();
        }
    } else {
        // Exibe uma mensagem de erro
        echo "Você precisa estar logado para fazer uma reserva.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Atividade</title>
    <style>
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            position: relative;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .erro {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .sucesso {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-top: 10px;
            display: none; /* Inicialmente oculta */
        }
    </style>
</head>
<body>
    <form method="post">
        <h1>Reservar Atividade</h1>
        <!-- Exibe a mensagem de erro, se houver -->
        <div class="erro"><?php echo strip_tags($erro); ?></div>

        <!-- Dados de pagamento -->
        <label for="numero_cartao">Número do Cartão de Crédito:</label>
        <input type="text" name="numero_cartao" id="numero_cartao" required>

        <label for="data_validade">Data de Validade (Formato: AAAA-MM):</label>
        <input type="text" name="data_validade" id="data_validade" required placeholder="Ex: 2023-12">

        <label for="nome_titular">Nome do Titular:</label>
        <input type="text" name="nome_titular" id="nome_titular" required>

        <input type="submit" value="Reservar">

        <!-- Exibe a mensagem de sucesso, se houver -->
        <?php if(isset($reserva) && $reserva instanceof Reserva): ?>
            <div class="sucesso">
                Reserva realizada com sucesso! Obrigado por escolher a nossa atividade.
            </div>
        <?php endif; ?>
    </form>

    <script>
//         function validarDataValidade(input) {
//     var dataValidade = input.value;

//     // Verifica se a data de validade é menor ou igual à data atual
//     var hoje = new Date();
//     var anoAtual = hoje.getFullYear();
//     var mesAtual = hoje.getMonth() + 1; // Os meses começam do zero
//     var partesData = dataValidade.split('-');
//     var anoInformado = parseInt(partesData[0], 10);
//     var mesInformado = parseInt(partesData[1], 10);

//     if (anoInformado < anoAtual || (anoInformado === anoAtual && mesInformado < mesAtual)) {
//         alert("Data de validade inválida. Certifique-se de que a data é maior ou igual à data atual.");
//         input.value = ''; // Limpa o campo
//     }
// }

        // Exibe a mensagem de sucesso após a reserva (opcional)
        <?php if(isset($reserva) && $reserva instanceof Reserva): ?>
            document.querySelector('.sucesso').style.display = 'block';
        <?php endif; ?>
    </script>
</body>
</html>

<?php include 'includes/footer.php'; ?>
