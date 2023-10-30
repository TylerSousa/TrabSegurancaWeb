<?php
session_start();

$pages = array();
$pages["/ecome/sourceWeb/index.php"] = "Início";

if(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'VENDEDOR'){
  $pages["/ecome/sourceWeb/gestaoementa.php"] = "Gerir Ementa";
} else {
  $pages["/ecome/sourceWeb/atividades.php"] = "Atividades";
}

if(isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') {
  $pages["/ecome/sourceWeb/utilizadores.php"] = "Utilizadores";
}

$pages["/ecome/sourceWeb/vendedores.php"] = "Vendedores";

if(isset($_SESSION['carrinho']) && $_SESSION['perfil'] === 'CLIENTE') {
  $pages["/ecome/sourceWeb/carrinho.php"] = "Carrinho";
}


$url = $_SERVER['REQUEST_URI'];

$url_sections = explode('/', $_SERVER['REQUEST_URI']);

$activePage = $url;

  
?>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <!-- <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a> -->

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
      <?php        foreach ($pages as $url => $title ) { ?>
        <li>
          <a <?php if ($url === $activePage){?>class="nav-link px-2 link-secondary"<?php } else { ?>class="nav-link px-2" href="<?php } echo $url ?>"><?php echo $title ?></a>
        </li>
      <?php } ?>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>
        <?php if(isset($_SESSION['active']) && $_SESSION['active'] === true) { ?>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="#">Olá <?php if(isset($_SESSION)){echo $_SESSION['nome'];}?></a></li>
            <?php if($_SESSION['perfil'] === 'CLIENTE') { ?>
              <li><a class="dropdown-item" href="/ecome/sourceWeb/carrinho.php">Carrinho</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
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