<?php

include '../autoloadclass.php';
include '../vendor/autoload.php';
include './includes/top.php';

if(!isset($_SESSION['carrinho'])) {
    header('Location: carrinho.php');

}
$soma = 0;
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
<?php               
                    foreach ($_SESSION['carrinho'] as $prato => $quantidade) {
                    
                    $resultados = Prato::search([
                        ['coluna' => 'id', 'operador' => 'like' ,'valor' => $prato]
                    ]);
                    foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td><?php echo $resultado->getNome();?></td>
                            <td><?php echo $resultado->getTipo(); ?></td>
                            <?php 
                            //Assim com o a chave estrangeira consigo buscar o nome do restaurante
                            $idvendedor = $resultado->getVendedorId();
                            $vendedor = Vendedor::find($idvendedor)?>
                            <td><?php echo $vendedor->getNome(); ?></td>
                            <td><?php echo $vendedor->getMetodosPagamento(); ?></td>
                            <td><?php echo $quantidade ?></td>
                            <td class="text-end"><?php echo number_format(($resultado->getPrice() * $quantidade), 2, ',', ' ');?> €</td>
                        </tr>
                    <?php 
                        //Soma total da encomenda
                        $soma += $resultado->getPrice() * $quantidade;
                        //Vou utilizar este método, para depois ver qual elemento não tem a mesma quantidade dos métodos de pagamento para depois
                        //Imprimir os métodos de pagamento possíveis em que todos os restaurantes têm
                        $metodos_pagamento_segmentado[] = explode(",",$vendedor->getMetodosPagamento());
                        $para_filtrar = [];
                        foreach ($metodos_pagamento_segmentado as $vendedor => $opcoes) {
                            $para_filtrar[] = $opcoes;
                        }

                        $elementCounts = array(
                            "multibanco" => 0,
                            " mbway" => 0,
                            " visa" => 0
                        );
                        
                        // Percorre o array e incrementa o contador para cada elemento desejado
                        foreach ($para_filtrar as $subArray) {
                            foreach ($subArray as $element) {
                                if (isset($elementCounts[$element])) {
                                    $elementCounts[$element]++;
                                } else {
                                    $elementCounts[$element] = 1;
                                }
                            }
                        }
                    ?>                        
        <?php } ?>
        <?php } 

            $metodos_pagamento_final = '';
            $quantmin = min($elementCounts);
            $quantmax = max($elementCounts);
            foreach ($elementCounts as $metodo => $quant) {
                if ($quant !== $quantmin) {
                    //Grava os únicos métodos de pagamento possíveis
                    $metodos_pagamento_final .= $metodo;
                } elseif ($quant === $quantmax) {
                    //Grava todos os métodos de pagamento
                    $metodos_pagamento_final .= $metodo;
                }
            }
            
        ?>
        </tbody>
        </table>
        <div class="col-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Preço Final</th>
                    </tr>
                    <tr>
                        <td><?php echo number_format($soma, 2, ',', ' ');?>€</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Métodos de Pagamento Disponíveis</b></td>
                    </tr>
                    <tr>
                        <td><?php  echo $metodos_pagamento_final ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="listaencomenda.php" class="btn btn-success btn-sm"><i class="fa-regular fa-credit-card"></i> Finalizar Encomenda </a>
        </div>
    </div>


<?php include './includes/footer.php'; ?>