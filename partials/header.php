<?php

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$img = INCLUDE_PATH . 'assets/img/dog.png';
if (isset($_POST['action']) && !empty($_POST['url_converter'])) {
    $img = INCLUDE_PATH . 'assets/img/dog-puppy.png';
}


?>
<!doctype html>
<html lang="pt-br">
  <head>
    <title>Encurtador de Links</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!--Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= INCLUDE_PATH?>assets/css/style.css">
  </head>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a style="color: #FC9502;" class="navbar-brand" href="<?= INCLUDE_PATH ?>">mynew.link</a>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="nav-link" href="<?= INCLUDE_PATH ?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="<?= INCLUDE_PATH ?>url">Minha Url</a>
          </li>
          <!-- <li class="nav-item">
              <a class="nav-link" href="<?= INCLUDE_PATH ?>cadastro">Criar conta</a>
          </li> -->
        </ul>
        <span class="navbar-text">
          <a class="nav-link" href="<?= INCLUDE_PATH_PANEL ?>?logout">Sair</a>
        </span>
    </div>
    </nav>
  </header>
  <body>
    <div class="container">
        <div class="row form">
            <div class="col-md-4" style="padding: 0;">
                <div class="container-img">
                    <img src="<?= $img ?>" alt="Dog Image">
                </div>
            </div>
      
    