<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Marcas extends Conexion {

       //listar los usuarios
   	    public function get_marca_2(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from marca";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
   	    }
        public function get_marca(){

          $conectar=parent::conectar();
        //  parent::set_names();

          $sql="select * from marca";

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();
        }

   	    public function registrar_marca($nombre){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into marca values(null,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]); 
             $sql->execute();
            // print_r($_POST);
   	    }

   	    public function editar_marca($idMarca, $nombre){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update marca set nombre=? where idMarca=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idMarca"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_marca_por_id($idMarca){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from marca where idMarca=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idMarca);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }
         public function get_marca_por_Nombre($nombre){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from marca where nombre=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $nombre);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_marca($idMarca){
          $conectar=parent::conectar();

          $sql="delete from marca where idMarca=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idMarca);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>