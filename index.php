<?php

ini_set('max_execution_time', '0'); //Tempo infinito para execução do script
ini_set('memory_limit', '-1'); //Uso de memória sem limite

ob_start();

include('config.php');

$logged = isset($_SESSION['login']) ? true : false;
print_r($_SESSION);
if ($logged) {
    echo 'logado!';
    echo '<a href="' . Utils::logout(COOKIE_NAME) . '">Logout</a>';
    //Página inicial para quem está logado
} else {
    Utils::loadPage();
}

ob_end_flush();
