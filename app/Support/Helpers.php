<?php

function randomString($parm)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $randstring = '';
    for ($i = 0; $i < $parm; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

function alert($type, $message)
    {
        if ($type == 'success') {
            echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> ' . $message . '</div>';
        } elseif ($type == 'error') {
            echo '<div class="box-alert erro"><i class="fa fa-times"></i> ' . $message . '</div>';
        } elseif ($type == 'warning') {
            echo '<div class="box-alert atencao"><i class="fas fa-exclamation-circle"></i> ' . $message . '</div>';
        }
    }
