<?php

include('../config.php');

if (isset($_GET['logout'])) {
    Utils::logout();
}
include('../partials/header.php');
$logged = isset($_SESSION['login']) ? true : false;
if ($logged) {
    include('pages/main.php');
} else {
    include('pages/login.php');
}


include('../partials/footer.php');
