<?php

include 'includes/top.php';

require_once '../autoloadclass.php';


?>

<div class="container">

    <div class="row">
        <div class="class">
            <h2>Registo Vendedores</h2>
        </div>
    </div>

    <form action="adicionar_vendedor.php" method="post" enctype="multipart/form-data">
        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Nome</label>
            <div class="col-10">
            <input type="text" name="nome" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="price" class="form-label col-2 text-end">Email</label>
            <div class="col-10">
            <input type="email" name="email" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Designação</label>
            <div class="col-10">
            <input type="text" name="designacao" class="form-control">
            </div>            
        </div>


        <div class="row mt-2">
            <label for="image" class="form-label col-2 text-end">Password</label>
            <div class="col-10">
            <input type="password" name="password" class="form-control">
            </div> 
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Rua</label>
            <div class="col-10">
            <input type="text" name="rua" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Código Postal</label>
            <div class="col-10">
            <input type="text" name="codpostal" class="form-control" placeholder="0000-000" pattern="^\d{4}-\d{3}?$">
            </div>            
        </div>

        
        

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Localidade</label>
            <div class="col-10">
            <input type="text" name="localidade" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">País</label>
            <div class="col-10">
            <input type="text" name="pais" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Telemovel</label>
            <div class="col-10">
            <input type="text" name="telemovel" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">NIF</label>
            <div class="col-10">
            <input type="text" name="nif" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Hora de Abertura</label>
            <div class="col-10">
            <input type="text" name="hora_abertura" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Hora de Fecho</label>
            <div class="col-10">
            <input type="text" name="hora_fecho" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Dias de Takeaway</label>
            <div class="col-10">
            <input type="text" name="dias_takeaway" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Dias Fechado</label>
            <div class="col-10">
            <input type="text" name="dias_fechado" class="form-control">
            </div>            
        </div>

            <br>
            <label for="metodos_pagamento" class="form-label col-2 text-end">Métodos de Pagamento</label>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

            <input type="checkbox" class="btn-check" id="btncheck1" name="metodos_pagamento[]" value="multibanco">
            <label class="btn btn-outline-primary" for="btncheck1">Multibanco</label>

            <input type="checkbox" class="btn-check" id="btncheck2" name="metodos_pagamento[]" value="mbway">
            <label class="btn btn-outline-primary" for="btncheck2">MBWay</label>

            <input type="checkbox" class="btn-check" id="btncheck3" name="metodos_pagamento[]" value="visa">
            <label class="btn btn-outline-primary" for="btncheck3">Visa</label>

            </div>

            <?php if (isset($_SESSION['perfil']) && $_SESSION['perfil'] === 'ADMINISTRADOR') { ?>
                <div class="row mt-2">
                    <div class="container">
                    <label class="form-label col-2 text end"> Deseja já ativar este vendedor?</label>
                    <input type="radio" class="btn-check" value="ATIVO" name="situacao" id="btnradio1" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio1">Sim</label>
        
                    <input type="radio" class="btn-check" value="PENDENTE" name="situacao" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio2">Não</label>
                    </div>
                </div>

            <?php }  else { ?>
                <input type="text" class="visually-hidden" name="situacao" value="PENDENTE" class="form-control">
                <br>
            <?php } ?>


<!-- Restante dos checkboxes -->

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Telefone</label>
            <div class="col-10">
            <input type="text" name="telefone" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Webpage</label>
            <div class="col-10">
            <input type="text" name="url" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Responsável</label>
            <div class="col-10">
            <input type="text" name="nome_responsavel" class="form-control">
            </div>            
        </div>

        <div class="row mt-2">
            <label for="name" class="form-label col-2 text-end">Telefone Responsável</label>
            <div class="col-10">
            <input type="text" name="telefone_responsavel" class="form-control">
            </div>            
        </div>


        </div>
        
        <div class="row mt-4">
            <div class="col text-center">
                <input type="submit" value="registar" class="btn btn-primary btn-large" name="botao">
            </div>
        </div>
    </form>

</div>
<?php
include 'includes/footer.php';
?>