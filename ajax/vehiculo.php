<?php 

require_once("../modelos/Vehiculos.php");
require_once("../modelos/Clientes.php");
require_once("../modelos/Marca.php");
require_once("../modelos/Modelo.php");
require_once("../modelos/Color.php");

	$vehiculo = new Vehiculos();
  $cliente = new Clientes();
  $marca = new Marcas();
  $modelo = new Modelos();
  $color = new Colors();
 
  $cedula = isset($_POST["cedula"]); 
  $placa = isset($_POST["placa"]);  
  $idMarca = isset($_POST["idMarca"]);  
  $idModelo = isset($_POST["idModelo"]);   
  $idColor = isset($_POST["idColor"]);
  $año = isset($_POST["año"]);


  switch ($_GET["op"]) {

    case 'selectMarca':
      $rspta=$marca->get_marca_2();
      echo '<option value="0" selected disabled>Seleccione Marca </option>';
      foreach ($rspta as $reg) {
        echo '<option class="font-weight-bold" value='. $reg->idMarca .'>'. $reg->nombre . '</option>';
      }
    break;

	  case 'selectModelo':
      $idMarca = $_POST["idMarca"];
      $rspta=$modelo->modelo_por_marca($idMarca);
      echo '<option value="0" selected disabled>Seleccione Modelo</option>';
      foreach ($rspta as $regi) {
        echo '<option class="font-weight-bold" value='. $regi->idModelo .'>'. $regi->nombre . '</option>';   
      }
    break;
    
	  case 'selectColor':

      $rspta=$color->get_color_2();
      echo '<option value="0" selected disabled>Seleccione Color</option>';
      foreach ($rspta as $regis) {       
          echo '<option class="font-weight-bold" value='. $regis->idColor .'>'. $regis->nombre . '</option>';
        
      }
    break;

   

    case 'selectCliente':
      $rspta = $cliente->get_cliente2();
      echo '<option value="0" selected disabled>Seleccione cliente</option>';
      foreach($rspta as $regist){
        echo '<option class="font-weight-bold" value='.$regist->cedula.'>'.$regist->cedula.' - '.$regist->nombre.'</option>';
      }
  
    break;

   	case 'guardaryeditar':
    
        $datos = $vehiculo->get_vehiculo_por_id($_POST["placa"]);
          if(is_array($datos)==true and count($datos)==0){
            $vehiculo->registrar_vehiculo($_POST["placa"],$_POST["cedula"],$_POST["idColor"],$_POST["año"],$_POST["idModelo"]);
            echo "se registro";
            echo $_POST["cedula"];   
          }else{
            echo "el vehiculo ya existe";
            $vehiculo->editar_vehiculo($_POST["placa"],$_POST["cedula"],$_POST["idColor"],$_POST["año"],$_POST["idModelo"]);
            echo "se edito"; 
          }
           
    break;

    case 'mostrar':
      $datos = $vehiculo->get_vehiculo_por_id($_POST["placa"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach ($datos as $row){
          $output["cedula"]=$row["cedula"];
          $output["placa"]=$row["placa"];
          $output["nombre"]=$row["nombreCli"];
          $output["idMarca"]=$row["idMarca"];
          $output["idModelo"]=$row["idModelo"];
          $output["anno"]=$row["anno"];
          $output["idColor"]=$row["idColor"];
        }
        echo json_encode($output);
      }else{
        $errors[]="El vehiculo no existe";
      }
    break;
   
    
    case 'comboCliente':
      $datos = $cliente->get_cliente_por_id($_POST["cedula"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach ($datos as $row) {
          $output["nombre"] = $row["nombre"];
        }
        echo json_encode($output);
      }else{
        $errors[]="El cliente no existe";
      }
    break;

    case 'listar':
      $datos = $vehiculo->get_vehiculo();
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();
        $sub_array[]=$row["cedula"];
        $sub_array[]=$row["marca_nom"]." - ".$row["modelo_nom"];
        $sub_array[]=$row["placa"];
        $sub_array[]=$row["color_nom"];
        $sub_array[]=$row["anno"];
        $sub_array[] = '<button type="button" onClick="mostrar('."'".$row["placa"]."'".','.$row["idMarca"].','.$row["idModelo"].');"  id="'.$row["placa"].'" class="btn btn-warning btn-md update" title="Editar Vehiculo"><i class="fas fa-edit"></i></button>';
        $sub_array[] = '<button type="button" onClick="eliminar_vehiculo('."'".$row["placa"]."'".');"  id="'.$row["placa"].'" class="btn btn-danger btn-md" title="Eliminar Vehiculo"><i class="fas fa-trash-alt"></i></button>';
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

    case "eliminar_vehiculo":
      $datos = $vehiculo->get_vehiculo_por_id($_POST["placa"]);
      if (is_array($datos)==true and count($datos)>0) {
        $vehiculo->eliminar_vehiculo($_POST["placa"]);
        echo "se elimino correctamente";
      }else {
        echo "no se elimino el vehiculo";
      }
    break;
  }

?>