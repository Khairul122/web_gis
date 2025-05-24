<?php include('template/header.php'); ?>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include 'template/navbar.php'; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include 'template/setting_panel.php'; ?>
      <?php include 'template/sidebar.php'; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row mb-3">
            <div class="col-md-8">
              <h4 class="mt-2">Grafik dan Visualisasi MAUT</h4>
              <p class="text-muted">Representasi visual hasil analisis kesesuaian lahan</p>
            </div>
            <div class="col-md-4 text-end">
              <a href="index.php?controller=MAUT&action=index" class="btn btn-outline-secondary me-2">
                <i class="mdi mdi-arrow-left"></i> Kembali
              </a>
              <button class="btn btn-primary" onclick="window.print()">
                <i class="mdi mdi-printer"></i> Print
              </button>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header bg-primary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-bar"></i> Grafik Ranking MAUT Score
                  </h5>
                </div>
                <div class="card-body">
                  <canvas id="chartRanking" height="400"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card">
                <div class="card-header bg-success text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-pie"></i> Distribusi Kategori
                  </h5>
                </div>
                <div class="card-body">
                  <canvas id="chartKategori" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-warning text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-line"></i> Perbandingan Nilai Utilitas per Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <canvas id="chartUtilitas" height="400"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header bg-info text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-donut"></i> Kontribusi Bobot Kriteria
                  </h5>
                </div>
                <div class="card-body">
                  <canvas id="chartBobot" height="300"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-header bg-secondary text-white">
                  <h5 class="mb-0">
                    <i class="mdi mdi-chart-scatter-plot"></i> Sebaran Skor MAUT
                  </h5>
                </div>
                <div class="card-body">
                  <canvas id="chartSebaran" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include 'template/script.php'; ?>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const ranking = <?= json_encode($data['ranking']) ?>;
      const scores = <?= json_encode($data['scores']) ?>;
      const kriteria = <?= json_encode($data['kriteria']) ?>;

      const chartRanking = new Chart(document.getElementById('chartRanking'), {
        type: 'bar',
        data: {
          labels: ranking.slice(0, 10).map(r => r.nama_kecamatan),
          datasets: [{
            label: 'MAUT Score',
            data: ranking.slice(0, 10).map(r => r.total_score),
            backgroundColor: ranking.slice(0, 10).map(r => {
              if (r.persentase >= 80) return '#28a745';
              if (r.persentase >= 60) return '#007bff';
              if (r.persentase >= 40) return '#ffc107';
              return '#dc3545';
            }),
            borderColor: '#000',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            title: {
              display: true,
              text: 'Top 10 Kecamatan - MAUT Score'
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: 1
            }
          }
        }
      });

      const kategoriData = {
        'Sangat Sesuai': ranking.filter(r => r.persentase >= 80).length,
        'Sesuai': ranking.filter(r => r.persentase >= 60 && r.persentase < 80).length,
        'Cukup Sesuai': ranking.filter(r => r.persentase >= 40 && r.persentase < 60).length,
        'Kurang Sesuai': ranking.filter(r => r.persentase < 40).length
      };

      const chartKategori = new Chart(document.getElementById('chartKategori'), {
        type: 'doughnut',
        data: {
          labels: Object.keys(kategoriData),
          datasets: [{
            data: Object.values(kategoriData),
            backgroundColor: ['#28a745', '#007bff', '#ffc107', '#dc3545'],
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });

      const top5 = ranking.slice(0, 5);
      const datasets = kriteria.map((k, index) => ({
        label: k.nama_kriteria,
        data: top5.map(r => {
          const scoreDetail = scores[r.id_kecamatan];
          return scoreDetail && scoreDetail.detail[k.id_kriteria] ? 
                 scoreDetail.detail[k.id_kriteria].nilai_utilitas : 0;
        }),
        backgroundColor: `hsla(${index * 60}, 70%, 50%, 0.7)`,
        borderColor: `hsla(${index * 60}, 70%, 40%, 1)`,
        borderWidth: 2
      }));

      const chartUtilitas = new Chart(document.getElementById('chartUtilitas'), {
        type: 'radar',
        data: {
          labels: top5.map(r => r.nama_kecamatan),
          datasets: datasets
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            r: {
              beginAtZero: true,
              max: 1
            }
          },
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });

      const chartBobot = new Chart(document.getElementById('chartBobot'), {
        type: 'pie',
        data: {
          labels: kriteria.map(k => k.nama_kriteria),
          datasets: [{
            data: kriteria.map(k => k.bobot * 100),
            backgroundColor: [
              '#ff6384',
              '#36a2eb',
              '#cc65fe',
              '#ffce56',
              '#4bc0c0',
              '#ff9f40'
            ],
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom'
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return context.label + ': ' + context.parsed + '%';
                }
              }
            }
          }
        }
      });

      const chartSebaran = new Chart(document.getElementById('chartSebaran'), {
        type: 'scatter',
        data: {
          datasets: [{
            label: 'Skor MAUT',
            data: ranking.map((r, index) => ({
              x: index + 1,
              y: r.total_score
            })),
            backgroundColor: '#007bff',
            borderColor: '#0056b3',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              title: {
                display: true,
                text: 'Ranking'
              }
            },
            y: {
              title: {
                display: true,
                text: 'MAUT Score'
              },
              beginAtZero: true,
              max: 1
            }
          },
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });
    });
  </script>

  <style>
    @media print {
      .main-panel {
        width: 100% !important;
        margin: 0 !important;
      }
      
      .sidebar, .navbar, .btn {
        display: none !important;
      }
      
      .card {
        break-inside: avoid;
        margin-bottom: 20px;
      }
    }
  </style>

</body>
</html>