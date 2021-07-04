<?php 

//require_once("../config/conexion.php");

require_once("../modelos/Inventario.php");

	$inventario = new Inventario();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
  $idInventario = isset($_POST["idInventario"]);
  $cantidad = isset($_POST["cantidad"]);  
  $cantidadN = isset($_POST["cantidadN"]); 
  $idProducto = isset($_POST["idProducto"]);

$Invent = isset($_POST["invent"]);
   

   	switch ($_GET["op"]) {



      case 'ver_detalle':

        //   echo "el detalle existe";
        $datos = $inventario->get_inventarioDetalles($_POST["invent"]);

      break;

      case 'ver_datos_inventario':

        
        // $datos = $inventario->get_detalles_inventario($_POST["idInventario"]);
        $datos = $inventario->get_detalles_inventario($_POST["invent"]);
  
        if(is_array($datos)==true and count($datos)>0){
        //   echo "el inventario existe";
          foreach ($datos as $row) {

            $output["invent"] = $row["idInventario"];
            $output["nombreP"] = $row["nombreP"]." ".$row["cantidadP"]." ".$row["presentacion"];
            $output["cantidad2"] = $row["cantidad2"];  
          }
 
          echo json_encode($output);
        } else {
            //si no existe el registro entonces no recorre el array
            echo "no existe";

      }
      break;

   		case 'guardaryeditar':

        
        if(empty($_POST["idInventario"])){
			
          $datos = $inventario->get_inventario_por_id($_POST["idInventario"]);
            if(is_array($datos)==true and count($datos)==0){

			   $inventario->registrar_inventario($cantidad,$idProducto);
			   $inventario->registrar_inventarioDetalles($cantidad,$cantidadN,$idInventario);
               echo "se registro";
        
               
            }else{

              echo "el producto ya existe";
              
            }
        }else{

            $inventario->editar_inventario($idInventario,$cantidad,$idProducto);
			$inventario->registrar_inventarioDetalles($cantidad,$cantidadN,$idInventario);
			echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $inventario->get_inventario_por_id($_POST["idInventario"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idDepartamento"] = $row["idDepartamento"];
   				$output["cantidad2"] = $row["cantidad2"];
            	$output["idProducto"]=$row["idProducto"];

   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Servicio no existe";
   			}

   			break;

   		case 'listar':

   			$datos = $inventario->get_inventario();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idInventario"];
   					
					$sub_array[]=$row["nombreP"]." ".$row["cantidadP"].$row["nombrePP"];
                    $sub_array[]=$row["cantidad"];

              $sub_array[] =  '<button class="btn btn-primary detalle"  id="'.$row["idInventario"].'"  data-toggle="modal" data-target="#Modal_detalle" title="ver detalle"><i class="fa fa-eye"></i></button>';
			/*		
          $sub_array[] = '<button id="'.$row["idInventario"].'" data-toggle="modal" data-target="#Modal_detalle" class="btn btn-warning detalle"><i class="fas fa-edit"></i> Ver </button>';*/
   				
          	$sub_array[] = '<button type="button" onClick="mostrar('.$row["idInventario"].');"  id="'.$row["idInventario"].'" class="btn btn-warning btn-md update" title="Incluir"><i class="fas fa-edit"></i></button>';

	    			$sub_array[] = '<button type="button" onClick="eliminar_inventario('.$row["idInventario"].');"  id="'.$row["idInventario"].'" class="btn btn-danger btn-md" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';

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
			


            case "eliminar_inventario":

            $datos = $inventario->get_inventario_por_id($_POST["idInventario"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $inventario->eliminar_inventario($_POST["idInventario"]);
                  $messages[]="se elimino correctamente";
            }

   		    break;
   	}

 ?>
