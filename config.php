<?php

session_start();
date_default_timezone_set('America/Sao_Paulo');
$autoload = function ($class) {
    if ($class == 'Email') {
        require_once('classes/phpmailer/PHPMailerAutoload.php');
    }
    include('classes/' . $class . '.php');
};

spl_autoload_register($autoload);

//Constantes de configuração do banco de dados
define('HOST', 'localhost');
define('DATABASE', 'encurtador');
define('USER_DB', 'root');
define('PASSWORD_DB', '');

//Domínio principal
define('INCLUDE_PATH', 'http://localhost/encurtador/');
define('INCLUDE_PATH_PANEL', INCLUDE_PATH . 'painel/');
$url = explode('//', INCLUDE_PATH)[1];
$urlPanel = explode('/', INCLUDE_PATH_PANEL);
define('INCLUDE_PATH_SHORT', $url);
define('COOKIE_NAME', 'remember_encurtador');

function recoverPost($post)
{
    if (isset($_POST[$post])) {
        echo $_POST[$post];
    }
}
