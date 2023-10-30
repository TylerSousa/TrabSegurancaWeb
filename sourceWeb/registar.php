
<?php

    include 'includes/top.php';

?>
<style>
    .icone{
        height: 150px;
        width: auto;

        padding: 1rem;
    }
</style>
<div class="container">
    <h1>Página de Registo - quem é?</h1>
        <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Cliente</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <img class="icone" src="../sourceWeb/assets/icons/pessoas.png" alt="">
                </div>
                <a href="clientes_form.php" class="w-100 btn btn-lg btn-outline-primary">Sim, tenho fome</a>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Vendedor</h4>
            </div>
            <div class="card-body">
                <div class="container">
                    <img class="icone" src="" alt="">
                </div>
                <a href="vendedores_form.php" class="w-100 btn btn-lg btn-primary">Sim, sou mais uma opção</a>
            </div>
            </div>
        </div>
        </div>
    </form>
</div>

<?php

    include 'includes/footer.php';

?>