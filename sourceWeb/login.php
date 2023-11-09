<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

if (isset($_SESSION['active'])) {
    header('Location: index.php');
    exit;
}

$erro = "";

if (isset($_GET['erro'])) {
    $erro = urldecode($_GET['erro']);
}

if (isset($_POST['botao']) && $_POST['botao'] === 'Guardar') {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Faça a validação do email e da senha aqui
    if (validarCredenciais($email, $password)) {
        // Credenciais válidas, redirecione para a página principal
        header('Location: index.php');
        exit;
    } else {
        // Credenciais inválidas, exiba uma mensagem de erro
        $erro = "Credenciais inválidas. Tente novamente.";
    }
}
?>

<body>
    <div class="container">
        <?php if (!empty($erro)) { ?>
            <p class="alert alert-danger">
                <?php echo $erro; ?>
            </p>
        <?php } ?>
        <form action="valida_login.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="botao" value="Guardar" class="btn btn-primary">Iniciar Sessão</button>
        </form>
    </div>
</body>

<?php include "./includes/footer.php"; ?>

<?php
// Função para validar as credenciais do usuário
function validarCredenciais($email, $password) {
    // Faça a validação do email e da senha aqui (por exemplo, consultando o banco de dados)
    // Lembre-se de usar funções de hash para armazenar senhas no banco de dados
    // Retorne true se as credenciais forem válidas e false caso contrário
    // Exemplo simples:
    $usuarios = [
        // Substitua pelos usuários reais do banco de dados
        ['email' => 'usuario1@example.com', 'senha' => password_hash('senha1', PASSWORD_DEFAULT)],
        ['email' => 'usuario2@example.com', 'senha' => password_hash('senha2', PASSWORD_DEFAULT)],
    ];

    foreach ($usuarios as $usuario) {
        if ($usuario['email'] === $email && password_verify($password, $usuario['senha'])) {
            return true; // Credenciais válidas
        }
    }

    return false; // Credenciais inválidas
}
?>
