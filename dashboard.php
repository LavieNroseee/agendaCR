<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header("Location: index.php");
    exit;
}

require 'api/db.php'; // Asegúrate de que esta ruta sea correcta

// 1. Actividades por mes
$stmt1 = $conexion->query("SELECT MONTH(hora_inicio) as mes, COUNT(*) as cantidad FROM actividades GROUP BY mes");
$actividadesPorMes = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// 2. Actividades por usuario
$stmt2 = $conexion->query("SELECT creado_por, COUNT(*) as cantidad FROM actividades GROUP BY creado_por");
$actividadesPorUsuario = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// 3. Actividades por sede
$stmt3 = $conexion->query("SELECT sede, COUNT(*) as cantidad FROM usuarios INNER JOIN actividades ON usuarios.username = actividades.creado_por GROUP BY sede");
$actividadesPorSede = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard de Actividades</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2><i class="fas fa-chart-pie"></i> Dashboard</h2>
    <h4>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo $_SESSION['sede']; ?>)</h4>
    <a href="dashboard"><i class="fas fa-chart-line"></i> Estadísticas</a>
    <a href="eventos"><i class="fas fa-calendar-alt"></i> Eventos/Actividades</a>
    <a href="index"><i class="fas fa-calendar-alt"></i> Calendario</a>
    <a href="logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
  </div>

  <!-- Contenido Principal -->
  <div class="main-content">
    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> (<?php echo $_SESSION['sede']; ?>)</h2>

    <div class="charts-row">
      <!-- Gráfico Actividades por Mes -->
      <div class="chart-container">
        <h3>Actividades por Mes</h3>
        <canvas id="graficoMes"></canvas>
      </div>

      <!-- Gráfico Actividades por Usuario -->
      <div class="chart-container">
        <h3>Actividades por Usuario</h3>
        <canvas id="graficoUsuario"></canvas>
      </div>

      <!-- Gráfico Actividades por Sede -->
      <div class="chart-container">
        <h3>Actividades por Sede</h3>
        <canvas id="graficoSede"></canvas>
      </div>
    </div>
  </div>


  <script>
    // Función para ajustar la resolución del canvas y la escala de los textos
    function ajustarCanvas(idCanvas) {
        const canvas = document.getElementById(idCanvas);
        const ctx = canvas.getContext('2d');

        // Ajustar el tamaño del canvas para alta densidad de píxeles
        const width = canvas.offsetWidth;
        const height = canvas.offsetHeight;

        // Ajusta las dimensiones del canvas en función de la densidad de píxeles de la pantalla
        canvas.width = width * window.devicePixelRatio;
        canvas.height = height * window.devicePixelRatio;

        // Escala el contenido del canvas para que se ajuste a la nueva resolución
        ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
    }

    // 1. Actividades por mes
    const actividadesPorMes = <?php echo json_encode($actividadesPorMes); ?>;
    const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    const labelsMes = actividadesPorMes.map(item => meses[item.mes - 1]);
    const dataMes = actividadesPorMes.map(item => item.cantidad);

    // Ajustar canvas para alta resolución antes de crear el gráfico
    ajustarCanvas('graficoMes');

    new Chart(document.getElementById('graficoMes'), {
        type: 'bar',
        data: {
            labels: labelsMes,
            datasets: [{
                label: 'Actividades',
                data: dataMes,
                backgroundColor: '#0d3a85'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        font: {
                            size: 14 * window.devicePixelRatio,  // Ajusta el tamaño de las etiquetas del eje X
                           
                            family: "'Montserrat', sans-serif"
                        }
                    }
                },
                y: {
                    ticks: {
                        font: {
                            size: 14 * window.devicePixelRatio,  // Ajusta el tamaño de las etiquetas del eje Y
                            
                            family: "'Montserrat', sans-serif"
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16 * window.devicePixelRatio,  // Ajusta el tamaño de la leyenda
                        
                            family: "'Montserrat', sans-serif"
                        }
                    }
                },
                tooltip: {
                    bodyFont: {
                        size: 14 * window.devicePixelRatio  // Ajusta el tamaño del texto del tooltip
                    }
                }
            }
        }
    });

    // 2. Actividades por usuario
    const actividadesPorUsuario = <?php echo json_encode($actividadesPorUsuario); ?>;
    const labelsUsuario = actividadesPorUsuario.map(item => item.creado_por);
    const dataUsuario = actividadesPorUsuario.map(item => item.cantidad);

    // Ajustar canvas para alta resolución antes de crear el gráfico
    ajustarCanvas('graficoUsuario');

    new Chart(document.getElementById('graficoUsuario'), {
        type: 'pie',
        data: {
            labels: labelsUsuario,
            datasets: [{
                label: 'Actividades',
                data: dataUsuario,
                backgroundColor: ['#0d3a85', '#1f77b4', '#2ca02c', '#ff7f0e']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16 * window.devicePixelRatio,  // Ajusta el tamaño de la leyenda
                            
                            family: "'Montserrat', sans-serif"
                        }
                    }
                },
                tooltip: {
                    bodyFont: {
                        size: 14 * window.devicePixelRatio  // Ajusta el tamaño del texto del tooltip
                    }
                }
            }
        }
    });

    // 3. Actividades por sede
    const actividadesPorSede = <?php echo json_encode($actividadesPorSede); ?>;
    const labelsSede = actividadesPorSede.map(item => item.sede);
    const dataSede = actividadesPorSede.map(item => item.cantidad);

    // Ajustar canvas para alta resolución antes de crear el gráfico
    ajustarCanvas('graficoSede');

    new Chart(document.getElementById('graficoSede'), {
        type: 'doughnut',
        data: {
            labels: labelsSede,
            datasets: [{
                label: 'Actividades',
                data: dataSede,
                backgroundColor: ['#0d3a85', '#28a745', '#ffc107']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 16 * window.devicePixelRatio,  // Ajusta el tamaño de la leyenda
                            
                            family: "'Montserrat', sans-serif"
                        }
                    }
                },
                tooltip: {
                    bodyFont: {
                        size: 14 * window.devicePixelRatio  // Ajusta el tamaño del texto del tooltip
                    }
                }
            }
        }
    });
</script>

</body>
</html>


