<?php 

//require_once("../config/conexion.php");

require_once("../modelos/Servicios.php");
require_once("../modelos/Departamentos.php");
require_once("../modelos/Categorias.php");
	$servicio = new Servicio();
  $depar = new Departamentos();
  $cate = new Categoria();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
  $idServicio = isset($_POST["idServicio"]);
  $nombre = isset($_POST["nombre"]);  //nombre servicio
  $precio = isset($_POST["precio"]);
  $idCategoria = isset($_POST["idCategoria"]);
  $idDepartamento = isset($_POST["iddepartamento"]);

   

   	switch ($_GET["op"]) {

      case 'selectDepartamento':
        $rspta=$depar->get_departamento_2();
        echo '<option value="0" selected disabled>Seleccione departamento </option>';
        foreach ($rspta as $reg) {
          echo '<option class="font-weight-bold" value='. $reg->idDepartamento .'>'. $reg->nombre . '</option>';
        }
      break;

      case 'selectCategoria':
        $iddepartamento=$_POST['iddepartamento'];
        $rspta=$cate->categoria_por_departamento($iddepartamento);
        echo '<option value="0" selected disabled>Seleccione categoria</option>';
        foreach($rspta as $regi){
          echo '<option class="font-weight-bold" value='.$regi->idCategoria.'>'.$regi->nombre.'</option>';
        }

      break;


   		case 'guardaryeditar':
  
        if(empty($_POST["idServicio"])){
          $datos = $servicio->get_servicio_por_id($_POST["idServicio"]);
          $datosNombre = $servicio->get_servicio_por_nombre($_POST["nombre"]);
            if(is_array($datos)==true and count($datos)==0){
              if(is_array($datosNombre)==true and count($datosNombre)==0){
                $servicio->registrar_servicio($_POST["nombre"],$_POST["precio"],$_POST["idDepartamentos"]);
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
   				//	$output["idDepartamento"] = $row["idDepartamento"];
   				  $output["nombre"] = $row["Nombre"];
            	$output["precio"]=$row["Precio"];
            	$output["idDepartamento"]=$row["idDepartamento"];

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

   					$sub_array[]=$row["idServicio"];
   					$sub_array[]=$row["nombre"];
            $sub_array[]=$row["precio"];
            
            $sub_array[]=$row["depa_nombre"];

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idServicio"].');"  id="'.$row["idServicio"].'" class="btn btn-warning btn-md update" title="Editar servicio"><i class="fas fa-edit"></i></button>';


            			$sub_array[] = '<button type="button" onClick="eliminar_servicio('.$row["idServicio"].');"  id="'.$row["idServicio"].'" class="btn btn-danger btn-md" title="Eliminar servicio"><i class="fas fa-trash-alt"></i></button>';

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