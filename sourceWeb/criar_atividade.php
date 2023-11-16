<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Verifique se o vendedor está autenticado
if (!isset($_SESSION['vendedor_id']) || !is_numeric($_SESSION['vendedor_id'])) {
    header('Location: login.php'); // Redirecione para a página de login se não estiver autenticado
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $data = $_POST['data'];
    $localizacao = $_POST['localizacao'];

    // Obtenha o vendedor_id da sessão
    $vendedor_id = $_SESSION['vendedor_id'];

    // Crie uma nova instância de MyConnect para obter uma conexão com o banco de dados
    $db = MyConnect::getInstance();

// Execute a inserção de dados na tabela 'atividades' incluindo o vendedor_id e definindo o status como "confirmado"
$query = "INSERT INTO atividades (nome, descricao, preco, data, localizacao, vendedor_id, status) VALUES (?, ?, ?, ?, ?, ?, 'confirmado')";
$stmt = $db->prepare($query);

// Ajuste o bind_param para incluir o novo campo 'status'
$stmt->bind_param("ssdsss", $nome, $descricao, $preco, $data, $localizacao, $vendedor_id);

if ($stmt->execute()) {
    // Inserção bem-sucedida, redirecione para uma página de sucesso ou outra página
    header("Location: minhas_atividades.php?sucesso=Atividade criada com sucesso");
    exit();
} else {
    // Erro ao inserir a atividade, redirecione para uma página de erro
    header("Location: criar_atividade.php?erro=Erro ao criar a atividade");
    exit();
}
}

?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Criar Atividade</h2>
        </div>
    </div>

    <form action="criar_atividade.php" method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">Preço:</label>
        <input type="text" name="preco" class="form-control" pattern="\d+(\.\d+)?" title="Digite um número válido" required>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data:</label>
        <input type="date" name="data" class="form-control" pattern="\d{4}-\d{2}-\d{2}" required>
    </div>

    <div class="mb-3">
        <label for="localizacao" class="form-label">Localização:</label>
        <input type="text" name="localizacao" class="form-control" required>
    </div>

    <div class="row mt-4">
        <div class="col text-center">
            <input type="submit" value="Criar Atividade" class="btn btn-primary btn-large" name="botao">
        </div>
    </div>
</form>

</div>

<?php
include 'includes/footer.php';
?>
