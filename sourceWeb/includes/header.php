<?php
session_start();

$pages = array();
$pages["/ecome/sourceWeb/index.php"] = "Início";

// Verifique se o usuário é um vendedor antes de adicionar a página "Criar Atividade"
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') {
    $pages["/ecome/sourceWeb/criar_atividade.php"] = "Criar Atividade";
}

// Adicione a página "Atividades" se o usuário NÃO for um vendedor e estiver autenticado
if (!(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR')) {
    $pages["/ecome/sourceWeb/atividades.php"] = "Atividades";
}

// Verifique se o usuário é um vendedor antes de adicionar a página "Minhas Atividades"
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR') {
    $pages["/ecome/sourceWeb/minhas_atividades.php"] = "Minhas Atividades";
}

// Verifique se o usuário está autenticado antes de adicionar a página "Reservas"
if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'CLIENTE') {
    $pages["/ecome/sourceWeb/minhas_reservas.php"] = "Reservas";
}




$url = $_SERVER['REQUEST_URI'];
$url_sections = explode('/', $_SERVER['REQUEST_URI']);
$activePage = $url;
?>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <?php foreach ($pages as $url => $title) { ?>
                    <li>
                        <a <?php if ($url === $activePage) { ?>class="nav-link px-2 link-secondary"<?php } else { ?>class="nav-link px-2" href="<?php } echo $url ?>"><?php echo $title ?></a>
                    </li>
                <?php } ?>
            </ul>
            <?php if (isset($_SESSION['active']) && $_SESSION['active'] === true) { ?>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">Olá <?php if (isset($_SESSION)) {
                                                                    echo $_SESSION['nome'];
                                                                } ?></a></li>
                        <?php if ($_SESSION['perfil'] === 'CLIENTE') { ?>
                        <?php } ?>
                        <li><a class="dropdown-item" href="/ecome/sourceWeb/session_end.php">Terminar Sessão</a></li>
                    </ul>
                <?php } else { ?>
                    <a class="btn btn-primary" href="/ecome/sourceWeb/login.php">Login</a>
                    <p>&nbsp;</p>
                    <a class="btn btn-primary" href="/ecome/sourceWeb/registar.php">Registar</a>
                <?php } ?>
                </div>
        </div>
    </div>
</header>
