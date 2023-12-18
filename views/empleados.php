<!doctype html>
<html lang="es">
  <head>
    <title>Inicio</title>
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
  <div class="container">
    <div class="card mt-2">
    <div class="card-header bg-warning">
        <br>
        <span class="text-light"><h1><center>EMPLEADOS</center></h1></span>
        <br>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col mb-6">
            <a href="../views/empleados-registrar.php" style="width: 100%;"  class="btn border border-warning">Registrar Empleado</a>
            </div>

            <div class="col mb-6">
            <a href="../views/empleados-buscar.php" style="width: 100%;" class="btn border border-warning">Buscar Empleado</a>
            </div>

            <div class="col mb-6">
            <a href="../views/empleado-listar.php" style="width: 100%;"  class="btn border border-warning">Lista Empleado</a>
            </div>
        </div>
    </div>
    </div>
    <div class="col mb-6">
            <a href="../views/diagrama.php" style="width: 100%;"  class="btn btn-secondary">CUADRO ESTADISTICO</a>
            </div>

    </div>
  </body>
</html>
