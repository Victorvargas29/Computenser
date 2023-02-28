<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Proveedores extends Conexion {

       //listar los usuarios
   	    public function get_proveedor(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from proveedor";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }

   	    public function registrar_proveedor($rif,$nombre,$direccion,$telefono,$correo){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into proveedor values(?,?,?,?,?,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["rif"]); 
             $sql->bindValue(2, $_POST["nombre"]); 
             $sql->bindValue(3, $_POST["direccion"]); 
             $sql->bindValue(4, $_POST["telefono"]);
             $sql->bindValue(5, $_POST["correo"]);
             $sql->execute();
            // print_r($_POST);
   	    }

   	    public function editar_proveedor($rif, $nombre,$direccion,$telefono,$correo){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update proveedor set nombre=?, direccion=?, telefono=?, correo=? where rif=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["direccion"]);
             $sql->bindValue(3, $_POST["telefono"]);
             $sql->bindValue(4, $_POST["correo"]);
             $sql->bindValue(5, $_POST["rif"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_proveedor_por_id($rif){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from proveedor where rif=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $rif);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_proveedor($rif){
          $conectar=parent::conectar();

          $sql="delete from proveedor where rif=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $rif);
          $sql->execute();
          return $resultado=$sql->fetch();
        }
   }
   
?>