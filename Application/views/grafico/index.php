<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.8.0"></script>

<style>
  canvas {
    display: inline-block !important;
  }
</style>
</head>
<body>
<div class="wrapper">
  <canvas id="myChart" width="1600" height="900"></canvas>
</div>

<script>
  var chartColors = {
    red: 'rgb(255, 99, 132)',
    blue: 'rgb(54, 162, 235)',
    green: 'rgb(75, 192, 192)'
  };

  var color = Chart.helpers.color;
  var config = {
    type: 'line',
    data: {
      datasets: [{
        label: '1º Lugar',
        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
        borderColor: chartColors.red,
        fill: false,
        cubicInterpolationMode: 'monotone',
        data: []
      }, {
        label: '2º Lugar',
        backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
        borderColor: chartColors.blue,
        fill: false,
        cubicInterpolationMode: 'monotone',
        data: []
      }, {
        label: '3º Lugar',
        backgroundColor: color(chartColors.green).alpha(0.5).rgbString(),
        borderColor: chartColors.green,
        fill: false,
        cubicInterpolationMode: 'monotone',
        data: []
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Top 3 lugares da Feira'
      },
      scales: {
        xAxes: [{
          type: 'realtime',
          realtime: {
            duration: 20000,
            refresh: 3000,  // Atualiza a cada 3 segundos
            delay: 2000,
            onRefresh: function(chart) {
              fetch('/grafico/data')
                .then(response => response.json())
                .then(data => {
                  // Limpa os dados anteriores
                  chart.data.datasets[0].data = [];
                  chart.data.datasets[1].data = [];
                  chart.data.datasets[2].data = [];

                  // Atualiza os datasets com os dados do array fornecido
                  data.forEach((item, index) => {
                    if (index < 3) {
                      chart.data.datasets[index].data.push({
                        x: Date.now(),
                        y: parseInt(item.soma_votos)
                      });
                      chart.data.datasets[index].label = item.projeto;
                    }
                  });
                  
                  chart.update();
                });
            }
          }
        }],
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Soma dos Votos'
          },
          ticks: {
            beginAtZero: true
          }
        }]
      },
      tooltips: {
        mode: 'nearest',
        intersect: false
      },
      hover: {
        mode: 'nearest',
        intersect: false
      }
    }
  };

  window.onload = function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    window.myChart = new Chart(ctx, config);
  };
</script>
