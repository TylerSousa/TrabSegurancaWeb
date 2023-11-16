<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Verifique se o utilizador é um vendedor
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') {
    header('Location: index.php'); // Redirecione para uma página de erro para os vendedores
    exit;
}

$resultados = Atividade::search();

// Verifique se o formulário de pesquisa foi enviado
if (isset($_GET['pesquisa'])) {
    $termoPesquisa = $_GET['pesquisa'];
    $resultados = array_filter($resultados, function ($atividade) use ($termoPesquisa) {
        return stripos($atividade->getNome(), $termoPesquisa) !== false;
    });
}
?>

<div class="container mt-5">
    <div class="row">
        <?php if (isset($_GET['sucesso'])) { ?>
            <p class="alert alert-success">
                <?php echo urldecode($_GET['sucesso']); ?>
            </p>
        <?php } ?>
        <div class="col mt-2">
            <!-- Formulário de pesquisa por nome -->
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por nome">
                    <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                </div>
            </form>

            <table class="table table-striped table-responsive-md">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Data</th>
                        <th scope="col">Localização</th>
                        <th scope="col">Status</th>
                        <th></th>
                        <th></th>
                        <th></th> <!-- Nova coluna para o botão "Info" -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $resultado) { ?>
                        <tr>
                            <td><?php echo $resultado->getNome(); ?></td>
                            <td><?php echo $resultado->getDescricao(); ?></td>
                            <td><?php echo $resultado->getPreco(); ?>€</td>
                            <td><?php echo $resultado->getData(); ?></td>
                            <td><?php echo $resultado->getLocalizacao(); ?></td>
                            <td><?php echo $resultado->getEstado(); ?></td>
                            <td class="text-end">
                                <a href="reservar_atividade.php?id=<?php echo $resultado->getId() ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-book fa-fw"></i> Reservar
                                </a>
                            </td>
                            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') { ?>
                                <td class="text-end">
                                    <a href="eliminar_atividade.php?id=<?php echo $resultado->getId() ?>" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash fa-fw"></i> Eliminar
                                    </a>
                                </td>
                            <?php } ?>
                            <td class="text-end">
                                <a href="detalhes_atividades.php?id=<?php echo $resultado->getId() ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-info-circle fa-fw"></i>
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
