<?php

if (!$logged) {
    Utils::redirect(INCLUDE_PATH_PANEL);
} else {
    include('pages/home.php');
    ?>
    
    <h3><a href="<?= INCLUDE_PATH_PANEL ?>?logout">Sair</a></h3>

<?php } ?>