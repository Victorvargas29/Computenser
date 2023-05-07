<?php 

require_once("../config/conexion.php");

require_once("../modelos/Fallas.php");
require_once("../modelos/Vehiculos.php");

	$falla = new Fallas();
	$vehiculo = new Vehiculos();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$idFalla = isset($_POST["idFalla"]);
   $nombre = isset($_POST["descripcion"]);

   	switch ($_GET["op"]) {
   		case 'guardaryeditar':

        
			
			if(empty($_POST["idFalla"])){
			
				

				$falla->registrar_falla($_POST["descripcion"],$_POST["idVehiculo"],);
				echo "se registro";
				
				
			}else{

				$falla->editar_falla($idFalla, $nombre);
				echo "se edito";
			}
           
     	break;

   		case 'selectVehiculo':
   			
			$rspta= $vehiculo->get_vehiculo();
			echo '<option value="0">Ingrese la placa </option>';
			foreach ($rspta as $reg) {
			  echo '<option class="font-weight-bold" value='. $reg["placa"] .'>'. $reg["placa"] . '</option>';
			}

   		break;

   		case 'listar':

   			$datos = $falla->get_fallas();
			$data = array();
			foreach ($datos as $row) {
				$sub_array = array();
				$sub_array[]=$row["id"];
				$sub_array[]=$row["descripcion"];
				$sub_array[]=$row["fechaHora"];
				$sub_array[]=$row["status"];
				$sub_array[]=$row["idVehiculo"];
				$sub_array[] = '<button type="button" onClick="editar_falla('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-warning btn-md" title="Editar Falla"><i class="fas fa-edit"></i></button>';
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
		case 'mostrarPorVehiculo':

			$datos = $falla->get_fallasPorVehiculo($_POST["idVehiculo"]);
		 $data = array();
		 foreach ($datos as $row) {
			$output["vehiculo_placa"]=$row["vehiculo_placa"];
			$output["descripcion"]=$row["descripcion"];
			$output["fecha"]=$row["fecha"];
			$output["estatus"]=$row["estatus"];
			}
			echo json_encode($output);
		 $results=array(
			 "sEcho"=>1,
			 "iTotalRecords"=>count($data),
			 "iTotalDisplayRecords"=>count($data),
			 "aaData"=>$data
			 );

		 echo json_encode($results);
		break;
		case 'mostrarVehiculo':
		$datos = $vehiculo->get_vehiculo_por_id($_POST["placa"]);
		if(is_array($datos)==true and count($datos)>0){
			foreach ($datos as $row){
			$output["nombreCli"]=$row["nombreCli"];
			$output["modelo_nom"]=$row["modelo_nom"];
			$output["color_nom"]=$row["idModelo"];
			}
			echo json_encode($output);
		}else{
			$errors[]="El vehiculo no existe";
		}
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