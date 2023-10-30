<?php

include 'includes/top.php';

require_once '../autoloadclass.php';
/* 
if(!isset($_SESSION['active'])) {
    header('Location: ../index.php');
} */

if (!isset($_POST['botao'])) {
    header('Location: ../index.php');
    exit;
}


echo "<pre>";
print_r($_POST);
echo "</pre>";



$conn = MyConnect::getInstance();

$metodos_pagamento = implode(", ", $_POST['metodos_pagamento']);

echo $metodos_pagamento;

$password_encriptada  = password_hash($_POST['password'], PASSWORD_DEFAULT);

//Criação de utilizador
$utilizador = new Utilizador($_POST['nome'], $_POST['email'], 3);

$utilizador->save();

//Query para sacar o ID do utitlizador criado para logo inserir o valor necessário para a chave estrangeira 

$sqli = "SELECT id FROM utilizadores WHERE email=".'"'.$_POST['email'].'"';


//resultados são guardados numa variável com a query SQL
$result = $conn->query($sqli);


if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        //É criado uma variável, com o valor convertido para inteiro 
        $idutilizador = intval($row["id"]);
    }
}


$sqli = "SELECT id FROM entidades WHERE nome=".'"'.$_POST['nome'].'"';


//resultados são guardados numa variável com a query SQL
$result = $conn->query($sqli);


if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        //É criado uma variável, com o valor convertido para inteiro
        
        $identidade = intval($row["id"]);
    }

    $vendedor = new Vendedor($_POST['nome'], $_POST['email'], $password_encriptada, $_POST['designacao'], $_POST['rua'],'9600-568','', $_POST['localidade']
    , $_POST['pais'], $_POST['nif'], $_POST['situacao'], $_POST['hora_abertura'], $_POST['hora_fecho'], $_POST['dias_takeaway'], 
    $_POST['dias_fechado'],$metodos_pagamento,$_POST['telefone'], $_POST['url'], $_POST['nome_responsavel'], $_POST['telefone_responsavel'], $idutilizador, $identidade);
    $vendedor->save();
} else {
    echo "<br>";
    echo "não encontrou entidade";


    $entidade = new Entidade($_POST['nome'], $_POST['nif'] ,$_POST['pais']);
    $entidade->save();
    
    

    $sqli = "SELECT id FROM entidades WHERE nome=".'"'.$_POST['nome'].'"';

    //resultados são guardados numa variável com a query SQL
    $result = $conn->query($sqli);


    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        //É criado uma variável, com o valor convertido para inteiro
        $identidade = intval($row["id"]);
    }



    $vendedor = new Vendedor($_POST['nome'], $_POST['email'], $password_encriptada, $_POST['designacao'], $_POST['rua'],'9600-568','', $_POST['localidade']
    , $_POST['pais'], $_POST['nif'], $_POST['situacao'], $_POST['hora_abertura'], $_POST['hora_fecho'], $_POST['dias_takeaway'], 
    $_POST['dias_fechado'],$metodos_pagamento,$_POST['telefone'], $_POST['url'], $_POST['nome_responsavel'], $_POST['telefone_responsavel'], $idutilizador, $identidade);

    $vendedor->save();
    }

}




?>

<div class="container">

        <h1>Registo gravado</h1>
       
        
        <div class="row mt-4">
            <div class="col text-center">
                <a href="utilizadores.php" class="btn btn-primary btn-large" 
                name="botao"><-- Voltar à página inicial</a>
            </div>
        </div>

</div>

<?php


include './includes/footer.php';

// tinha que validar o formulário

// Ver se existe ficheiro
// if (!empty($_FILES) && $_FILES['image']['size'] != 0) {
    
//     if (file_exists($_FILES['image']['tmp_name'])) {
//         copy($_FILES['image']['tmp_name'], 'assets/pratos/' . $_FILES['image']['name']);
//     }
// }

// $prato = new Prato($_POST['name'], 'assets/pratos/' . $_FILES['image']['name'], $_POST['price']);
// $prato->save();

?>
