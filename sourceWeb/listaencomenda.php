<?php
include '../autoloadclass.php';
include '../vendor/autoload.php';
include './includes/top.php';

// Verifique se a sessão carrinho não está vazia
if (!isset($_SESSION['carrinho'])) {
    header('Location: carrinho.php');
    exit;
}

$soma = 0;
$metodos_pagamento_segmentado = [];

// Crie uma função para calcular o preço total
function calcularPrecoTotal($quantidade, $preco) {
    return $quantidade * $preco;
}

?>

<div class="container">
    <h1>Ficha da Encomenda Final</h1>

    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Vendedor</th>
                        <th>Métodos Pagamento</th>
                        <th>Quantidade</th>
                        <th class="text-end">Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['carrinho'] as $prato => $quantidade) {
                        $resultados = Prato::search([['coluna' => 'id', 'operador' => 'like', 'valor' => $prato]]);
                        foreach ($resultados as $resultado) {
                            $vendedor = Vendedor::find($resultado->getVendedorId());
                            $metodos_pagamento = explode(",", $vendedor->getMetodosPagamento());
                            $metodos_pagamento_segmentado[] = $metodos_pagamento;
                    ?>
                        <tr>
                            <td><?php echo $resultado->getNome(); ?></td>
                            <td><?php echo $resultado->getTipo(); ?></td>
                            <td><?php echo $vendedor->getNome(); ?></td>
                            <td><?php echo $vendedor->getMetodosPagamento(); ?></td>
                            <td><?php echo $quantidade ?></td>
                            <td class="text-end">
                                <?php
                                $precoTotal = calcularPrecoTotal($quantidade, $resultado->getPrice());
                                $soma += $precoTotal;
                                echo number_format($precoTotal, 2, ',', ' '); ?> €
                            </td>
                        </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            <div class="col-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Preço Final</th>
                        </tr>
                        <tr>
                            <td><?php echo number_format($soma, 2, ',', ' '); ?>€</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Métodos de Pagamento Disponíveis</b></td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $elementCounts = array_count_values(array_merge(...$metodos_pagamento_segmentado));
                                $metodos_pagamento_final = implode(", ", array_keys($elementCounts, max($elementCounts)));
                                echo $metodos_pagamento_final;
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="listaencomenda.php" class="btn btn-success btn-sm">
                    <i class="fa-regular fa-credit-card"></i> Finalizar Encomenda
                </a>
            </div>
        </div>
    </div>
</div>
<?php include './includes/footer.php'; ?>
