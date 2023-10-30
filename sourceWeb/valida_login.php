<?php

include 'includes/top.php';

require_once '../autoloadclass.php';

require_once '../vendor/autoload.php';

use Carbon\Carbon;

if ($_POST['email'] == '') {
    $mensagem = urlencode('Utilizador/palavra-passe inválidos'); //torna o url seguro prevenindo de possíveis erros
    header('Location: login.php?erro=' . $mensagem);

} else if ($_POST['password'] == '' ) {
    $mensagem = urlencode('Utilizador/palavra-passe inválidos'); //torna o url seguro prevenindo de possíveis erros
    header('Location: login.php?erro=' . $mensagem);
}

if (!isset($_SESSION['active'])) {
    //Vou realizar um query logo preciso da instância mysql

    $conn = MyConnect::getInstance();

    //Query para sacar o ID do utitlizador criado para logo inserir o valor necessário para a chave estrangeira 

    $sqli_admins = "SELECT email,password,utilizador_id FROM administradores WHERE email=".'"'.$_POST['email'].'"';
    $sqli_vendedores = "SELECT email,password,situacao, utilizador_id FROM vendedores WHERE email=".'"'.$_POST['email'].'"';
    $sqli_clientes = "SELECT email,password,utilizador_id FROM clientes WHERE email=".'"'.$_POST['email'].'"';
    //resultados são guardados numa variável com a query SQL

    $result_admins = $conn->query($sqli_admins);
    $result_vendedores = $conn->query($sqli_vendedores);
    $result_clientes = $conn->query($sqli_clientes);

        if ($result_admins->num_rows > 0) {
            while ($row = $result_admins->fetch_assoc()) {
                $hashed_password = $row["password"];
                $utilizador_id = $row["utilizador_id"];
            }

            if(password_verify($_POST['password'], $hashed_password)){
                
                $_SESSION['utilizador'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['perfil'] = 'ADMINISTRADOR';
                $_SESSION['active'] = true;

                
                $sqli = "SELECT nome FROM utilizadores WHERE id=".'"'.$utilizador_id.'"';

                $result = $conn->query($sqli);

                while ($row = $result->fetch_assoc()){
                    $_SESSION['nome'] = $row['nome'];
                }
                
                
            } else {
                $acesso = new Acesso($utilizador_id, Carbon::now() ,false);
                $acesso->save();
                $mensagem = urlencode('Utilizador/palavra-passe inválidos'); //torna o url seguro prevenindo de possíveis erros
                header('Location: login.php?erro=' . $mensagem);
            }
            
        }

        if ($result_vendedores->num_rows > 0) {
        while ($row = $result_vendedores->fetch_assoc()) {
            $hashed_password = $row["password"];
            $utilizador_id = $row["utilizador_id"];

            if ($row["situacao"] === 'PENDENTE') {
                $mensagem = urlencode("O vendedor encontra-se pendente, aguarde aprovação do administrador. Obrigado pela compreensão");
                header('Location: login.php?erro=' . $mensagem);
                exit;
            }
        }

        if(password_verify($_POST['password'], $hashed_password)){
            
            $_SESSION['utilizador'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['perfil'] = 'VENDEDOR';
            $_SESSION['active'] = true;

            $sqli = "SELECT nome FROM utilizadores WHERE id=".'"'.$utilizador_id.'"';

            $result = $conn->query($sqli);

            while ($row = $result->fetch_assoc()){
                $_SESSION['nome'] = $row['nome'];
            }

            } else {
                $acesso = new Acesso($utilizador_id, Carbon::now() ,false);
                $acesso->save();
                $mensagem = urlencode('Utilizador/palavra-passe inválidos'); //torna o url seguro prevenindo de possíveis erros
                header('Location: login.php?erro=' . $mensagem);
            }
        } 

        if ($result_clientes->num_rows > 0) {
            while ($row = $result_clientes->fetch_assoc()) {
                $hashed_password = $row["password"];
                $utilizador_id = $row["utilizador_id"];
            }

            if(password_verify($_POST['password'], $hashed_password)){
                
                $_SESSION['utilizador'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['perfil'] = 'CLIENTE';
                $_SESSION['active'] = true;

                echo "<pre>";
                print_r($_SESSION);
                echo "</pre>";
                
                $sqli = "SELECT nome FROM utilizadores WHERE id=".'"'.$utilizador_id.'"';

                $result = $conn->query($sqli);

                while ($row = $result->fetch_assoc()){
                    $_SESSION['nome'] = $row['nome'];
                }

            } else {
                $acesso = new Acesso($utilizador_id, Carbon::now() ,false);
                $acesso->save();
                $mensagem = urlencode('Utilizador/palavra-passe inválidos'); //torna o url seguro prevenindo de possíveis erros
                header('Location: login.php?erro=' . $mensagem);
            }
        
        }
?>

<?php
    $acesso = new Acesso($utilizador_id, Carbon::now() ,true);
    $acesso->save();
    header ('Location: index.php');
    
    } else {
    header ('Location: index.php');
    }

?>


