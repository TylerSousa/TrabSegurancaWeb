<?php

require_once 'autoload.php';
require 'vendor/autoload.php';

use Carbon\Carbon;


echo Carbon::now()
    ->addMonths(1)
    ->endOfMonth()
    ->toDateTimeString('minutes')
    . "<br><br><br>";


/*
$u1 = Utilizador::find(21);
echo "<pre>";
var_dump($u1);
echo "</pre>";

$p1 = Perfil::find(2);
echo "<pre>";
var_dump($p1);
echo "</pre>";
*/

echo "-----------<br><br><br>";

$resultados = Utilizador::search([
    ['coluna' => 'email', 'operador' => 'like' ,'valor' => '%gmail%'],
    ['coluna' => 'id', 'operador' => '<', 'valor' => '100']
]);

echo "<pre>";
var_dump($resultados);
echo "</pre>";