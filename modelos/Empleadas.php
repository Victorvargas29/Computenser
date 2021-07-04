<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


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



   	    public function get_empleada(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql = "select e.cedula, e.nombre as nombre, e.apellido, e.fecha_ingreso, e.telefono, e.direccion, d.nombre as depa_nombre from empleada e INNER JOIN departamento d ON e.idDepartamento=d.idDepartamento";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }
                      
        //metodo para registrar usuario
   	    public function registrar_empleada($cedula, $nombre, $apellido, $telefono, $direccion,$idDepartamento){

             $conectar=parent::conectar();
             //parent::set_names();

             $sql="insert into empleada values(?,?,?,now(),?,?,'Email',?);";
             

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $_POST["cedula"]);
             $sql->bindValue(2, $_POST["nombre"]);
             $sql->bindValue(3, $_POST["apellido"]);
             $sql->bindValue(4, $_POST["telefono"]);
             $sql->bindValue(5, $_POST["direccion"]);  
             $sql->bindValue(6, $_POST["idDepartamento"]);
            
             $sql->execute();
             print_r($_POST);
   	    }

        //metodo para editar usuario
   	    public function editar_empleada($cedula, $nombre, $apellido, $telefono, $direccion){

             $conectar=parent::conectar();
            // parent::set_names();

             $sql="update empleada set

              nombre=?,
              apellido=?, 
              telefono=?,
              direccion=?

              where 
              cedula=?

             ";

             //echo $sql;    //imprime la consulta para verificar en phpmyadmin

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["apellido"]);
             $sql->bindValue(3, $_POST["telefono"]);
             $sql->bindValue(4, $_POST["direccion"]);
           //  $sql->bindValue(5, $_POST["email"]); 
             $sql->bindValue(5, $_POST["cedula"]);

             $sql->execute();
            

            print_r($_POST);
             //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	   /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

        
        //mostrar los datos del usuario por el id
   	    public function get_empleada_por_id($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();

          $sql="select  e.cedula, e.nombre, e.apellido, e.telefono, e.direccion, e.email, e.idDepartamento, d.nombre as nom from empleada e inner join departamento d on e.idDepartamento=d.idDepartamento where cedula=?";

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

          return $resultado=$sql->fetch();
        }

   }



?>