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

   	    public function registrar_vehiculo($cedula,$nombre,$apellido,$direccion,$telefono,$correo){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into vehiculo values(?,?,?,?,?,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["cedula"]); 
             $sql->bindValue(2, $_POST["nombre"]); 
             $sql->bindValue(3, $_POST["apellido"]); 
             $sql->bindValue(4, $_POST["direccion"]); 
             $sql->bindValue(5, $_POST["telefono"]);
             $sql->bindValue(6, $_POST["correo"]);
             $sql->execute();
            // print_r($_POST);
   	    }

   	    public function editar_vehiculo($cedula, $nombre, $apellido,$direccion,$telefono,$correo){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update vehiculo set nombre=?, apellido=?, direccion=?, telefono=?, correo=? where cedula=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["apellido"]);
             $sql->bindValue(3, $_POST["direccion"]);
             $sql->bindValue(4, $_POST["telefono"]);
             $sql->bindValue(5, $_POST["correo"]);
             $sql->bindValue(6, $_POST["cedula"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_vehiculo_por_id($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from vehiculo where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_vehiculo($cedula){
          $conectar=parent::conectar();

          $sql="delete from vehiculo where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>