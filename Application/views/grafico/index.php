<div class="wrapper">
  <canvas id="myChart" width="1600" height="650"></canvas>
</div>

<script>
  var chartColors = {
    red: 'rgb(255, 99, 132)',
    blue: 'rgb(54, 162, 235)',
    green: 'rgb(75, 192, 192)'
  };

  var color = Chart.helpers.color;

  // Objeto para manter o histórico dos projetos pelo nome (ou ID)
  var projectHistory = {};

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
                  // Atualiza os datasets com os novos valores, mantendo os dados antigos
                  data.forEach((item, index) => {
                    var projectName = item.projeto; // Você também pode usar o "id" do projeto

                    // Se o projeto ainda não está no histórico, inicializamos
                    if (!projectHistory[projectName]) {
                      projectHistory[projectName] = [];
                    }

                    // Adiciona o novo valor no histórico do projeto
                    projectHistory[projectName].push({
                      x: Date.now(),
                      y: parseInt(item.soma_votos)
                    });

                    // Atualiza o dataset correto com o histórico do projeto
                    if (index < 3) {
                      chart.data.datasets[index].data = projectHistory[projectName];
                      chart.data.datasets[index].label = projectName;
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