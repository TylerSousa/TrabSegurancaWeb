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

//Vou realizar um query logo preciso da instância mysql

$conn = MyConnect::getInstance();

//Conversão de string para int
$perfil_idINT = intval($_POST['perfil_id']);

//Só para não empancar na query
$email = $_POST['email'];


//Versão 1, não quero saber por agora é assim
$perfis_utilizador_temp = 
[
    1 => 'ADMINISTRADOR',
    2 => 'CLIENTE',
    3 => 'VENDEDOR'
];


//Caso o utilizador já existir não adiciono outro
$sqli = "SELECT email FROM utilizadores WHERE email=".'"'.$_POST['email'].'"';

$result = $conn->query($sqli);

if ($result->num_rows > 0 ){
    $mensagem = urlencode('O utilizador já existe'); //torna o url seguro prevenindo de possíveis erros
    header('Location: utilizadores_form.php?erro=' . $mensagem);
}

//Query para sacar o ID do utitlizador criado para logo inserir o valor necessário para a chave estrangeira 
$sqli = "SELECT id FROM perfis WHERE id=".'"'.$perfil_idINT.'"';

$result = $conn->query($sqli);


if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        //É criado uma variável, com o valor convertido para inteiro 
        $idperfil = intval($row["id"]);
    }
}

//Criação de utilizador
$utilizador = new Utilizador($_POST['username'], $_POST['email'], intval($idperfil));

$password_encriptada  = password_hash($_POST['password'], PASSWORD_DEFAULT);

//Para depois adicionar o utilizador certo

if($idperfil === 1) {
    $utilizador->save();

    $sqli = "SELECT id FROM utilizadores WHERE email=".'"'.$_POST['email'].'"';

    $result = $conn->query($sqli);

    if ($result->num_rows > 0) {
    
        while($row = $result->fetch_assoc()) {
            //É criado uma variável, com o valor convertido para inteiro 
            $idutilizador = intval($row["id"]);
        }
    }
    

    $administrador = new Administrador($_POST['email'], $password_encriptada, intval($idutilizador));

    $administrador->save();

} else if($idutilizador === 2) {
    

} else {

}

?>

<div class="container">

        <h1>Utilizador Adicionado com sucesso</h1>
       
        
        <div class="row mt-4">
            <div class="col text-center">
                <a href="utilizadores.php" class="btn btn-primary btn-large" 
                name="botao"><-- Voltar aos Utilizadores</a>
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