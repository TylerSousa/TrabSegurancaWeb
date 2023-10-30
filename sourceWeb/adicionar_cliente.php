<?php

include 'includes/top.php';

require_once '../autoloadclass.php';
/* 
if(!isset($_SESSION['active'])) {
    header('Location: index.php');
} */

if (!isset($_POST['botao'])) {
    header('Location: index.php');
    exit;
}

//Vou realizar um query logo preciso da instância mysql

$conn = MyConnect::getInstance();


$sqli = "SELECT id FROM utilizadores WHERE email=".'"'.$_POST['email'].'"';


//resultados são guardados numa variável com a query SQL
$result = $conn->query($sqli);


if ($result->num_rows > 0) {

    $mensagem = urlencode('O utilizador já existe'); //torna o url seguro prevenindo de possíveis erros
    header('Location: clientes_form.php?erro=' . $mensagem);
}

echo "<pre>";
print_r($_POST);
echo "</pre>";


$password_encriptada  = password_hash($_POST['password'], PASSWORD_DEFAULT);

//Criação de utilizador
$utilizador = new Utilizador($_POST['nome'], $_POST['email'], 2);

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

$cliente = new Cliente($_POST['nome'], $_POST['rua'],'',$_POST['codpostal'],$_POST['localidade'], $_POST['pais'], $_POST['telemovel'],
$_POST['NIF'], $_POST['email'], $password_encriptada, 'ATIVO', $idutilizador );

$cliente->save();


?>

<div class="container">

        <h1>Registado com sucesso</h1>
       
        
        <div class="row mt-4">
            <div class="col text-center">
                <a href="login.php" class="btn btn-primary btn-large" 
                name="botao">Iniciar Sessão</a>
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