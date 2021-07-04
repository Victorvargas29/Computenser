<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Departamentos extends Conexion {

       //listar los usuarios
   	    public function get_departamento_2(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from departamento";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
   	    }
        public function get_departamento(){

          $conectar=parent::conectar();
        //  parent::set_names();

          $sql="select * from departamento";

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();
        }

   	    public function registrar_departamento($nombre){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into departamento values(null,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]); 
             $sql->execute();
            // print_r($_POST);
   	    }

   	    public function editar_departamento($idDepartamento, $nombre){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update departamento set nombre=? where idDepartamento=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idDepartamento"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_departamento_por_id($idDepartamento){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from departamento where idDepartamento=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idDepartamento);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_departamento($idDepartamento){
          $conectar=parent::conectar();

          $sql="delete from departamento where idDepartamento=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idDepartamento);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>