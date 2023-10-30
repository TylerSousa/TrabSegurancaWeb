<?php


include 'includes/top.php';

require_once '../autoloadclass.php';

if (isset($_SESSION['active'])){
    header('Location: index.php');
}

?>

<body>

    <div class="container">
        <?php if (isset($_GET['erro'])) { ?> 
        <p class="alert alert-danger"> 
        <?php echo urldecode($_GET['erro']); //a função $_GET fica com a mensagem de erro declarada no valida_login.php ?> </p> 
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

<?php include "./includes/footer.php";