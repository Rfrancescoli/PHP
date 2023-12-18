<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

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
    // Conexión a la base de datos utilizando PDO
            $dsn = 'mysql:host=localhost;dbname=SENATIDB';
            $username = 'root';
            $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Error de conexión: ' . $e->getMessage());
    }

    // Consulta SQL 
    $sql = 'SELECT idempleado, idsede, apellidos, nombres, nrodocumento, fechanac, telefono
            FROM empleados';

    try {
        // Preparar y ejecutar
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Obtener los resultados 
        $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Error al ejecutar la consulta: ' . $e->getMessage());
    }
    ?>
    <div class="container">
    <div class="card mt-2  border border-info">
    <div class="card-header bg-info">
    <br>
        <span class="text"><h1><center>EMPLEADOS</center></h1></span>
        <br>
    </div>
    <div class="card-body">
    <table class="table table-hover">
    <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID Empleado</th>
                    <th>ID Sede</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Número de Documento</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td><?php echo $empleado['idempleado']; ?></td>
                        <td><?php echo $empleado['idsede']; ?></td>
                        <td><?php echo $empleado['apellidos']; ?></td>
                        <td><?php echo $empleado['nombres']; ?></td>
                        <td><?php echo $empleado['nrodocumento']; ?></td>
                        <td><?php echo $empleado['fechanac']; ?></td>
                        <td><?php echo $empleado['telefono']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </div>
        </table>
    </div>  
    <div class="container">
    <div class="card-header">
    <div class="row">
        <div class="col mb-6">
            <a href="../views/empleados-registrar.php" style="width: 100%;"  class="btn border border-light-subtle">Registrar Empleado</a>
        </div>
        <div class="col mb-6">
            <a href="../views/empleados-buscar.php" style="width: 100%;"  class="btn border border-light-subtle">Buscar Empleado</a>
        </div>
        <div class="col mb-6">
            <a href="../views/diagrama.php" style="width: 100%;"  class="btn border border-light-subtle">Estadistica</a>
        </div>
    </div>  
    </div>

</body>

</html>