<?php 

require_once("../config/conexion.php");

require_once("../modelos/Fallas.php");
require_once("../modelos/Vehiculos.php");

	$falla = new Fallas();
	$vehiculo = new Vehiculos();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$idFalla = isset($_POST["idFalla"]);
   $nombre = isset($_POST["nombre"]);

   	switch ($_GET["op"]) {
   		case 'guardaryeditar':

        
			
			if(empty($_POST["idFalla"])){
			$datos = $falla->get_falla_por_id($_POST["idFalla"]);
				if(is_array($datos)==true and count($datos)==0){

				$falla->registrar_falla($nombre);
				echo "se registro";
				
				}else{

				echo "el producto ya existe";
				
				}
			}else{

				$falla->editar_falla($idFalla, $nombre);
				echo "se edito";
			}
           
     	break;

   		case 'selectVehiculo':
   			
			$rspta= $vehiculo->get_vehiculo();
			echo '<option value="0" selected disabled>Ingrese la placa </option>';
			foreach ($rspta as $reg) {
			  echo '<option class="font-weight-bold" value='. $reg->nombreCli .'>'. $reg->nombreCli . '</option>';
			}

   		break;

   		case 'listar':

   			$datos = $falla->get_falla();
			$data = array();
			foreach ($datos as $row) {
				$sub_array = array();

				$sub_array[]=$row["idFalla"];
				$sub_array[]=$row["nombre"];

					$sub_array[] = '<button type="button" onClick="mostrar('.$row["idFalla"].');"  id="'.$row["idFalla"].'" class="btn btn-warning btn-md update" title="Editar Falla"><i class="fas fa-edit"></i></button>';


				$sub_array[] = '<button type="button" onClick="eliminar_falla('.$row["idFalla"].');"  id="'.$row["idFalla"].'" class="btn btn-danger btn-md" title="Eliminar Falla"><i class="fas fa-trash-alt"></i></button>';

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

        case "eliminar_falla":

            $datos = $falla->get_falla_por_id($_POST["idFalla"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $falla->eliminar_falla($_POST["idFalla"]);
                  $messages[]="se elimino correctamente";
            }
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