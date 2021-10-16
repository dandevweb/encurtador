<div class="col-md-8">
    <h2 class="text-center m-5 text-black-50">Painel de Controle</h2>
    <?php
    $visits = Query::selectAll('tb_admin.visitas');
    $totalVisits = 0;
    foreach ($visits as $value) {
        $totalVisits += 1;
    }
    ?>
    <div class="card text-left">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title">Total de visitas</h4>
        <p class="card-text"><?= $totalVisits ?></p>
      </div>
    </div>
</div>