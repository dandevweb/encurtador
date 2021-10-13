<?php

include('partials/header.php');

?>

<div class="col-md-8">
    <div class = "container mt-5 mb-5">
        <div class="wrapper">
            <form action="admin_login.php" method="post" name="Login_Form" class="form-signin">       
                <h3 class="form-signin-heading text-black-50">Faça o login</h3>
                <hr class="colorgraph"><br>
                
                <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
                <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>              
                
                <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>              
            </form>         
        </div>
    </div>

<?php

include('partials/footer.php');
