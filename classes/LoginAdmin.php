<?php

class LoginAdmin
{

    public static function cadastrarUsuario($name, $email, $password, $image)
    {
        $sql = MySql::conectar()->prepare("INSERT INTO `login_admin` VALUES (null,?,?,?,?)");
        $sql->execute(array($name, $email, $password, $image));
    }

    public function atualizarUsuario($nome, $senha, $imagem)
    {
        $sql = MySql::conectar()->prepare("UPDATE `login_admin` SET nome = ?,password = ?,img = ? WHERE user = ?");
        if ($sql->execute(array($nome,$senha,$imagem,$_SESSION['user']))) {
            return true;
        } else {
            return false;
        }
    }

    public static function userExists($user)
    {
        $sql = MySql::conectar()->prepare("SELECT `id` FROM `login_admin` WHERE user=?");
        $sql->execute(array($user));
        if ($sql->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function updatePass($password, $user)
    {
        $sql = MySql::conectar()->prepare("UPDATE `login_admin` SET password = ? WHERE user = ?");
        if ($sql->execute(array($password, $user))) {
            return true;
        } else {
            return false;
        }
    }

    public static function createTables($user, $table)
    {
        $tableName = $user . '_' . $table;
        if ($table == 'configurations') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                 `id` int(11) NOT NULL AUTO_INCREMENT,
                `display_name` varchar(255) NOT NULL,
                `mail_sender` varchar(255) NOT NULL,
                `server_mail` varchar(255) NOT NULL,
                `recipient_mail_notification` varchar(255) NOT NULL,
                `recipient_name_notification` varchar(255) NOT NULL,
                `footer_mail` text NOT NULL,
                `image` varchar(255) NOT NULL,
                 PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        } elseif ($table == 'contatos_email_marketing') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nome` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `telefone` varchar(255) NOT NULL,
                `instagram` varchar(255) NOT NULL,
                `lista_id` integer,
                `status` int(11) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        } elseif ($table == 'pass_mail') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `mail` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        } elseif ($table == 'saved_campaigns') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` ( 
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `campaign_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
                `list_id` integer,
                `order_id` int(11) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        } elseif ($table == 'tb_admin.financeiro') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `cliente_id` int(11) NULL,
                `despesa_receita` integer,
                `nome` varchar(255) NOT NULL,
                `valor` varchar(255) NOT NULL,
                `vencimento` date NOT NULL,
                `status` integer,
                `pago` date,
                `conta_id` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
        } elseif ($table == 'tb_admin.listas_email') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `nome_lista` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        } elseif ($table == 'tb_admin.online') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `ip` varchar(255) NOT NULL,
                `ultima_acao` datetime NOT NULL,
                `token` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        } elseif ($table == 'tb_admin.usuarios') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL,
                `img` varchar(255) NOT NULL,
                `nome` varchar(255) NOT NULL,
                `cargo` int(11) NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        } elseif ($table == 'tb_admin.visitas') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `ip` varchar(255) NOT NULL,
                `dia` date NOT NULL,
                PRIMARY KEY (`id`)
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        } elseif ($table == 'total_visitas') {
            $sql = MySql::conectar()->prepare("CREATE TABLE if not exists `$tableName` (            
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `ultima_limpeza` date NOT NULL,
                `total` int(11) NOT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;");
        }
        $sql->execute();
    }
}
