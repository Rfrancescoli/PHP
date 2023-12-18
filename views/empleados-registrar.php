<!doctype html>
<html lang="es">
  <head>
    <title>Registrador de Empleados</title>
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
      <d  iv class="card">
        <div class="card-header bg-info">
          <span class="text-ligth">REGISTRAR NUEVO EMPLEADO</span>
        </div>
        <div class="card-body">
          
          <form action="" id="formRegistrar" autocomplete="off">
              
              <div class="mb-3">
                <label for="">Sede:</label>
                <select name="" id="sede" class="form-control" required>
                  <option value="">Seleccione su sede</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" class="form-control" required>        
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Nombres:</label>
                <input type="text" id="nombres" class="form-control" required>        
              </div>

              <div class="mb-3">
                <label for="" class="form-label" >Nro. Documento</label>
                <input type="text" id="nrodocumento" maxlength="8" class="form-control" required>        
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Fecha Nacimiento</label>
                <input type="date" id="fechanac" class="form-control" required>        
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Teléfono</label>
                <input type="text" id="telefono" maxlength="9" class="form-control" required>        
              </div>

              <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary" id="guardar">Guardar Datos</button>
                <button type="button" class="btn btn-secondary">Cancelar</button>
                 <a href="../views/Empleados.php" class="btn btn-primary">Inicio</a>
              </div>
              <div class="card-header">
              <div class="row">
              <div class="col mb-6">
                <a href="../views/empleado-listar.php" style="width: 100%;" class="btn border border-info">Lista Empleado</a>
              </div>
              <div class="col mb-6">
                <a href="../views/empleados-buscar.php" style="width: 100%;"  class="btn border border-info">Buscar Empleado</a>
              </div>
              <div class="col mb-6">
                <a href="../views/diagrama.php" style="width: 100%;"  class="btn border border-info">Estadistica Empleado</a>
              </div>
          </form>    
      </div>        
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", (event) => {

        function $(id) {return document.querySelector(id)}

        (function () {
          fetch(`../controllers/Sede.controller.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(datos => {
              datos.forEach(element => {
                const tagoption=document.createElement("option")
                tagoption.value=element.idsede    
                tagoption.innerHTML=element.sede
                $("#sede").appendChild(tagoption)
             });

            })
            .catch(e => {
              console.error(e)
            })
        })();

        $("#formRegistrar").addEventListener("submit", () => {
          event.preventDefault();

          if (confirm("¿Desea Registrar este Empleado?")){
            const parametros = new FormData()
            parametros.append("operacion", "add") 

            parametros.append("idsede", $("#sede").value)
            parametros.append("apellidos", $("#apellidos").value)
            parametros.append("nombres", $("#nombres").value)
            parametros.append("nrodocumento", $("#nrodocumento").value)
            parametros.append("fechanac", $("#fechanac").value)
            parametros.append("telefono", $("#telefono").value)
            
            fetch(`../controllers/Empleado.controller.php`, {
              method: "POST",
              body: parametros
            })
            .then(respuesta => respuesta.json())
            .then(datos => {
              if(datos.idempleado > 0){
                $("#formRegistrar").reset()
                alert(`Empleado registrado con ID: ${datos.idempleado}`)
              }
            })
            .catch(e => {
              console.error(e)
            })

          }
        })

      })
    </script>
  </body>
</html>
