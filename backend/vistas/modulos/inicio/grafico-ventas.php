<?php
error_reporting(0);
$modo = 'ASC';
$ventas = ControladorVentas::ctrMostrarVentas($modo);
$arrayFechas = array();
$arrayFechaPago = array();

foreach ($ventas as $key => $value) {
  if ($value['pago'] != 0) {
    #Capturamos sólo el año y el mes
    $fecha = substr($value['fecha'],0,7);

    #Capturamos las fechas en un array
    array_push($arrayFechas, $fecha);

    #Capturamos las fechas y los pagos en un mismo array
    $arrayFechaPago = array($fecha => $value['pago']);

    // print_r($arrayFechaPago);

    #Sumamos los pagos que ocurrieron el mismo mes
    foreach ($arrayFechaPago as $key => $value) {
      $sumaPagosMes[$key] += $value;
    }
  }
}

#Evitamos repetir fecha
$noRepetirFechas = array_unique($arrayFechas);
?>
<!-- solid sales graph -->
<div class="card bg-gradient-info">
  <div class="card-header border-0">
    <h3 class="card-title">
      <i class="fas fa-th mr-1"></i>
      Grafico de Ventas
    </h3>

    <div class="card-tools">
      <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
  </div>
</div>

<script>
  // Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels: [
      <?php foreach ($noRepetirFechas as $value): ?>
        '<?=$value?>',
      <?php endforeach ?>
      ],
    datasets: [
      {
        label: 'Ventas $',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
        data: [
          <?php foreach ($noRepetirFechas as $value): ?>
            '<?=$sumaPagosMes[$value]?>',
          <?php endforeach ?>
          ]
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#efefef'
        },
        gridLines: {
          display: false,
          color: '#efefef',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 500,
          fontColor: '#efefef'
        },
        gridLines: {
          display: true,
          color: '#efefef',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })
</script>