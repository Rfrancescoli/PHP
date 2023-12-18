<!doctype html>
<html lang="es">
  <head>
    <title>Buscador de Empleados</title>
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
      <div class="card">
        <div class="card-header bg-info">
          <span class="text-ligth">BUSCADOR</span>
        </div>
        <div class="card-body">
          
          <form action="" id="formBusqueda" autocomplete="off">
            <div class="input-group mb-3">
                <input type="text" maxlength="8" autofocus placeholder="INGRESE SU NUMERO DE DOCUMENTO" class="form-control text-center" id="nrodocumento">
                <button class="btn border border-info" type="button" id="btBuscar">Buscar</button>
            </div>

              <small id="status">No hay busquedas activas</small>
            
            <div class="mb-3">
              <label for="">ID:</label>
              <input type="text" name="idempleado" id="idempleado" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label for="">Sede:</label>
                <input type="text" id="sede" class="form-control" readonly>        
              </div>
              <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" class="form-control" readonly>        
              </div>
              <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" id="nombres" class="form-control" readonly>        
              </div>


              <div class="mb-3">
                <label for="fechanac" class="form-label">Fecha de Nacimiento:</label>
                <input type="text" id="fechanac" class="form-control" readonly>        
              </div>
              
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" id="telefono" class="form-control" readonly>        
              </div>  
            </div>

            <div class="card-header">
            <div class="row">
            <div class="col mb-6">
            <a href="../views/empleado-listar.php" style="width: 100%;" class="btn border border-info">Lista Empleado</a>
            </div>
            <div class="col mb-6">
            <a href="../views/empleados-registrar.php" style="width: 100%;"  class="btn border border-info">Registrar Empleado</a>
            </div>
            <div class="col mb-6">
            <a href="../views/diagrama.php" style="width: 100%;"  class="btn border border-info">Estadistica Empleado</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

    <script>
      document.addEventListener("DOMContentLoaded", ()=>{
        function $(id){
            return document.querySelector(id)
        }

        function BuscarDNI(){
            const nrodocumento =$("#nrodocumento").value

            if(nrodocumento !=""){
                const parameters = new FormData()

                parameters.append("operacion","search")
                parameters.append("nrodocumento",nrodocumento)
                $("#status").innerHTML="Buscando por favor espere...."
                fetch(`../controllers/Empleado.controller.php`,{
                    method:"POST",
                    body: parameters,

                })
                    .then(respuesta => respuesta.json())
                    .then(datos=>{

                        if(!datos){
                            $("#status").innerHTML="No se encontro la persona"
                            $("#formBusqueda").reset()
                            $("#nrodocumento").focus()
                        }else{
                            $("#status").innerHTML="Persona encontrada"
                            $("#idempleado").value=datos.idempleado
                            $("#sede").value=datos.sede
                            $("#apellidos").value=datos.apellidos
                            $("#nombres").value=datos.nombres
                            $("#nrodocumento").value=datos.nrodocumento
                            $("#fechanac").value=datos.fechanac
                            $("#telefono").value=datos.telefono
                        }
                    })
                    .catch(e=> {
                        console.error(e)
                    })

            }
        }
        $("#nrodocumento").addEventListener("keypress",(event)=>{
            if(event.keyCode ==13){
                BuscarDNI()
            }
        })

        $("#btBuscar").addEventListener("click", BuscarDNI)

      })
    </script>
  </body>
</html>