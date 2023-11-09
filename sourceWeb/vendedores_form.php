<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

if (isset($_GET['erro'])) {
    $erroMensagem = urldecode($_GET['erro']);
}
?>

<div class="container">
    <div class="row">
        <div class="class">
            <h2>Registo Vendedores</h2>
        </div>
    </div>
    <?php if (isset($erroMensagem)) { ?> 
        <p class="alert alert-danger">
            <?php echo $erroMensagem; // Mostra a mensagem de erro em caso de problema ?>
        </p>
    <?php } ?>

    <form action="adicionar_vendedor.php" method="post" enctype="multipart/form-data">
        <div class="row mt-2">
            <label for="nome" class="form-label col-2 text-end">Nome</label>
            <div class="col-10">
                <input type="text" name="nome" class="form-control" required>
            </div>            
        </div>

        <div class="row mt-2">
            <label for="email" class="form-label col-2 text-end">Email</label>
            <div class="col-10">
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="row mt-2">
            <label for="password" class="form-label col-2 text-end">Password</label>
            <div class="col-10">
                <input type="password" name="password" class="form-control" required>
            </div> 
        </div>

        <!-- Outros campos de entrada conforme necessário -->

        <!-- Checkbox de métodos de pagamento -->

        <!-- Situação do vendedor (somente para administradores) -->
        <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') { ?>
            <div class="row mt-2">
                <label for="situacao" class="form-label col-2 text-end">Situação</label>
                <div class="col-10">
                    <select name="situacao" class="form-select" required>
                        <option value="ATIVO">Ativo</option>
                        <option value="PENDENTE">Pendente</option>
                    </select>
                </div>
            </div>
        <?php } else { ?>
            <input type="hidden" name="situacao" value="PENDENTE">
        <?php } ?>

        <!-- Restante dos campos conforme necessário -->

        <div class="row mt-4">
            <div class="col text-center">
                <input type="submit" value="Registar" class="btn btn-primary btn-large" name="botao">
            </div>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
