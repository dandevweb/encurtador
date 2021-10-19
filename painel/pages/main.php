<?php

if (!$logged) {
    Utils::redirect(INCLUDE_PATH_PANEL);
} else {
    include('pages/home.php');
    ?>
    

<?php } ?>