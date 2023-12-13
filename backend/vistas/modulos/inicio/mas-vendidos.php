<?php
$productos = ControladorProductos::ctrMostrarTotalProductos('ventas');
$colores = array('danger','success','warning','info','primary', 'secondary');
$coloreshtml = array('#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de');
?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Productos más vendidos</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <div class="chart-responsive">
          <canvas id="pieChart" height="150"></canvas>
        </div>
        <!-- ./chart-responsive -->
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <ul class="chart-legend clearfix">
        <?php for ($i=0; $i<6; $i++): ?>
          <li><i class="far fa-circle text-<?=$colores[$i]?>"></i> <?=$productos[$i]['titulo']?></li>
        <?php endfor ?>
        </ul>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {
    labels: [
    <?php for ($i=0; $i<6; $i++): ?>
      '<?=$productos[$i]['titulo']?>',
    <?php endfor ?>
    ],
    datasets: [
      {
        data: [
          <?php for ($i=0; $i<6; $i++): ?>
            <?=$productos[$i]['ventas']?>,
          <?php endfor ?>
        ],
        backgroundColor: [
          <?php for ($i=0; $i<6; $i++): ?>
            '<?=$coloreshtml[$i]?>',
          <?php endfor ?>
          ]
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })
</script>