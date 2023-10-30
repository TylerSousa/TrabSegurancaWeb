<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

if(!isset($_SESSION['active'])) {
    header('Location: index.php');
}


?>

<div class="container">

    <div class="row">
        <div class="class">
            <h2>Adicionar Utilizador</h2>
        </div>
    </div>
    <?php if (isset($_GET['erro'])) { ?> 
        <p class="alert alert-danger"> 
        <?php echo urldecode($_GET['erro']); //a função $_GET fica com a mensagem de erro declarada no valida_login.php ?> </p> 
        <?php } ?>

    <form action="adicionar_utilizadores.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <label for="name" class="form-label col-2 text-end">Nome</label>
            <div class="col-10">
            <input type="text" name="username" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="price" class="form-label col-2 text-end">Email</label>
            <div class="col-10">
            <input type="email" name="email" class="form-control">
            </div>            
        </div>


        <div class="row mt-2">
            <label for="image" class="form-label col-2 text-end">Password</label>
            <div class="col-10">
            <input type="password" name="password" class="form-control">
            </div> 

            <div>
                
            <input type="radio" class="btn-check" value="1" name="perfil_id" id="btnradio1" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio1">Administrador</label>

            <input type="radio" class="btn-check" value="2" name="perfil_id" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Cliente</label>

            <input type="radio" class="btn-check" value="3" name="perfil_id" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Vendedor</label>

            </div>

        </div>

       
        
        <div class="row mt-4">
            <div class="col text-center">
                <input type="submit" value="Guardar" class="btn btn-primary btn-large" name="botao">
            </div>
        </div>
    </form>

</div>
<?php
include './includes/footer.php';