<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

?>

<div class="container">

<?php if (isset($_SESSION['perfil'])) { ?>
    <div class="row">
        <div class="col mb-2">
            <?php if ($_SESSION['perfil'] === 'ADMINISTRADOR') { ?>
                <a href="vendedores_form.php" class="btn btn-primary">Adicionar Vendedor</a>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<div class="row">
    <?php if (isset($_GET['sucesso'])) { ?> 
        <p class="alert alert-success"> 
            <?php echo urldecode($_GET['sucesso']); ?>
        </p>
    <?php } ?>

    <div class="col mt-2">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Utilizador ID</th>
                    <!-- Adicione as colunas necessárias com base no modelo -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultados = [];
                
                if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') {
                    $resultados = Administrador::search([
                        // Seu critério de pesquisa para administradores aqui
                    ]);
                } elseif (isset($_SESSION['perfil'])) {
                    // Você precisa modificar esta parte para buscar dados de outros perfis
                }

                foreach ($resultados as $resultado) {
                ?>
                    <tr>
                        <td><?php echo $resultado->getNome(); ?></td>
                        <td><?php echo $resultado->getEmail(); ?></td>
                        <td><?php echo $resultado->getUtilizadorId(); ?></td>
                        <!-- Adicione a exibição de outras colunas com base no modelo -->
                        <td class="text-end">
                            <a href="detalhes_administrador.php?id=<?php echo $resultado->getId() ?>" class="btn btn-primary btn-sm">
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

<?php include 'includes/footer.php'; ?>
