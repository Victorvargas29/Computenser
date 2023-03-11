<?php 

//require_once("../config/conexion.php");

require_once("../modelos/Modelo.php");
require_once("../modelos/Marca.php");

	$modelo = new Modelos();
  $marca = new Marcas();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
  $idModelo = isset($_POST["idModelo"]);
  $nombre = isset($_POST["nombre"]);  
	$idMarca = isset($_POST["idMarca"]);
   $id_ini=isset($_POST["idInicio"]);
   $id_fin=isset($_POST["idFin"]);

   	switch ($_GET["op"]) {

      case 'selectMarca':
        $rspta=$marca->get_marca_2();
        echo '<option value="0" selected disabled>Seleccione Marca </option>';
        foreach ($rspta as $reg) {
          echo '<option class="font-weight-bold" value='. $reg->idMarca .'>'. $reg->nombre . '</option>';
        }
      break;
	  case 'selectIniGen':
        $rspta=$modelo->get_años();
        echo '<option value="0" selected disabled>año inicio</option>';
        foreach ($rspta as $regi) {
          echo '<option class="font-weight-bold" value='. $regi->id .'>'. $regi->annos . '</option>';
        }
      break;
	  case 'selectFinGen':
        $rspta=$modelo->get_años();
        echo '<option value="0" selected disabled>años</option>';
        foreach ($rspta as $regis) {
          echo '<option class="font-weight-bold" value='. $regis->id .'>'. $regis->annos . '</option>';
        }
      break;

   		case 'guardaryeditar':
 
        if(empty($_POST["idModelo"])){
          $datos = $modelo->get_modelo_por_id($_POST["idModelo"]);
            if(is_array($datos)==true and count($datos)==0){

               $modelo->registrar_modelo($nombre, $idMarca,$id_ini,$id_fin);
               echo "se registro";
               
            }else{

              echo "el producto ya existe";
              
            }
        }else{

            $modelo->editar_modelo($idModelo,$nombre,$idMarca,$id_ini,$id_fin);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $modelo->get_modelo_por_id($_POST["idModelo"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   					$output["nombre"] = $row["nombre"];
            $output["idModelo"]=$row["idModelo"];
            $output["idMarca"]=$row["idMarca"];
            $output["idInicio"]=$row["inicio_gen"];
            $output["idFin"]=$row["fin_gen"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Modelo no existe";
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

   			$datos = $modelo->get_modelo();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idModelo"];
   					$sub_array[]=$row["nombre"];
            $sub_array[]=$row["marca_nom"];
            $sub_array[]=$row["iniannos"]." - ".$row["finannos"];
   					$sub_array[] = '<button type="button" onClick="mostrar('.$row["idModelo"].');"  id="'.$row["idModelo"].'" class="btn btn-warning btn-md update" title="Editar Modelo"><i class="fas fa-edit"></i></button>';

            $sub_array[] = '<button type="button" onClick="eliminar_modelo('.$row["idModelo"].');"  id="'.$row["idModelo"].'" class="btn btn-danger btn-md" title="Eliminar Modelo"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_modelo":

            $datos = $modelo->get_modelo_por_id($_POST["idModelo"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $modelo->eliminar_modelo($_POST["idModelo"]);
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