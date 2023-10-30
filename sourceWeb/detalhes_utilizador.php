<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

if(!isset($_SESSION['active'])) {
    header('Location: index.php');
}

?>

<div class="container">

<h2>Ficha de Utilizador</h2>

<?php 
    echo "Utilizador com id " . $_GET['id'];

    $utilizador = Utilizador::find($_GET['id']);
    
    $perfil = $utilizador->getPerfilId();

    if($perfil === 1 ){
        $perfil = "Administrador";
    } else if ($perfil === 2) {
        $perfil = "Cliente";
    } else {
        $perfil = "Vendedor";
    }

    if (empty($utilizador)) {
        header('Location: 404.html');
        exit;
    }
?>    

<div class="row">
    <div class="col">
        <table class="table table-hover table-bordered table-striped">
            <tr>
                <th>Nome</th>
                <td><?php echo $utilizador->getNome(); ?></td>
            </tr>
            <tr>
                <th>Perfil</th>
                <td><?php echo $perfil; ?></td>
            </tr>
        </table>
    </div>
</div>


</div>
<?php

include 'includes/footer.php';