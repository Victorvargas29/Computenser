<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   class Usuarios extends conexion {

      public function login (){

        $conectar = parent::conectar();
       

        if(isset($_POST["enviar"])){

          //inicio de validaciones

          $password = $_POST["password"];
          $correo = $_POST["email"];
          $estado = "1";

          if(empty($correo) and empty($password)){
            header("Location:".Conexion::ruta()."vistas/index.php?m=2");
            exit();
          }
/*
          else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)){

              header("Location:".Conectar::ruta()."vistas/index.php?m=3");
              exit();
          }
         */
          else{
            $sql = "select * from usuario where email=? and password=? and estado=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $correo);
            $sql->bindValue(2, $password);
            $sql->bindValue(3, $estado);
            $sql->execute();
            $resultado = $sql->fetch();


            if(is_array($resultado) and count($resultado)>0){
              $_SESSION["idUsuario"] = $resultado["idUsuario"];
              $_SESSION["email"] = $resultado["email"];
              $_SESSION["avatar"] = $resultado["avatar"];
         //     $_SESSION["cedula"] = $resultado["cedula"];
              $_SESSION["nombre"] = $resultado["nombre"]." ".$resultado["apellido"];

            //  $_SESSION["apellido"] = $resultado["apellido"];
              header("Location:".conexion::ruta()."vistas/principal.php");
              exit();
            }
            else{
              //si no existe el registro entonces le aparecera un mensaje
              header("Location:".conexion::ruta()."vistas/index.php?m=1");
              exit();
            }

          }//cierre else
        }//condicion enviar
      }
      public function avatar_login($idUsuario){
        $conectar = parent::conectar();

          $sql = "select * from usuario where idUsuario=?";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idUsuario);
            $sql->execute();

            $resultado = $sql->fetch();
            $_SESSION["avatar"] = $resultado["avatar"];
      }

      public function get_avatar_old($idUsuario){
        $conectar = parent::conectar();

        $sql = "select avatar from usuario where idUsuario=?";

        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $idUsuario);
        $sql->execute();
        return $resultado = $sql->fetch();
      }

       //listar los usuarios
   	    public function get_usuarios(){

   	    	$conectar=parent::conectar();
   	    	

   	    	$sql="select * from usuario";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }


        /*poner la ruta vistas/upload*/
         public function upload_image() {

            if(isset($_FILES["avatar_perfil"]))
            {
              $extension = explode('.', $_FILES['avatar_perfil']['name']);
              $new_name = rand() . '.' . $extension[1];
              $destination = '../public/images/' . $new_name;
              move_uploaded_file($_FILES['avatar_perfil']['tmp_name'], $destination);
              return $new_name;
            }


          }

        //metodo para registrar usuario
   	    public function registrar_usuario($nombre,$apellido,$email,$tipo_usuario,$password,$estado,$avatar){

             $conectar=parent::conectar();
           

             $avatar_usuario = new Usuarios();


            $avatar = '';
            if($_FILES["avatar"]["name"] != '')
            {
              $avatar = $avatar_usuario->upload_image();
            }

             $sql="insert into usuario 
             values(null,?,?,?,?,?,?,?);";

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["apellido"]);
             $sql->bindValue(3, $_POST["email"]);
             $sql->bindValue(4, $_POST["tipo_usuario"]);
             $sql->bindValue(5, $_POST["password1"]);
             $sql->bindValue(6, $_POST["estado"]);
             $sql->bindValue(7, $avatar);
             $sql->execute();
             print_r($_POST);
   	    }

        //metodo para editar usuario
   	    public function editar_usuario($idUsuario,$nombre,$apellido,$email,$tipo_usuario,$password,$estado,$avatar){

             $conectar=parent::conectar();
             

             $avatar_usuario = new Usuarios();

      $avatar = '';

      if($_FILES["avatar_perfil"]["name"] != '')
        {
          $avatar = $avatar_usuario->upload_image();
        }
      else
        {
          
          $avatar = $_POST["hidden_avatar_user"];
        }

             $sql="update usuario set 

              nombre=?,
              apellido=?,
              email=?,
              tipo_usuario=?,
              password=?,
              estado=?,
              avatar=?

              where 
              idUsuario=?
             ";

             //echo $sql;    //imprime la consulta para verificar en phpmyadmin

             $sql=$conectar->prepare($sql);

             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["apellido"]);
             $sql->bindValue(3, $_POST["email"]);
             $sql->bindValue(4, $_POST["tipo_usuario"]);
             $sql->bindValue(5, $_POST["password1"]);
             $sql->bindValue(6, $_POST["estado"]);
             $sql->bindValue(7, $avatar);
             $sql->bindValue(8, $_POST["idUsuario"]);
             $sql->execute();

             //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	   /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */

       // $avatar_usuario->avatar_login($_POST["idUsuario"]);

   	    }

        public function editar_perfil($idUsuario_perfil,$nombre_perfil,$apellido_perfil){

             $conectar=parent::conectar();
          //   $avatar_usuario = new Usuarios();

      $avatar = '';

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

             //print_r($_POST);   //comprobar que si se estan enviando los datos
       /*para q se muestre los valores en la consola hay q agregar console.log(datos);
        en el js debajo del success   */

       // $avatar_usuario->avatar_login($_POST["idUsuario"]);

        }
        //mostrar los datos del usuario por el id
   	    public function get_usuario_por_id($idUsuario){
          
          $conectar=parent::conectar();
         

          $sql="select * from usuario where idUsuario=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $idUsuario);
          $sql->execute();

          return $resultado=$sql->fetchAll();

   	    }

   	    //editar el estado del usuario, activar y desactiva el estado

   	    public function editar_estado($idUsuario,$estado){


   	    	$conectar=parent::conectar();
   	    	

            //el parametro est se envia por via ajax
   	    	if($_POST["est"]=="0"){

   	    		$estado=1;

   	    	} else {

   	    		$estado=0;
   	    	}

   	    	$sql="update usuario set 
            
            estado=?

            where 
            idUsuario=?


   	    	";

   	    	$sql=$conectar->prepare($sql);


   	    	$sql->bindValue(1,$estado);
   	    	$sql->bindValue(2,$idUsuario);
   	    	$sql->execute();


   	    }


   	    //valida correo y cedula del usuario

   	    public function get_correo_del_usuario($email){
          
          $conectar=parent::conectar();
          

          $sql="select * from usuario where email=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $email);
      
          $sql->execute();

          return $resultado=$sql->fetchAll();

   	    }


        public function eliminar_usuario($idUsuario){
          $conectar=parent::conectar();

          $sql="delete from usuario where idUsuario=?";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$idUsuario);
          $sql->execute();

          return $resultado=$sql->fetch();
        }
   }



?>