<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Fallas extends Conexion {

       //listar los usuarios
   	    public function get_fallas(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from falla";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
   	    }
         public function  get_fallasPorVehiculo($idVehiculo){

            $conectar=parent::conectar();
            $sql="select * from falla where idVehiculo=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idVehiculo);
            $sql->execute();
       

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
   	    public function registrar_falla($descripcion, $idVehiculo){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into falla values(null,?,now(),?,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,  $descripcion); 
             $sql->bindValue(2,  $idVehiculo); 
             $sql->bindValue(3, "Abierta"); 
             $sql->execute();
            // print_r($_POST);
   	    }

   	    public function editar_falla($idfalla, $nombre){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update falla set nombre=? where idfalla=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idfalla"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_falla_por_id($idfalla){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from falla where id=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idfalla);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_falla($idfalla){
          $conectar=parent::conectar();

          $sql="delete from falla where idfalla=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idfalla);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>