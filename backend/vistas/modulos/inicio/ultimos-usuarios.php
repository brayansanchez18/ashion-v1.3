<?php $usuarios = ControladorUsuarios::ctrMostrarTotalUsuarios('fecha'); ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Últimos usuarios registrados</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <ul class="users-list clearfix">
      <?php if (count($usuarios) > 8): ?>
        <?php $totalUsuarios = 8; ?>
      <?php else: ?>
        <?php $totalUsuarios = count($usuarios); ?>
      <?php endif ?>

      <?php for ($i = 0; $i < $totalUsuarios; $i ++): ?>
        <?php if ($usuarios[$i]['modo'] == 'directo'): ?>
          <?php if ($usuarios[$i]['foto'] != ''): ?>
            <li>
              <img src="<?=$frontend.$usuarios[$i]['foto']?>" alt="<?=$usuarios[$i]['nombre']?>" width="100px">
              <a class="users-list-name"><?=$usuarios[$i]['nombre']?></a>
              <span class="users-list-date"><?=$usuarios[$i]['fecha']?></span>
            </li>
          <?php else: ?>
            <li>
              <img src="vistas/img/usuarios/default/anonymous.png" alt="<?=$usuarios[$i]['nombre']?>" width="100px">
              <a class="users-list-name"><?=$usuarios[$i]['nombre']?></a>
              <span class="users-list-date"><?=$usuarios[$i]['fecha']?></span>
            </li>
          <?php endif ?>
        <?php endif ?>
      <?php endfor ?>
    </ul>
    <!-- /.users-list -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer text-center">
    <a href="<?=$backend?>usuarios">Ver Todos Los Usuarios</a>
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->