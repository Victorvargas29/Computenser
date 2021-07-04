<?php


  require_once("../modelos/Usuarios.php");


  $usuarios = new Usuarios();

  //declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

  $idUsuario = isset($_POST["idUsuario"]);
  $nombre=isset($_POST["nombre"]);
  $apellido=isset($_POST["apellido"]);
  $email=isset($_POST["email"]);
  $tipo_usuario=isset($_POST["tipo_usuario"]);
  $password1=isset($_POST["password1"]);
  $password2=isset($_POST["password2"]);
  //este es el que se envia del formulario
  $estado=isset($_POST["estado"]);
  $avatar=isset($_POST["avatar"]);
  //$ruta_avatar = "..public/images".$avatar;

  switch($_GET["op"]){

    case "guardaryeditar":
      /*verificamos si existe la cedula y correo en la base de datos, si ya existe un registro con la cedula o correo entonces no se registra el usuario*/
      $datos = $usuarios->get_correo_del_usuario($_POST["email"]);
       
      //validacion de password
      if($password1 == $password2){
     	  /*si el id no existe entonces lo registra
        importante: se debe poner el $_POST sino no funciona*/
	      if(empty($_POST["idUsuario"])){
	        /*si coincide password1 y password2 entonces verificamos si existe la cedula y correo en la base de datos, si ya existe un registro con la cedula o correo entonces no se registra el usuario*/
	        if(is_array($datos)==true and count($datos)==0){   
            //no existe el usuario por lo tanto hacemos el registros
            // if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $ruta_avatar)){         
            $usuarios->registrar_usuario($nombre,$apellido,$email,$tipo_usuario,$password1,$estado,$avatar); 
              
              // $messages[]="El usuario se registró correctamente";
              /*si ya exista el correo y la cedula entonces aparece el mensaje*/
          } else {
            $messages[]="La cédula o el correo ya existe";
	          }
        } //cierre de la validacion empty
        else {
          /*si ya existe entonces editamos el usuario*/
          /*$avatar_temporal = $usuarios->get_avatar_old($_POST["idUsuario"]));*/
       //   $avatar_temporal = $_SESSION["avatar"];
          $usuarios->editar_usuario($idUsuario,$nombre,$apellido,$email,$tipo_usuario,$password1,$estado,$avatar);
          // $usuarios->avatar_login($idUsuario);
          $messages[]="El usuario se editó correctamente";

       //   if(isset($avatar_temporal)){
         //   unlink("../public/images/".$avatar_temporal);
        //    echo "Se ha borrado ".$avatar_temporal;
      /*    }else{
            echo $avatar_temporal . " no existe";
          }  */
       //   echo $avatar_temporal;
        }       
      } else {
     	  /*si el password no conincide, entonces se muestra el mensaje de error*/
        $errors[]="El password no coincide";
        }

         break;


         case "mostrar":

            //selecciona el id del usuario
    
           //el parametro id_usuario se envia por AJAX cuando se edita el usuario

          $datos = $usuarios->get_usuario_por_id($_POST["idUsuario"]);

          //validacion del id del usuario  

             if(is_array($datos)==true and count($datos)>0){

             	 foreach($datos as $row){
                      
                  
                    $output["nombre"] = $row["nombre"];
            				$output["apellido"] = $row["apellido"];
            				$output["tipo_usuario"] = $row["tipo_usuario"];
            	
            				$output["password1"] = $row["password"];
            				//$output["password2"] = $row["password2"];
            	
            				$output["email"] = $row["email"];
   
            				$output["estado"] = $row["estado"];

                    if($row["avatar"] != '')  
                    {
                      $output['avatar'] = '<img src="../public/images/'.$row["avatar"].'" class="img-thumbnail" width="180" height="50" /><input type="hidden" name="hidden_avatar_user" value="'.$row["avatar"].'" />';
                    }
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


	         //inicio de mensaje de error

				if(isset($errors)){
			
					?>
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Error!</strong> 
							<?php
								foreach($errors as $error) {
										echo $error;
									}
								?>
					</div>
					<?php
			      }

	        //fin de mensaje de error

         break;

         case "activarydesactivar":
              
                //los parametros id_usuario y est vienen por via ajax
              $datos = $usuarios->get_usuario_por_id($_POST["idUsuario"]);
                
                //valida el id del usuario
                 if(is_array($datos)==true and count($datos)>0){
                    
                    //edita el estado del usuario 
                    $usuarios->editar_estado($_POST["idUsuario"],$_POST["est"]);
                 }
         break;

         case "listar":
          
         $datos = $usuarios->get_usuarios();

         //declaramos el array

         $data = Array();


         foreach($datos as $row){

            
            $sub_array= array();

             //ESTADO
	        $est = '';
	       
	         $atrib = "btn btn-success btn-md estado";
           $atrib_icon = "fas fa-check";

	        if($row["estado"] == 0){
	          $est = 'INACTIVO';
	          $atrib = "btn btn-warning btn-md estado";
            $atrib_icon = "fas fa-minus";
	        }
	        else{
	          if($row["estado"] == 1){
	            $est = 'ACTIVO';
	            $atrib_icon = "fas fa-check";
	          } 
	        }


            //cargo

            if($row["tipo_usuario"]==1){

              $cargo="ADMINISTRADOR";

            } else{

            	if($row["tipo_usuario"]==0){
                   
                   $cargo="EMPLEADO";
            	}
            }


	     $sub_array[]= $row["idUsuario"];
	     $sub_array[] = $row["nombre"];
         $sub_array[] = $row["apellido"];
         $sub_array[] = $cargo;
         $sub_array[] = $row["email"];

      //   $sub_array[] = date("d-m-Y",strtotime($row["fecha_ingreso"]));

              
              $sub_array[] = '<button title="'.$est.'" type="button" onClick="cambiarEstado('.$row["idUsuario"].','.$row["estado"].');" name="estado" id="'.$row["idUsuario"].'" class="'.$atrib.'"><i class="'.$atrib_icon.'"></i></button>';


                $sub_array[] = '<button title="Editar" type="button" onClick="mostrar('.$row["idUsuario"].');"  id="'.$row["idUsuario"].'" class="btn btn-warning btn-md update"><i class="fas fa-edit"></i></button>';


                $sub_array[] = '<button title="Eliminar" type="button" onClick="eliminar_usuario('.$row["idUsuario"].');"  id="'.$row["idUsuario"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';

                if($row["avatar"] != '')
                {
                  $sub_array[] = '<img src="../public/images/'.$row["avatar"].'" class="rounded-circle" width="50" height="50" /><input type="hidden" name="hidden_avatar_user" value="'.$row["avatar"].'" />';
                }
                else
                {
                  $sub_array[] = '<button type="button" id="" class="btn btn-primary btn-md"><i class="fa fa-picture-o" aria-hidden="true"></i> Sin imagen</button>';
                }
                

        
	     $data[]=$sub_array;
	    
	        
         }

         $results= array(	

         "sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
         echo json_encode($results);


         break;

         case "eliminar_usuario":

          $datos = $usuarios->get_usuario_por_id($_POST["idUsuario"]);
          if(is_array($datos)==true and count($datos)>0){
            $avatar_temporal = $_SESSION["avatar"];
            
            $usuarios->eliminar_usuario($_POST["idUsuario"]);
            $messages[]="El usuario se elimino correctamente";

              if(isset($avatar_temporal)){
                unlink("../public/images/".$avatar_temporal);
                echo "Se ha borrado ".$avatar_temporal;
              }else{
                echo $avatar_temporal . " no existe";   
              }
            }


      //prueba mensaje de success
          if(isset($messages)){
            ?>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert">&times;                
              </button>
              <strong>¡Bien hecho!</strong>
              <?php 
                foreach ($messages as $message) {
                  echo $message;
                }
               ?>
            </div>
            <?php
          }//fin mensaje
         break;
     }


?>