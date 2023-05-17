<?php 

//require_once("../config/conexion.php");

require_once("../modelos/Servicios.php");


	$servicio = new Servicio();
  


	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
  $idServicio = isset($_POST["idServicio"]);
  $nombre = isset($_POST["nombre"]);  //nombre servicio
  $precio = isset($_POST["precio"]);

  

   

   	switch ($_GET["op"]) {

      

      case 'selectServicio':
       
        $rspta=$servicio->get_servicio2();
        echo '<option value="" selected disabled>Seleccione el Servicio</option>';
        foreach($rspta as $regi){
          echo '<option class="font-weight-bold" value='.$regi->codeServicio.'>'.$regi->nombre.'</option>';
        }

      break;


   		case 'guardaryeditar':
  
        if(empty($_POST["idServicio"])){
          $datos = $servicio->get_servicio_por_id($_POST["idServicio"]);
          $datosNombre = $servicio->get_servicio_por_nombre($_POST["nombre"]);
            if(is_array($datos)==true and count($datos)==0){
              if(is_array($datosNombre)==true and count($datosNombre)==0){
                $servicio->registrar_servicio($_POST["nombre"],$_POST["precio"]);
                echo "se registro";
              }else{
                echo "el producto ya existe";
              }
            } 
        }else{

            $servicio->editar_servicio($idServicio,$nombre,$precio);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $servicio->get_servicio_por_id($_POST["idServicio"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {

   				  $output["nombre"] = $row["nombre"];
            $output["precio"]=$row["Precio"];
            	

   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Servicio no existe";
   			}

   			break;

   		case 'listar':

   			$datos = $servicio->get_servicio();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["codeServicio"];
   					$sub_array[]=$row["nombre"];
            $sub_array[]=$row["precio"];
            
            

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["codeServicio"].');"  id="'.$row["codeServicio"].'" class="btn btn-warning btn-md update" title="Editar servicio"><i class="fas fa-edit"></i></button>';


            			$sub_array[] = '<button type="button" onClick="eliminar_servicio('.$row["codeServicio"].');"  id="'.$row["codeServicio"].'" class="btn btn-danger btn-md" title="Eliminar servicio"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_servicio":

            $datos = $servicio->get_servicio_por_id($_POST["idServicio"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $servicio->eliminar_servicio($_POST["idServicio"]);
                  $messages[]="se elimino correctamente";
            }

   		    break;
   	}

 ?>