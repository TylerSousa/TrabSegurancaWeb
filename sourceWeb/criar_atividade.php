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

    // Execute a inserção de dados na tabela 'atividades' incluindo o vendedor_id
    $query = "INSERT INTO atividades (nome, descricao, preco, data, localizacao, vendedor_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssdssi", $nome, $descricao, $preco, $data, $localizacao, $vendedor_id);

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
        <div class="row mt-2">
            <label for="nome" class="form-label col-2 text-end">Nome</label>
            <div class="col-10">
                <input type="text" name="nome" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <label for="descricao" class="form-label col-2 text-end">Descrição</label>
            <div class="col-10">
                <textarea name="descricao" class="form-control" rows="4" required></textarea>
            </div>
        </div>

        <div class="row mt-2">
            <label for="preco" class="form-label col-2 text-end">Preço</label>
            <div class="col-10">
                <input type="text" name="preco" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <label for="data" class="form-label col-2 text-end">Data</label>
            <div class="col-10">
                <input type="date" name="data" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <label for="localizacao" class="form-label col-2 text-end">Localização</label>
            <div class="col-10">
                <input type="text" name="localizacao" class="form-control" required>
            </div>
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
