<?php

include('partials/header.php');

if (isset($_POST['action'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($_FILES['img'])) {
        $image = $_FILES['img'];
    } else {
        $image = '';
    }

    if ($name == '') {
        Utils::alert('erro', ' O NOME está vazio!');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Utils::alert('erro', ' E-MAIL inválido!');
    } elseif ($password == '') {
        Utils::alert('erro', ' A senha está vazia!');
    } elseif (strlen($password) < 6) {
        Utils::alert('erro', ' A senha precisa ter pelo menos 6 CARACTERES.');
    } elseif ($password != $_POST['password_confirm']) {
        Utils::alert('erro', ' As senhas não COINCIDEM.');
    } else {
        $password = Bcrypt::hash($password);
        //Podemos cadastrar!
        if (!empty($image['name'])) {
            if (!Utils::imagemValida($image)) {
                Utils::alert('erro', ' O formato especificado não está correto!');
            } elseif (LoginAdmin::userExists($email)) {
                Utils::alert('erro', 'Já exite este E-MAIL cadastrado!');
            } else {
                //Apenas cadastrar no banco de dados!
                $image = Utils::uploadFile($image);
                LoginAdmin::cadastrarUsuario($name, $email, $password, $image);
                $user = new LoginAdmin();
                // $user->createTables($email, 'configurations');

                Utils::alert('sucesso', ' O seu cadastro foi efetuado com sucesso!');
                header('Refresh: 3; url=' . INCLUDE_PATH . 'login');
            }
        } elseif (LoginAdmin::userExists($email)) {
            Utils::alert('erro', 'Já exite este E-MAIL cadastrado!');
        } else {
            //Apenas cadastrar no banco de dados!
            LoginAdmin::cadastrarUsuario($name, $email, $password, $image);
            $user = new LoginAdmin();
            // $user->createTables($email, 'configurations');

            Utils::alert('sucesso', ' O seu cadastro foi efetuado com sucesso!');
            header('Refresh: 3; url=' . INCLUDE_PATH . 'login');
        }
    }
}

?>
        
      

<div class="col-md-8">
<h2 class="text-center m-5 text-black-50">Cadastro do Sistema</h2>
    <form method="post" action="<?= INCLUDE_PATH?>cadastro" enctype="multipart/form-data">
    <div class="form-group">
            <label for="inputAddress">Nome Completo *</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nome Completo" value="<?php recoverPost('name') ?>">
        </div>
        <div class="form-group">
            <label for="inputEmail4">Email *</label>
            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" value="<?php recoverPost('email') ?>">
        </div>
        <div class="form-group">
            <label for="inputPassword4">Senha *</label>
            <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Senha" value="<?php recoverPost('password') ?>">
            <small>Mínimo 6 caracteres</small>
        </div>
        <div class="form-group">
            <label for="inputPassword4">Confirmação de Senha *</label>
            <input type="password" name="password_confirm" class="form-control" id="inputPassword_confirm4" placeholder="Senha" value="<?php recoverPost('password_confirm') ?>">
        </div>
        <div class="form-group mb-3">
            <label for="exampleFormControlFile1">Imagem</label>
            <input type="file" name="img" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <small>* Campos obrigatórios</small>
        <div class="form-group mt-3">
            <button type="submit" name="action" class="btn btn-primary">Cadastrar</button>
        </div>

        <div class="form-group">
            <small><a href="<?= INCLUDE_PATH ?>">Já tem conta? Faça o login</a></small>
        </div>
    </form>
</div>
      
  <?php include('partials/footer.php'); ?>

