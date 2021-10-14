<?php

if (isset($_COOKIE[COOKIE_NAME])) {
    $user = $_COOKIE['user'];
    $password = $_COOKIE['password'];
    $userData = Query::selectWhere('login_admin', "user = ?", array($user));
    if (!empty($userData)) {
        //Pega a senha criptogafada do banco de dados e verifica se é igual a digitada
        $passDb = $userData['password'];
        if (Bcrypt::check($password, $passDb)) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['cargo'] = 2;
            $_SESSION['name'] = $userData['name'];
            $_SESSION['image'] = $userData['image'];
            Utils::redirect(INCLUDE_PATH);
        }
    }
}

include('partials/header.php');

?>

<div class="col-md-8">
    <?php
    if (isset($_POST['action'])) {
        $user = $_POST['user'];
        $password = $_POST['password'];
        //Verifica se existe o email cadastrado
        $userData = Query::selectWhere('login_admin', "user = ?", array($user));
        if (!empty($userData)) {
            //Pega a senha criptogafada do banco de dados e verifica se é igual a digitada
            $passDb = $userData['password'];
            if (Bcrypt::check($password, $passDb)) {
                //Logamos com sucesso.
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['name'] = $userData['name'];
                $_SESSION['image'] = $userData['image'];
                if (isset($_POST[COOKIE_NAME])) {
                    setcookie(COOKIE_NAME, true, time() + (60 * 60 * 24 * 7), '/');
                    setcookie('user', $user, time() + (60 * 60 * 24 * 7), '/');
                    setcookie('password', $password, time() + (60 * 60 * 24 * 7), '/');
                }
                Utils::redirect(INCLUDE_PATH);
            } else {
                //Falhou
                echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
            }
        } else {
            //Falhou
            echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
        }
    }
    ?>
    <div class = "container mt-5 mb-5">
        <div class="wrapper">
            <form method="post" name="Login_Form" class="form-signin">       
                <h3 class="form-signin-heading text-black-50">Faça o login</h3>
                <hr class="colorgraph"><br>
                
                <input type="email" class="form-control" name="user" placeholder="E-mail" required="" autofocus="" />
                <input type="password" class="form-control" name="password" placeholder="Senha" required=""/>      
                
                <div class="form-group-login right">
                    <label>Manter Conectado</label>
                    <input type="checkbox" name="<?= COOKIE_NAME ?>"/>
                </div><!--form-group-login-->
                
                <button class="btn btn-lg btn-primary btn-block"  name="action" value="Login" type="Submit">Login</button>              
            </form>         
        </div>
    </div>

<?php

include('partials/footer.php');
