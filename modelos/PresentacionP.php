<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class PresentacionP extends Conexion {

       //listar los usuarios
   	    public function get_presentacionP(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from PresentacionProducto";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }

   	    public function registrar_presentacionP($nombre){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into presentacionProducto values(null,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]); 
             $sql->execute();
            // print_r($_POST);
   	    }

   	    public function editar_presentacionP($idPresentacionP, $nombre){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update presentacionProducto set nombre=? where idPresentacionP=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idPresentacionP"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_presentacionP_por_id($idPresentacionP){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from presentacionProducto where idPresentacionP=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idPresentacionP);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_presentacionP($idPresentacionP){
          $conectar=parent::conectar();

          $sql="delete from presentacionProducto where idPresentacionP=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idPresentacionP);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>