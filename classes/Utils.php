<?php

class Utils
{
    public static function loadPage()
    {
        if (isset($_GET['url'])) {
            $url = explode('/', $_GET['url'])[0];
            if (file_exists('pages/' . $url . '.php')) {
                include('pages/' . $url . '.php');
            } else {
                $url = INCLUDE_PATH . $url;
                include('pages/home.php');
            }
        } else {
            include('pages/converter_form.php');
        }
    }

    public static function updateClicks($shortLink)
    {
        $clickSelect = Query::selectWhere('translate', 'new_link = ?', array($shortLink))['clicks'];
        Query::update('translate', 'clicks = ?', 'new_link = ?', array($clickSelect + 1, $shortLink));
    }

    public static function countVisitsBrazil($ip)
    {
        $now = date('Y-m-d H:i:s');
        $ipDetails = new IpDetails($ip);
        $ipDetails->scan();
        $ipBrazil = $ipDetails->get_country() == 'Brazil';
        $verifyExistsIp = Query::selectWhere('tb_admin.visitas', 'ip = ?', array($ip));
        if (empty($verifyExistsIp) && $ipBrazil) {
            $country = $ipDetails->get_country();
            $state = $ipDetails->get_region();
            $city = $ipDetails->get_city();
            Query::insert('tb_admin.visitas', 'null, ?, ?, ?, ?, ?', array($ip, $city, $state, $country, $now));
        } else {
            Query::update('tb_admin.visitas', 'now = ?', 'ip = ?', array($now, $ip));
        }
    }

    public static function usersOnline($ip)
    {
        //Insere na tabela os usuários que estão online
        $now = date('Y-m-d H:i:s');
        $verifyExistsIp = Query::selectWhere('tb_admin.online', 'ip = ?', array($ip));
        if (empty($verifyExistsIp)) {
            Query::insert('tb_admin.online', 'null, ?, ?', array($ip, $now));
        }

        //Exclui da tabela usuários que ficaram online depois de um minuto
        $lastMinute = date('Y-m-d H:i:s', strtotime('-60 second', strtotime($now)));
        Query::delete('tb_admin.online', 'ultima_acao <= ?', array($lastMinute));
    }

    public static function alert($tipo, $mensagem)
    {
        if ($tipo == 'sucesso') {
            echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> ' . $mensagem . '</div>';
        } elseif ($tipo == 'erro') {
            echo '<div class="box-alert erro"><i class="fa fa-times"></i> ' . $mensagem . '</div>';
        } elseif ($tipo == 'atencao') {
            echo '<div class="box-alert atencao"><i class="fas fa-exclamation-circle"></i> ' . $mensagem . '</div>';
        }
    }

    public static function imagemValida($imagem)
    {
        if (
            $imagem['type'] == 'image/jpeg' ||
            $imagem['type'] == 'image/JPG' ||
            $imagem['type'] == 'image/jpg' ||
            $imagem['type'] == 'image/png'
        ) {
            $tamanho = intval($imagem['size'] / 1024);
            if ($tamanho < 1024) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function uploadFile($file)
    {
        $formatoArquivo = explode('.', $file['name']);
        $directory = '/uploads/';
        $imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
        if (move_uploaded_file($file['tmp_name'], INCLUDE_PATH . $directory . $imagemNome)) {
            return $imagemNome;
        } else {
            return false;
        }
    }

    public static function redirect($url)
    {
        echo '<script>location.href="' . $url . '"</script>';
    }

    public static function logout($cookieName)
    {
        setcookie($cookieName, 'true', time() - 1, '/');
        session_destroy();
        header('Location: ' . INCLUDE_PATH);
    }
}
