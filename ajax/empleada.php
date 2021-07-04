<?php 

require_once("../config/conexion.php");

require_once("../modelos/Empleadas.php");

	$empleada = new Empleadas();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$nombre = isset($_POST["nombre"]);
   $apellido=isset($_POST["apellido"]);
   $cedula=isset($_POST["cedula"]);
  	$telefono=isset($_POST["telefono"]);
  // $email=isset($_POST["email"]);
   $direccion=isset($_POST["direccion"]);
   $idEmpleada=isset($_POST["idEmpleada"]);
   $idDepartamento=isset($_POST["idDepartamento"]);


   	switch ($_GET["op"]) {
   		case 'guardaryeditar':
   		//	$datos = $empleada->get_cedula_correo_de_la_empleada($_POST["cedula"],$_POST["email"]);
   		$datos = $empleada->get_empleada_por_id($_POST["cedula"]);
   		if(is_array($datos)==true and count($datos)==0){
//
   					$empleada->registrar_empleada($cedula, $nombre, $apellido, $telefono, $direccion, $idDepartamento);

   					echo "Se ha registrado correctamente una nueva empleada";

   			}else{

   				$empleada->editar_empleada($cedula, $nombre, $apellido, $telefono, $direccion);
   				echo "Se ha editado correctamente los datos de la empleada";
   			}

   			break;

   		case 'mostrar':
   			
   			$datos = $empleada->get_empleada_por_id($_POST["cedula"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   					$output["cedula"] = $row["cedula"];
   					$output["nombre"] = $row["nombre"];
   					$output["apellido"] = $row["apellido"];
   					$output["telefono"] = $row["telefono"];
   					$output["direccion"] = $row["direccion"];
   					$output["idDepartamento"] = $row["idDepartamento"];
					$output["nom"] = $row["nom"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El usuario no existe";
   			}

   			break;

   		case 'listar':

   			$datos = $empleada->get_empleada();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["cedula"];
   					$sub_array[]=$row["nombre"];
   					$sub_array[]=$row["apellido"];
                 
   					$sub_array[]=$row["telefono"];
   					$sub_array[]=$row["direccion"];
   				//	$sub_array[]=$row["email"];
   					$sub_array[]=date("d-m-Y",strtotime($row["fecha_ingreso"]));
                  $sub_array[]=$row["depa_nombre"];
   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["cedula"].');"  id="'.$row["cedula"].'" class="btn btn-warning btn-md update"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_empleada('.$row["cedula"].');"  id="'.$row["cedula"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_empleada":

            $datos = $empleada->get_empleada_por_id($_POST["cedula"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $empleada->eliminar_empleada($_POST["cedula"]);
                  $messages[]="se elimino correctamente";
            }

			   break;

			case "Cargarlist":

			$datos = $empleada->get_empleada_por_id($_POST["cedula"]);
			echo json_encode($output);
			
			   

   	}

 ?>