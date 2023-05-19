<?php 

require_once("../modelos/Modelo.php");
require_once("../modelos/Marca.php");
header('Content-Type: text/html; charset=UTF-8');
	$modelo = new Modelos();
  $marca = new Marcas();

  $idModelo = isset($_POST["idModelo"]);
  $Modelo = isset($_POST["Modelo"]);

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
       // $rspta=$modelo->get_años();
        echo '<option value="0" selected disabled>año inicio</option>';
        /* ($rspta as $regi) {
            if($regi->id>1){
              echo '<option class="font-weight-bold" value='. $regi->id .'>'. $regi->annos . '</option>';
            }
        }*/
        $j=1970;
        for ($i=0; $i < 54; $i++) { 
          //$j+$i;
          echo '<option class="font-weight-bold" value='.($j+$i).'>'.($j+$i). '</option>';
        }
      break;
	  case 'selectFinGen':
      $id_ini=$_POST["idInicio"];
        echo '<option value="0" selected disabled>años</option>';
        $j=1970;
        for ($i=0; $i < 54; $i++) { 
          if($i+$j>$id_ini){
            echo '<option class="font-weight-bold" value='.($j+$i).'>'.($j+$i). '</option>';
          }
          //$j+$i;
         
        }
      
      break;

   		case 'guardaryeditar':
 
        if(empty($_POST["idModelo"])){
          $datos = $modelo->get_modelo_por_id($_POST["idModelo"]);
            if(is_array($datos)==true and count($datos)==0){

               $modelo->registrar_modelo($nombre, $idMarca);
               echo "se registro";
               
            }else{

              echo "el producto ya existe";
              
            }
        }else{

            $modelo->editar_modelo($idModelo,$nombre,$idMarca);
            echo "se edito";
        }
           
      break;

      case 'reg_generacion':
 
        if(!empty($_POST["Modelo"])){
               echo "Registro -";
               //echo $Modelo;
               $res= $modelo->reg_generacion($_POST["Modelo"],$_POST["idInicio"],$_POST["idFin"]);
               
        }else{

          echo $_POST["Modelo"];

        }
           
      break;

      
   		case 'generacion':
   

        $datos = $modelo->get_modelo_por_id($_POST["idModelo"]);
   			
       
          foreach ($datos as $row) {
            $output["nombreM"]=$row["nombre"];
            $output["Modelo"]=$row["idModelo"];
           
          }
          echo json_encode($output);
       

   			break;
   			

        break;

   		case 'mostrar':
   			
   			$datos = $modelo->get_modelo_por_id($_POST["idModelo"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   					$output["nombre"] = $row["nombre"];
            $output["idModelo"]=$row["idModelo"];
            $output["idMarca"]=$row["idMarca"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Modelo no existe";
   			}

   			break;

   		case 'listar':

   			$datos = $modelo->get_modelo();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idModelo"];
   					$sub_array[]=$row["nombre"];
            $sub_array[]=$row["marca_nom"];
  /*           if($row["fin_gen"]==1){
              $sub_array[]=$row["iniannos"];
            }else{
              $sub_array[]=$row["iniannos"]." - ".$row["finannos"];
            } */


   					$sub_array[] = '<button type="button" onClick="mostrar('.$row["idModelo"].');"  id="'.$row["idModelo"].'" class="btn btn-info btn-md update" title="Editar Modelo"><i class="fas fa-edit"></i></button>';

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