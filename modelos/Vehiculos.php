<?php

   require_once("../config/conexion.php");

   Class Vehiculos extends Conexion {

    public function get_vehiculo_2(){
      $conectar=parent::conectar();
      $sql="select * from vehiculo";
      $sql=$conectar->prepare($sql);
      $sql->execute();
      return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function get_vehiculo(){
      $conectar = parent::conectar();
      parent::set_names();
      $sql = "select c.cedula, ma.nombre as marca_nom, mo.nombre as modelo_nom, ma.idMarca, mo.idModelo, v.placa, co.nombre as color_nom, v.anno 
      from vehiculo v 
      INNER JOIN cliente c ON v.cedula=c.cedula
      INNER JOIN color co ON v.idColor=co.idColor
      INNER JOIN modelo mo ON v.idModelo=mo.idModelo
      INNER JOIN marca ma ON mo.idMarca=ma.idMarca";
      $sql=$conectar->prepare($sql);
      $sql->execute();
      return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

   	public function registrar_vehiculo($placa,$cedula,$idColor,$año,$idModelo){
      $conectar=parent::conectar();
      $sql="insert into vehiculo values(?,?,?,?,?);";
      $sql=$conectar->prepare($sql);        
      $sql->bindValue(1, $placa); 
      $sql->bindValue(2, $cedula); 
      $sql->bindValue(3, $idColor); 
      $sql->bindValue(4, $año); 
      $sql->bindValue(5, $idModelo); 
 
      $sql->execute();
    }

   	public function editar_vehiculo($placa,$cedula,$color,$año,$modelo){

      $conectar=parent::conectar();
      $sql="update vehiculo set cedula=?, idColor=?, anno=?,  idModelo=? where placa=?";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $cedula); 
      $sql->bindValue(2, $color);

      $sql->bindValue(3, $año);
      $sql->bindValue(4, $modelo);
     // $sql->bindValue(3, $modelo);
      $sql->bindValue(5, $placa);

      $sql->execute();

    }

    public function get_vehiculo_por_id($placa){ 
      $conectar=parent::conectar();
      //$sql="select * from vehiculo where placa=?";
      $sql = "select c.cedula, c.nombre as nombreCli, co.idColor, ma.nombre as marca_nom, mo.nombre as modelo_nom, ma.idMarca, mo.idModelo, v.placa, co.nombre as color_nom, v.anno 
      from vehiculo v 
      INNER JOIN cliente c ON v.cedula=c.cedula
      INNER JOIN color co ON v.idColor=co.idColor
      INNER JOIN modelo mo ON v.idModelo=mo.idModelo
      INNER JOIN marca ma ON mo.idMarca=ma.idMarca where placa=?";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $placa);
      $sql->execute();
      return $resultado=$sql->fetchAll();
    }

    public function get_vehiculo_por_cliente($cedula){
      $conectar=parent::conectar();
      $sql="select * from vehiculo where cedula=?";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $cedula);
      $sql->execute();
      return $resultado=$sql->fetchAll();
    }

    public function eliminar_vehiculo($placa){
      $conectar=parent::conectar();
      $sql="delete from vehiculo where placa=?";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $_POST["placa"]);
      $sql->execute();
      return $resultado=$sql->fetch();
    }

  }
?>