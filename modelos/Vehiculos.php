<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Vehiculos extends Conexion {

       //listar los usuarios
   	    public function get_vehiculo(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from vehiculo";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }

   	    public function registrar_vehiculo($placa,$cliente,$año,$color,$generacion){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into vehiculo values(?,?,?,?,?);";
             $sql=$conectar->prepare($sql);        
             $sql->bindValue(1, $_POST["placa"]); 
             $sql->bindValue(2, $_POST["cedula"]); 
             $sql->bindValue(3, $_POST["año"]); 
             $sql->bindValue(4, $_POST["idColor"]); 
             $sql->bindValue(5, $_POST["generacion"]);
             $sql->execute();
            // print_r($_POST);
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
          //parent::set_names();
          $sql="select * from vehiculo where placa=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $placa);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

         public function get_vehiculo_por_cliente($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();
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
          $sql->bindValue(1, $placa);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>