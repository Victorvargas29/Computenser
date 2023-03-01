<?php 

require_once("../config/conexion.php");

require_once("../modelos/marcas.php");

	$marca = new Marcas();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$idmarca = isset($_POST["idmarca"]);
   $nombre = isset($_POST["nombre"]);

   	switch ($_GET["op"]) {
   		case 'guardaryeditar':

        
        
        if(empty($_POST["idmarca"])){
          $datos = $marca->get_marca_por_id($_POST["idmarca"]);
            if(is_array($datos)==true and count($datos)==0){

               $marca->registrar_marca($nombre);
               echo "se registro";
               
            }else{

              echo "el producto ya existe";
              
            }
        }else{

            $marca->editar_marca($idmarca, $nombre);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $marca->get_marca_por_id($_POST["idmarca"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idmarca"] = $row["idmarca"];
   					$output["nombre"] = $row["nombre"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El marca no existe";
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

   			$datos = $marca->get_marca();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idmarca"];
   					$sub_array[]=$row["nombre"];

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idmarca"].');"  id="'.$row["idmarca"].'" class="btn btn-warning btn-md update" title="Editar marca"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_marca('.$row["idmarca"].');"  id="'.$row["idmarca"].'" class="btn btn-danger btn-md" title="Eliminar marcamarca"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_marca":

            $datos = $marca->get_marca_por_id($_POST["idmarca"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $marca->eliminar_marca($_POST["idmarca"]);
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