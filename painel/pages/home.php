<div class="col-md-8">
    <h2 class="text-center m-5 text-black-50">Painel de Controle</h2>
    <?php
    $visits = count(Query::selectAll('tb_admin.visitas'));

    $usersOnline = count(Query::selectAll('tb_admin.online'));
    ?>
    <div class="row">
      <div class="col-md-6">
        <div class="card text-left">
          <img class="card-img-top" src="holder.js/100px180/" alt="">
          <div class="card-body">
            <h4 class="card-title">Total de visitas</h4>
            <p class="card-text"><?= $visits ?></p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card text-left">
          <img class="card-img-top" src="holder.js/100px180/" alt="">
          <div class="card-body">
            <h4 class="card-title">Usuários Online</h4>
            <p class="card-text"><?= $usersOnline ?></p>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
</div>