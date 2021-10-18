<?php

include('partials/header.php');

?>

<div class="col-md-8">
    <h2 class="text-center m-5 text-black-50">Contador de cliques</h2>
    <p class="text-center  text-black-50">Aqui você pode verificar a quantidade de cliques que sua URL recebeu.</p>
    <form action_count="" method="post">
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="short_url" id="" class="form-control" placeholder="Cole sua URL curta..." aria-describedby="helpId" required>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="form-group">
                    <span><?= INCLUDE_PATH_SHORT ?></span><input  type="text" name="url_personal" id="" class="form-control" placeholder="URL personalizada..." aria-describedby="helpId">
                </div>
            </div>
            <button type="submit" class="btn btn-success mb-3" name="action_count">Verificar</button>
        </form>
        
        <?php
        if (isset($_POST['action_count'])) {
            $url = $_POST['short_url'];
            $selectUrl = Query::selectWhere('translate', 'new_link = ?', array($url));
            if (!empty($selectUrl)) {
                $clicks = $selectUrl['clicks'];
                $oldLink = $selectUrl['link'];
                $createdAt = $selectUrl['created_at'];
                $id = $selectUrl['id'];
                ?>
            <div class="alert alert-success" role="alert">
                Seu link <strong><?= substr(strip_tags($oldLink), 0, 20) . '...' ?></strong> foi visitado <strong><?= $clicks ?></strong> vezes desde <strong><?= date('d/m/Y', strtotime($createdAt)) ?></strong>. 
                <br>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <button type="submit" class="btn btn-sm btn-danger reset-button mt-3" name="reset">Zerar</button>
                </form>
            </div>
                <?php
            } else {
                Utils::alert('erro', 'URL não encontrada!');
            }
        } elseif (isset($_POST['reset'])) {
            $id = $_POST['id'];
            Query::update('translate', 'created_at = ?, clicks = ?', 'id = ?', array(date('Y-m-d'), 0, $id));
            Utils::alert('sucesso', 'Os cliques foram zerados!');
        }
        ?>
    

<?php

include('partials/footer.php');
