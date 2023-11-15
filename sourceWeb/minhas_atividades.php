<?php
include 'includes/top.php';
require_once '../autoloadclass.php';

// Verifique se o cliente está autenticado
if (!isset($_SESSION['vendedor_id']) || !is_numeric($_SESSION['vendedor_id'])) {
    header('Location: login.php'); // Redirecione para a página de login se não estiver autenticado
    exit;
}

$vendedor_id = $_SESSION['vendedor_id'];

// Obtenha as atividades do vendedor
$atividades = Atividade::search(['vendedor_id' => $vendedor_id]);

// Renomeie $atividades para $resultados para corresponder ao seu código existente
$resultados = $atividades;
?>

<div class="container mt-3"> <!-- Adicionado container aqui -->
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
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th> <!-- Nova coluna para o botão "Info" -->
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
                <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') { ?>
                    <td class="text-end">
                        <a href="eliminar_atividade.php?id=<?php echo $resultado->getId() ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash fa-fw"></i> Eliminar
                        </a>
                    </td>
                    <td class="text-end">
                        <a href="detalhes_atividades.php?id=<?php echo $resultado->getId() ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-info-circle fa-fw"></i>
                        </a>
                    </td>
                    <td class="text-end">
                        <!-- Novo botão para alterar o estado -->
                        <a href="alterar_estado_atividade.php?id=<?php echo $resultado->getId() ?>" class="btn btn-secondary btn-sm">
                            Alterar Estado
                        </a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
