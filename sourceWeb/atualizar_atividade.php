<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'VENDEDOR') {
    header('Location: login.php');
    exit;
}

// Obtém o ID da atividade da URL
$atividade_id = isset($_GET['id']) ? $_GET['id'] : null;

// Obtém os detalhes da atividade
$atividade = Atividade::find($atividade_id);

// Inicializa as variáveis para armazenar mensagens de erro e sucesso
$erro = '';
$sucesso = '';

$conexao = MyConnect::getInstance();

// Processa o formulário de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['novo_nome'];
    $novaDescricao = $_POST['nova_descricao'];
    $novoPreco = $_POST['novo_preco'];
    $novaData = $_POST['nova_data'];
    $novaLocalizacao = $_POST['nova_localizacao'];

    // Realiza as validações necessárias antes de atualizar
    if (empty($novoNome) || empty($novaDescricao) || empty($novoPreco) || empty($novaData) || empty($novaLocalizacao)) {
        $erro = 'Todos os campos são obrigatórios.';
    } else {
        // Atualiza os dados da atividade
        $query = "UPDATE atividades SET nome=?, descricao=?, preco=?, data=?, localizacao=? WHERE id=?";
        
        // Prepara a declaração
        $stmt = $conexao->prepare($query);
        
        // Associa os parâmetros
        $stmt->bind_param("ssdssi", $novoNome, $novaDescricao, $novoPreco, $novaData, $novaLocalizacao, $atividade_id);
        
        // Executa a declaração
        $stmt->execute();

        // Verifica se a atualização foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            // Define a mensagem de sucesso
            $sucesso = 'Atividade atualizada com sucesso!';
        } else {
            $erro = 'Falha ao atualizar a atividade.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Atividade</title>
</head>
<body>

    <div class="container mt-5">
        <h1>Atualizar Atividade</h1>

        <?php if ($atividade) { ?>
            <form method="post">
    <div class="mb-3">
        <label for="novo_nome" class="form-label">Novo Nome:</label>
        <input type="text" class="form-control" id="novo_nome" name="novo_nome" value="<?php echo $atividade->getNome(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="nova_descricao" class="form-label">Nova Descrição:</label>
        <textarea class="form-control" id="nova_descricao" name="nova_descricao" required><?php echo $atividade->getDescricao(); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="novo_preco" class="form-label">Novo Preço:</label>
        <input type="text" class="form-control" id="novo_preco" name="novo_preco" value="<?php echo $atividade->getPreco(); ?>" pattern="[0-9]*" required>
        <div class="invalid-feedback">Por favor, insira apenas números.</div>
    </div>
    <div class="mb-3">
        <label for="nova_data" class="form-label">Nova Data:</label>
        <input type="date" name="nova_data" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="nova_localizacao" class="form-label">Nova Localização:</label>
        <input type="text" class="form-control" id="nova_localizacao" name="nova_localizacao" value="<?php echo $atividade->getLocalizacao(); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>


<!-- Exibe mensagens de erro ou sucesso -->
<?php if ($erro) { ?>
    <div class="alert alert-danger mt-3"><?php echo $erro; ?></div>
<?php } elseif ($sucesso) { ?>
    <div class="alert alert-success mt-3"><?php echo $sucesso; ?></div>
<?php } ?>
<?php } else { ?>
    <p>Atividade não encontrada.</p>
<?php } ?>

<?php
include 'includes/footer.php';
?>






