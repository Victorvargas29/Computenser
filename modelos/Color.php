<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");

   require_once("../modelos/Bitacora.php");

   
   Class Colors extends Conexion {
    
       //listar los usuarios
   	    public function get_color_2(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from color";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
   	    }
        public function get_color(){

          $conectar=parent::conectar();
        //  parent::set_names();

          $sql="select * from color";

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();
        }

   	    public function registrar_color($nombre){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into color values(null,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]); 
             $sql->execute();
             $bita = new Bitacora();
             $bita->registrar('Registrar','color');
            // print_r($_POST);
   	    }

   	    public function editar_color($idColor, $nombre){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update color set nombre=? where idColor=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idColor"]);
             $sql->execute();
             $bita = new Bitacora();
             $bita->registrar('Actualizar','color');
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_color_por_id($idColor){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from color where idColor=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idColor);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_color($idColor){
          $conectar=parent::conectar();

          $sql="delete from color where idColor=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idColor);
          $sql->execute();
          $bita = new Bitacora();
          $bita->registrar('Eliminar','color');
          return $resultado=$sql->fetch();
        }
   }
   
?>