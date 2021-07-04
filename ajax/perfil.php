<?php


  require_once("../modelos/perfil.php");


  $usuarios = new Perfil();

  //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

  $idUsuario_perfil = isset($_POST["idUsuario_perfil"]);
  $nombre_perfil=isset($_POST["nombre_perfil"]);
  $apellido_perfil=isset($_POST["apellido_perfil"]);
//  $email_perfil=isset($_POST["email_perfil"]);
 // $tipo_usuario_perfil=isset($_POST["tipo_usuario_perfil"]);
/*  $password1=isset($_POST["password1"]);
  $password2=isset($_POST["password2"]);*/

  //este es el que se envia del formulario
//  $estado_perfil=isset($_POST["estado_perfil"]);
 // $avatar_perfil =isset($_POST["hidden_avatar_user_perfil"]);
  //$ruta_avatar = "..public/images".$avatar;

  switch($_GET["opcion"]){

    case "editar":

  /*  $datos = $usuarios->get_usuario_por_id($_POST["idUsuario_perfil"]);

    if(is_array($datos)==true and count($datos)>0){*/

      $usuarios->editar_perfil($idUsuario_perfil,$nombre_perfil,$apellido_perfil);

  /*  }else{
      echo "no sirve";
    }*/


         break;


         case "mostrar_perfil":

            //selecciona el id del usuario
    
           //el parametro id_usuario se envia por AJAX cuando se edita el usuario

          $datos = $usuarios->get_usuario_por_id($_POST["idUsuario_perfil"]);

          //validacion del id del usuario  

             if(is_array($datos)==true and count($datos)>0){

             	 foreach($datos as $row){
                      
                  
                    $output["nombre"] = $row["nombre"];
            				$output["apellido"] = $row["apellido"];
            				$output["tipo_usuario"] = $row["tipo_usuario"];
            	
            				//$output["password1"] = $row["password"];
            				//$output["password2"] = $row["password2"];
            	
            				$output["email"] = $row["email"];
   
            				$output["estado"] = $row["estado"];

                    if($row["avatar"] != '')  
                    {
                      $output['avatar'] = '<img src="../public/images/'.$row["avatar"].'" class="img-thumbnail rounded-circle" width="180" height="50" /><input type="hidden" name="hidden_avatar_user" value="'.$row["avatar"].'" />';
                    }//class="rounded-circle"
                    else
                    {
                      $output['avatar'] = '<input type="hidden" name="hidden_avatar_user" value="" />';
                    }
             	 }

             	 echo json_encode($output);

             } else {

                    //si no existe el registro entonces no recorre el array
                $errors[]="El usuario no existe";

             }

         break;
     }


?>