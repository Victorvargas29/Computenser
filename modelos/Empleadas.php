<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");
   require_once("../modelos/Bitacora.php");

   class Empleadas extends conexion {

       //listar los usuarios
        public function get_filas_empleada(){

          $conectar=parent::conectar();
        //  parent::set_names();

          $sql="select * from empleada";

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();
        }


        
   	    public function get_empleada2(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql = "select * from empleada";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
   	    }
         public function get_empleada(){

          $conectar=parent::conectar();
        //	parent::set_names();

          $sql = "select * from empleada";

          $sql=$conectar->prepare($sql);
          $sql->execute();

         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
                      
        //metodo para registrar usuario
   	    public function registrar_empleada($cedula, $nombre, $telefono, $direccion){

             $conectar=parent::conectar();
             //parent::set_names();

             $sql="insert into empleada values(?,?,?,?);";
             

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $_POST["cedula"]);
             $sql->bindValue(2, $_POST["nombre"]);
             $sql->bindValue(4, $_POST["telefono"]);
             $sql->bindValue(5, $_POST["direccion"]);  
             
            
             $sql->execute();
             $bita = new Bitacora();
             $bita->registrar('Registrar','empleado');
             print_r($_POST);
             
   	    }

        //metodo para editar usuario
   	    public function editar_empleada($cedula, $nombre, $telefono, $direccion){

             $conectar=parent::conectar(); 
            // parent::set_names();

             $sql="update empleada set nombre=?, telefono=?, direccion=? where cedula=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $nombre);
             $sql->bindValue(2, $telefono);
             $sql->bindValue(3, $direccion);
             $sql->bindValue(4, $cedula);
             $sql->execute();
             $bita = new Bitacora();
             $bita->registrar('Actualizar','empleado');
   	    }

        
        //mostrar los datos del usuario por el id
   	    public function get_empleada_por_id($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();

          $sql="select  *  from empleada where cedula=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $cedula);
          $sql->execute();

          return $resultado=$sql->fetchAll();

   	    }



        public function eliminar_empleada($cedula){
          $conectar=parent::conectar();

          $sql="delete from empleada where cedula=?";
          
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          $bita = new Bitacora();
          $bita->registrar('Eliminar','empleado');
          return $resultado=$sql->fetch();
        }

   }



?>