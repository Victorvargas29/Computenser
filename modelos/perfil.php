<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   class Perfil extends conexion {

    

        //metodo para editar usuario
   

        public function editar_perfil($idUsuario_perfil,$nombre_perfil,$apellido_perfil){

             $conectar=parent::conectar();
          //   $avatar_usuario = new Usuarios();

   //   $avatar = '';

/*      if($_FILES["avatar"]["name"] != '')
        {
          $avatar = $avatar_usuario->upload_image();
        }
      else
        {
          
          $avatar = $_POST["hidden_avatar_perfil"];
        }*/

             $sql="update usuario set 

              nombre=?,
              apellido=?

              where 
              idUsuario=?
             ";

             //echo $sql;    //imprime la consulta para verificar en phpmyadmin

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $_POST["nombre_perfil"]);
             $sql->bindValue(2, $_POST["apellido_perfil"]);
             $sql->bindValue(3, $_POST["idUsuario_perfil"]);
             $sql->execute();

             print_r($_POST);   //comprobar que si se estan enviando los datos
       /*para q se muestre los valores en la consola hay q agregar console.log(datos);
        en el js debajo del success   */

       // $avatar_usuario->avatar_login($_POST["idUsuario"]);

        }
        //mostrar los datos del usuario por el id
   	    public function get_usuario_por_id($idUsuario_perfil){
          
          $conectar=parent::conectar();
         

          $sql="select * from usuario where idUsuario=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $idUsuario_perfil);
          $sql->execute();

          return $resultado=$sql->fetchAll();

   	    }

   	    //editar el estado del usuario, activar y desactiva el estado

  
   }



?>