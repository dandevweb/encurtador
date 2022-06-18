<?php

include('partials/header.php');

Utils::countVisitsBrazil($ip);
Utils::usersOnline($ip);

$selectCounter = Query::selectAll('url_counter')[0];
$countUrl = $selectCounter['count_url'];
$idCounter = $selectCounter['id'];
$exists = '';

function RandomString($parm)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $randstring = '';
    for ($i = 0; $i < $parm; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

$id = RandomString($countUrl);

$insert = false;
if (isset($_POST['action'])) {
    //verificar se o IP já converteu 3 URLs hoje
    $hoje = date('Y-m-d');
    $selectIp = Query::selectAllWhere('translate', 'created_at = ? AND ip = ?', array($hoje, $ip));
    $count = 0;
    foreach ($selectIp as $value) {
        $count++;
    }

    if ($count >= 10) {
        echo '<script>alert("Você já encurtou 10 URLs hoje. Tente novamente amanhã!")</script>';
        Utils::redirect(INCLUDE_PATH);
    } else {
        if (empty($_POST['url_converter'])) {
            Utils::alert('erro', "A URL não pode ser vazia!");
        } else {
            $old_url = explode('//', $_POST['url_converter']);
            $urlPersonal = str_replace(' ', '-', $_POST['url_personal']);
            if (isset($old_url[1])) {
                $old_url = $old_url[1];
            } else {
                $old_url = $old_url[0];
            }
            if (!empty($urlPersonal)) {
                $id = $urlPersonal;
                $new_url = INCLUDE_PATH . $id;
                $verify = Query::selectWhere('translate', 'new_link = ?', array($new_url));
                if ($verify  || $urlPersonal == 'painel' || $urlPersonal == 'url') {
                    $exists =  Utils::alert('erro', ' URL não disponível!');
                } else {
                    $exists = '';
                    $datetime = date('Y-m-d');
                    $insert = Query::insert('translate', 'null, ?, ?, ?, ?, ?', array($old_url, $new_url, $datetime, $ip, 0));
                }
            } else {
                $new_url = INCLUDE_PATH . $id;
                $verify = Query::selectWhere('translate', 'new_link = ?', array($new_url));
                $attempt = 0;
                while ($verify) {
                    $attempt++;
                    $id = RandomString($countUrl);
                    $new_url = INCLUDE_PATH . $id;
                    $verify = Query::selectWhere('translate', 'new_link = ?', array($new_url));
                    if ($attempt >= 1000) {
                        $attempt = 0;
                        $addStringUrl = Query::update('url_counter', 'count_url = ?', 'id = ?', array($countUrl + 1, $idCounter,));
                        break;
                    }
                }
                $datetime = date('Y-m-d');
                $insert = Query::insert('translate', 'null, ?, ?, ?, ?, ?', array($old_url, $new_url, $datetime, $ip, 0));
            }
        }
    }
}


?>
    <div class="col-md-8">
        <h2 class="text-center m-5 text-black-50">Encurte sua URL</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="url_converter" id="" class="form-control" placeholder="Cole seu link aqui..." aria-describedby="helpId" >
            </div>
                <?= $exists ?>
            <div class="text-center">
                <a class="center" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Personalize <br>
                <i class="fas fa-chevron-down"></i>
                </a>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="form-group">
                    <span><?= INCLUDE_PATH_SHORT ?></span><input  type="text" name="url_personal" id="" class="form-control" placeholder="URL personalizada..." aria-describedby="helpId">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success mb-3" name="action">Encurtar</button>
        </form>
        <?php
        if ($insert) {
            ?>
        <br>
        <div class="alert alert-success" role="alert">
            Seu link foi gerado com sucesso!
            <input class="form-control" id="new_url" type="text" value="<?= $new_url ?>"/><i class="fas fa-copy" id="copy"></i>
            <div class="box-alert copied text-center">
                <i class="fa fa-check"></i>Copiado.
            </div>
        </div>
            <?php
        } ?>
    </div>
    <!-- /.col-md-8 -->
    


<?php

include('partials/footer.php');
