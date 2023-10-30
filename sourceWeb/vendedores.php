<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

?>

<div class="container">

<?php if(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') { ?>
    <div class="row">
        <div class="col mb-2">
            <a href="vendedores_form.php" class="btn btn-primary">Adicionar Vendedor</a>
        </div>
    </div>
<?php } ?>
    <div class="row">
            <?php if (isset($_GET['sucesso'])) { ?> 
            <p class="alert alert-success"> 
            <?php echo urldecode($_GET['sucesso']);?> </p> 
            <?php } ?>
        <div class="col mt-2">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Situacao</th>
                        <th>Hora Abertura</th>
                        <th>Hora Fecho</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php if(isset($_SESSION)){ ?>          

                            <?php  
                            if(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') {
                            $resultados = Vendedor::search([
                                //['coluna' => 'situacao', 'operador' => 'like' ,'valor' => 'ATIVO']
                            ]);?>

                            <?php foreach ($resultados as $resultado) { ?>

                            <tr>
                            <td><?php echo $resultado->getNome();?></td>
                            <td><?php echo $resultado->getSituacao();?></td>
                            <td><?php echo $resultado->getHoraAbertura();?></td>
                            <td><?php echo $resultado->getHoraFecho();?></td>
                                <td class="text-end">
                                    <a href="detalhes_vendedor.php?id=<?php echo $resultado->getId() ?>" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-info fa-fw"></i>
                                    </a>
                                </td>
                        
                            <?php } ?>
                            </tr>
                        <?php } else if(!isset($_SESSION['perfil']) || $_SESSION['perfil'] !== 'ADMINISTRADOR') { ?>

                            <?php 
                                $resultados = Vendedor::search([
                                    ['coluna' => 'situacao', 'operador' => 'like' ,'valor' => 'ATIVO']
                                ]);
                                foreach ($resultados as $resultado) {
                            ?>
                                <tr>
                                    <td><?php echo $resultado->getNome();?></td>
                                    <td><?php echo $resultado->getSituacao();?></td>
                                    <td><?php echo $resultado->getHoraAbertura();?></td>
                                    <td><?php echo $resultado->getHoraFecho();?></td>

                                    <td class="text-end">
                                        <a href="detalhes_vendedor.php?id=<?php echo $resultado->getId() ?>" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-info fa-fw"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                        <?php } ?>
                 <?php } ?>
                </tbody>
            </table>
        </div>
    </div>    
</div>
<?php

include 'includes/footer.php';