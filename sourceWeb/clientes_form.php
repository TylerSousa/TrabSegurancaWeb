<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

if (isset($_GET['erro'])) {
    $erroMensagem = urldecode($_GET['erro']);
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Registo Cliente</h2>
        </div>
    </div>
    <?php if (isset($erroMensagem)) { ?> 
        <p class="alert alert-danger">
            <?php echo $erroMensagem; // Mostra a mensagem de erro em caso de problema ?>
        </p>
    <?php } ?>

    <form action="adicionar_cliente.php" method="post" enctype="multipart/form-data">
        <div class="row mt-2">
            <label for="nome" class="form-label col-2 text-end">Nome</label>
            <div class="col-10">
                <input type="text" name="nome" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="email" class="form-label col-2 text-end">Email</label>
            <div class="col-10">
                <input type="email" name="email" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="password" class="form-label col-2 text-end">Password</label>
            <div class="col-10">
                <input type="password" name="password" class="form-control">
            </div> 
        </div>

        <div class="row mt-4">
            <div class="col text-center">
                <input type="submit" value="Registar" class="btn btn-primary btn-large" name="botao">
            </div>
        </div>
    </form>
</div>

<?php
include 'includes/footer.php';
?>
