<?php 

require_once("../config/conexion.php");

require_once("../modelos/Color.php");

	$color = new Colors();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$idColor = isset($_POST["idColor"]);
   $nombre = isset($_POST["nombre"]);

   	switch ($_GET["op"]) {
   		case 'guardaryeditar':

        
        
        if(empty($_POST["idColor"])){
        
           

               $color->registrar_color($nombre);
               echo "se registro";
               
            
        }else{

            $color->editar_color($idColor, $nombre);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $color->get_color_por_id($_POST["idColor"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idColor"] = $row["idColor"];
   					$output["nombre"] = $row["nombre"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Color no existe";
   			}

   	//inicio mensaje errors
   	if(isset($errors)){
   		?>
   		<div class="alert alert-danger" role="alert">
   			<button type="button" class="close" data-dismiss="alert">&times;</button>
   			<strong>Error!</strong>
   			<?php
   				foreach ($errors as $error) {
   					echo $error;
   				}

   			?>
   		</div>

   		<?php
   	}//fin mensaje error

   			break;

   		case 'listar':

   			$datos = $color->get_color();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idColor"];
   					$sub_array[]=$row["nombre"];

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idColor"].');"  id="'.$row["idColor"].'" class="btn btn-warning btn-md update" title="Editar Color"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_color('.$row["idColor"].');"  id="'.$row["idColor"].'" class="btn btn-danger btn-md" title="Eliminar Color"><i class="fas fa-trash-alt"></i></button>';

   					$data[]=$sub_array;
   				}
   				$results=array(
   					"sEcho"=>1,
   					"iTotalRecords"=>count($data),
   					"iTotalDisplayRecords"=>count($data),
   					"aaData"=>$data
   					);

   				echo json_encode($results);
   			break;

            case "eliminar_color":

            $datos = $color->get_color_por_id($_POST["idColor"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $color->eliminar_color($_POST["idColor"]);
                  $messages[]="se elimino correctamente";
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