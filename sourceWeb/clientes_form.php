<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

?>

<div class="container">

    <div class="row">
        <div class="class">
            <h2>Registo Cliente</h2>
        </div>
    </div>
    <?php if (isset($_GET['erro'])) { ?> 
        <p class="alert alert-danger"> 
        <?php echo urldecode($_GET['erro']); //a função $_GET fica com a mensagem de erro declarada no valida_login.php ?> </p> 
        <?php } ?>

    <form action="adicionar_cliente.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <label for="name" class="form-label col-2 text-end">Nome</label>
            <div class="col-10">
            <input type="text" name="nome" class="form-control">
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
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Rua</label>
            <div class="col-10">
            <input type="text" name="rua" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Localidade</label>
            <div class="col-10">
            <input type="text" name="localidade" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Código Postal</label>
            <div class="col-10">
            <input type="text" name="codpostal" class="form-control" placeholder="0000-000" pattern="^\d{4}-\d{3}?$">
            </div>            
        </div>



        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">País</label>
            <div class="col-10">
            <input type="text" name="pais" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Telemovel</label>
            <div class="col-10">
            <input type="text" name="telemovel" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">NIF</label>
            <div class="col-10">
            <input type="text" name="NIF" class="form-control">
            </div>            
        </div>

        </div>
        
        <div class="row mt-4">
            <div class="col text-center">
                <input type="submit" value="registar" class="btn btn-primary btn-large" name="botao">
            </div>
        </div>
    </form>

</div>
<?php
include 'includes/footer.php';
?>