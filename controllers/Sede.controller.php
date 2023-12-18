<?php

require_once '../models/Sede.php';

//1. Recibe solicitud
//2. Realiza proceso
//3. Entrega resultado

if (isset($_GET['operacion'])){
  $sede = new Sede();

  if ($_GET['operacion'] == 'listar'){
    $resultado = $sede-> getAll();
    echo json_encode($resultado);
  }
}