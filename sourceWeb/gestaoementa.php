<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

 if($_SESSION['perfil'] !== 'VENDEDOR') {
    header('Location: index.php');
} 

?>


<div class="container">
    <?php if(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR' || isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') { ?>
        <div class="row">
            <div class="col">
                <a href="prato_form.php" class="btn btn-primary">Adicionar Prato</a>
            </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Estado</th>
                        <th class="text-end">Preço</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                         $Vendedor = Vendedor::search([
                            ['coluna' => 'email', 'operador' => 'like' ,'valor' => $_SESSION['utilizador']]
                        ]);

                        foreach ($Vendedor as $campo) {
                            $idVendedor = intval($campo->getId());
                        }

                        $resultados = Prato::search([
                            ['coluna' => 'vendedor_id', 'operador' => 'like' ,'valor' => $idVendedor]
                        ]);
                        foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td><?php echo $resultado->getNome();?></td>
                            <td><?php echo $resultado->getEstado();?></td>
                            <td class="text-end"><?php echo number_format($resultado->getPrice(), 2, ',', ' ');?> €</td>
                            <td class="text-end">
                                <a href="detalhes_prato.php?id=<?php echo $resultado->getId() ?>" class="btn btn-primary btn-sm">
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

?>