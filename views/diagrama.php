<!doctype html>
<html lang="es">
    <head>
        <title>Cuadro Estadistico</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>

<body>
<style>
      body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .contenido {
            text-align: center;
        }
    </style>
    <?php

    $dsn = 'mysql:host=localhost;dbname=SENATIDB';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Error de conexión: ' . $e->getMessage());
    }

    // Consulta SQL para obtener datos de la tabla empleados
    $sql = 'SELECT idempleado, idsede, apellidos, nombres, nrodocumento, fechanac, telefono, create_at, update_at, inactive_at 
            FROM empleados';

    try {
        // Preparar y ejecutar la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Obtener los resultados como un array asociativo
        $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Contar la cantidad de personas en cada sede
        $sedeCounts = array_count_values(array_column($empleados, 'idsede'));
        } catch (PDOException $e) {
            die('Error al ejecutar la consulta: ' . $e->getMessage());
        }
    ?>

    <div class="container">
        <div class="card mt-2">
            <div class="card-header bg-warning">
                <br>
                <span class="text-light"><h1><center>ESTADISTICAS POR SEDES</center></h1></span>
                <br>
            </div>
            <div class="card-body">
            <div style="width: 80%; margin: auto;">
                <canvas id="graficoSedes"></canvas>
            </div>
            <div class="mb-3 text-end">
                    <a href="../views/empleados.php" class="btn border border-warning">INICIO</a>
            </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Configurar los datos para Chart.js
            var data = {
                labels: <?php echo json_encode(array_keys($sedeCounts)); ?>,
                datasets: [{
                    label: 'Cantidad de Personas por Sede',
                    data: <?php echo json_encode(array_values($sedeCounts)); ?>,
                    backgroundColor: 'rgba(225, 191, 104, 0.68)',
                    borderColor: 'rgba(0, 0, 0, 1)',
                    borderWidth: 1
                }]
            };

            // Configurar las opciones del gráfico
            var options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Obtener el contexto del canvas
            var ctx = document.getElementById('graficoSedes').getContext('2d');

            // Crear el gráfico de barras
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        });
    </script>
    </body>
</html>
