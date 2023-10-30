<?php

include '../vendor/autoload.php';

include '../autoloadclass.php';

print_r($_POST);

$conn = MyConnect::getInstance();

$sqli = "SELECT * FROM vendedores WHERE id=".'"'.$_POST['id_vendedor'].'"';

$result = $conn->query($sqli);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        //É criado uma variável, com o valor convertido para inteiro 
        $situacao = $row["situacao"];
    }
}

$ativo = "ATIVO";

$sqli = "UPDATE vendedores SET situacao ='".'ATIVO'."' WHERE id=".'"'.$_POST['id_vendedor'].'"';

$conn->query($sqli);

$mensagem = urlencode('Ativado com sucesso'); //torna o url seguro prevenindo de possíveis erros
header('Location: vendedores.php?sucesso=' . $mensagem);

?>
