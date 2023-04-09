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
      $sql = "select c.cedula, ma.nombre as marca_nom, mo.nombre as modelo_nom, v.placa, co.nombre as color_nom, v.anno 
      from vehiculo v 
      INNER JOIN cliente c ON v.cedula=c.cedula
      INNER JOIN color co ON v.idColor=co.idColor
      INNER JOIN generacion g ON v.idGeneracion=g.id
      INNER JOIN modelo mo ON g.idModelo=mo.idModelo
      INNER JOIN marca ma ON mo.idMarca=ma.idMarca";
      $sql=$conectar->prepare($sql);
      $sql->execute();
      return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

   	public function registrar_vehiculo($placa,$cliente,$año,$color,$generacion){
      $conectar=parent::conectar();
      $sql="insert into vehiculo values(?,?,?,?,?);";
      $sql=$conectar->prepare($sql);        
      $sql->bindValue(1, $_POST["placa"]); 
      $sql->bindValue(2, $_POST["cedula"]); 
      $sql->bindValue(3, $_POST["año"]); 
      $sql->bindValue(4, $_POST["idColor"]); 
      $sql->bindValue(5, $_POST["generacion"]);
      $sql->execute();
    }

   	public function editar_vehiculo($placa, $año,$color,$generacion){

      $conectar=parent::conectar();
      $sql="update vehiculo set anno=?, idColor=?, idGeneracion=? where placa=?";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1, $_POST["anno"]);
      $sql->bindValue(2, $_POST["idColor"]);
      $sql->bindValue(3, $_POST["generacion"]);
      $sql->bindValue(4, $_POST["placa"]);
      $sql->execute();

    }

    public function get_vehiculo_por_id($placa){ 
      $conectar=parent::conectar();
      //$sql="select * from vehiculo where placa=?";
      $sql = "select c.cedula, ma.idMarca, ma.nombre as marca_nom, mo.idModelo, mo.nombre as modelo_nom, v.placa, co.idColor, co.nombre as color_nom, v.anno, v.idGeneracion 
      from vehiculo v 
      INNER JOIN cliente c ON v.cedula=c.cedula
      INNER JOIN color co ON v.idColor=co.idColor
      INNER JOIN generacion g ON v.idGeneracion=g.id
      INNER JOIN modelo mo ON g.idModelo=mo.idModelo
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