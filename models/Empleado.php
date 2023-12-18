<?php
require 'Conexion.php';

//2. Heredar sus atributos y métodos
class Empleado extends Conexion{
  //Este obkjeto almacenará la conexion y se la facilitará a todos los métodos
  private $pdo;

  //3. Almacenar la conexión en el objeto
  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  //$data es un arreglo asociativo que contiene los valores
  //requeridos por el SPU para registro vehiculos
  public function add($data = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_empleados_registrar(?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $data['idsede'],
          $data['apellidos'],
          $data['nombres'],
          $data['nrodocumento'],
          $data['fechanac'],
          $data['telefono']
        )
      );
      //Actualizacion, ahora retornamos el "idsede"
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
  public function search($data = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_empleados_listar(?)");
      $consulta->execute(
        array($data['nrodocumento'])
      );

      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}