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
    
    case 'selectGen':

      $rspta=$modelo->generacion_por_modelo();
      echo '<option value="0" selected disabled>Seleccione Color</option>';
      foreach ($rspta as $regis) {       
          echo '<option class="font-weight-bold" value='. $regis->idColor .'>'. $regis->nombre . '</option>';
        
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
        foreach ($datos as $row){
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
    break;
    
    case 'comboCliente':
      $datos = $cliente->get_cliente_por_id($_POST["cedula"]);
      if(is_array($datos)==true and count($datos)>0){
        foreach ($datos as $row) {
          $output["nombre"] = $row["nombre"];
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
        if($row["fin_gen"]==1){
          $sub_array[]=$row["iniannos"];
        }else{
          $sub_array[]=$row["iniannos"]." - ".$row["finannos"];
        }
        $sub_array[] = '<button type="button" onClick="mostrar('.$row["idModelo"].','.$row["iniannos"].');"  id="'.$row["idModelo"].'" class="btn btn-warning btn-md update" title="Editar Modelo"><i class="fas fa-edit"></i></button>';
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
    break;
  }

?>