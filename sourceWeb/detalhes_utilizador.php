<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

if (!isset($_SESSION['active'])) {
    header('Location: index.php');
    exit;
}

?>

<div class="container">
    <h2>Ficha de Utilizador</h2>

    <?php
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $utilizador = Utilizador::find($userId);

        if (!empty($utilizador)) {
            $perfilId = $utilizador->getPerfilId();
            $perfil = "";

            if ($perfilId === 1) {
                $perfil = "Administrador";
            } elseif ($perfilId === 2) {
                $perfil = "Cliente";
            } else {
                $perfil = "Vendedor";
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
    <?php
        } else {
            header('Location: 404.html');
            exit;
        }
    } else {
        header('Location: 404.html');
        exit;
    }
    ?>
</div>

<?php
include 'includes/footer.php';
?>
