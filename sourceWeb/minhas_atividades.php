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

if (isset($_GET['pesquisa'])) {
    $termoPesquisa = $_GET['pesquisa'];
    $resultados = array_filter($resultados, function ($atividade) use ($termoPesquisa) {
        return stripos($atividade->getNome(), $termoPesquisa) !== false;
    });
}
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
                        <th scope="col">Status</th> <!-- Nova coluna para o botão "Info" -->
                        <th scope="col"></th>
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
                                <td>
    <form action="alterar_status_atividade.php" method="post" class="d-flex align-items-center">
        <input type="hidden" name="atividade_id" value="<?php echo $resultado->getId(); ?>">
        <select name="novo_estado" class="form-select form-select-sm me-2">
            <option value="confirmado" <?php echo ($resultado->getEstado() === 'confirmado') ? 'selected' : ''; ?>>Confirmado</option>
            <option value="realizada" <?php echo ($resultado->getEstado() === 'realizada') ? 'selected' : ''; ?>>Realizada</option>
            <option value="adiada" <?php echo ($resultado->getEstado() === 'adiada') ? 'selected' : ''; ?>>Adiada</option>
            <option value="cancelada" <?php echo ($resultado->getEstado() === 'cancelada') ? 'selected' : ''; ?>>Cancelada</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
    </form>
</td>


                                <td>
    <?php
    // Lógica para buscar as reservas associadas à atividade
    $reservas_atividade = Reserva::search(['atividade_id' => $resultado->getId()]);
    if (!empty($reservas_atividade)) {
        echo '<a href="detalhes_reservado.php?atividade_id=' . $resultado->getId() . '" class="btn btn-primary btn-sm"><i class="fas fa-book fa-fw"></i> Reservas</a>';
    } else {
        echo 'Sem reservas';
    }
    ?>
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
