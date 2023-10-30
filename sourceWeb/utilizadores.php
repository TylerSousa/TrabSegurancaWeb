<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

/* if(!isset($_SESSION['active'])) {
    header('Location: ../index.php');
} */


?>

<div class="container">

<?php if(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') { ?>

    <div class="row">
        <div class="col">
            <a href="utilizadores_form.php" class="btn btn-primary">Adicionar Utilizador</a>
        </div>
    </div>

 <?php } ?>
    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $resultados = Utilizador::search([
                            //['coluna' => 'email', 'operador' => 'like' ,'valor' => '%uac%']
                        ]);
                        foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td><?php echo $resultado->getNome();?></td>
                            <td><?php echo $resultado->getEmail();?></td>
                            <td class="text-end">
                                <a href="detalhes_utilizador.php?id=<?php echo $resultado->getId() ?>" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-info fa-fw"></i>
                                </a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>    
</div>
<?php

include 'includes/footer.php';