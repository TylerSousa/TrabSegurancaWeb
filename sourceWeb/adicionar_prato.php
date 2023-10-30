<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

if (!isset($_POST['botao'])) {
    header('Location: index.php');
    exit;
}

if(!isset($_SESSION['active'])) {
    header('Location: ../index.php');
}


// tinha que validar o formulário

echo "<pre>";
echo print_r($_POST);
echo "</pre>"; 


// Ver se existe ficheiro
if (!empty($_FILES) && $_FILES['image']['size'] != 0) {
    
    if (file_exists($_FILES['image']['tmp_name'])) {
        copy($_FILES['image']['tmp_name'], 'assets/pratos/' . $_FILES['image']['name']);
    }
}


if($_POST['botao'] === 'Guardar') {

    $prato = new Prato($_POST['name'],$_POST['descricao'], 'assets/pratos/' . $_FILES['image']['name'],$_POST['tipo_prato'], $_POST['price'], $_POST['estado'], $_POST['id_vendedor']);

    $prato->save();

?>

<h1>Prato adcionado com sucesso!</h1>

<?php

} else if ($_POST['botao'] === 'Atualizar') {

    $conn = MyConnect::getInstance();

    $sqli = "UPDATE pratos SET nome='".$_POST['name']."', descricao='".$_POST['descricao']."', estado='".$_POST['estado']."',
    price='".$_POST['price']."', imageFilename='".'assets/pratos/'.$_FILES['image']['name']."', tipo='".$_POST['tipo_prato']."', vendedor_id='".$_POST['id_vendedor']."' WHERE id=".'"'.$_POST['idprato'].'"';

    $conn->query($sqli);



?>

<h1>Prato atualizado com sucesso!</h1>

<?php
}
    include './includes/footer.php';

?>