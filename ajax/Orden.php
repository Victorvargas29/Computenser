 <?php
  //llamo a la conexion de la base de datos 
  require_once("../config/conexion.php");

  //llamo al modelo Venta
  require_once("../modelos/Clientes.php");
  require_once("../modelos/Ordenes.php");
  require_once("../modelos/Servicios.php");

	
	$cliente = new Clientes();
	$ordenes = new Ordenes();
  $servicio = new Servicio();
  $cedula = isset($_POST["cedula"]);
	$idFactura = isset($_POST["idFactura"]);
	$idServicio = isset($_POST["idServicio"]);
	$precio = isset($_POST["precio"]);
	$nombre_ser = isset($_POST["nombre_ser"]);
  $descripcion = isset($_POST["descripcion"]);
	$placa = isset($_POST["placa"]);
	$oentrega = isset($_POST["oentrega"]);
  $comboCedula = isset($_POST["comboCedula"]);

  $precioBs=0;
  $iva=0;
  $ivaBs=0;
  $precioT=0;
  $precioTBs=0;
  $precioTBs=0;
  switch($_GET["op"]){
	  case "agregar_detalle":

      if($_POST["idServicio"] != 0){

        $venta->agregar_detalle($idFactura,$idServicio,$nombre_ser,$precio,$tasa,$descripcion,$cantidad,$idUsuario);

      }else {
        echo "debe selecionar un servicio";
      }
     

    break;

    case "max":
      $ordenMax = $ordenes->Max();
          $orden = $ordenMax["numDoc"];
          //$output["idFactura"]= $fact+1;
          echo $orden+1;
      
    break;

    case 'selectCliente':
      $rspta = $cliente->get_cliente2();
      echo '<option value="" selected disabled>Seleccione cliente</option>';
      foreach($rspta as $regist){
        echo '<option class="font-weight-bold" value='.$regist->cedula.'>'.$regist->cedula.' - '.$regist->nombre.' '.$regist->apellido.'</option>';
      }
  
    break;
    case 'selectVehiculo':
      $cedula=$_POST['cedula'];
			$rspt= $ordenes->get_vehiculo($cedula);
			echo '<option value=""  selected disabled>Ingrese la placa </option>';
			foreach ($rspt as $reg) {
			  echo '<option class="font-weight-bold" value='. $reg["placa"] .'>'. $reg["placa"] . '</option>';
			}

   		break;
      case 'selectOrden':
        $idVehiculo=$_POST['idVehiculo'];
        $rspt= $ordenes->get_ordenVehiculo($idVehiculo);
        
        //$rspt= $ordenes->get_sumaPrecioDetalle($reg["numDoc"]);
        echo '<option value=""  selected disabled>Ingrese la Orden </option>';
        foreach ($rspt as $reg) {
          $suma= $ordenes->get_sumaPrecioDetalle($reg["numDoc"]);
          echo '<option class="font-weight-bold" value='. $reg["numDoc"] .'>'.'N° de orden: 000'.$reg["numDoc"].' ---  Fecha: ' . $reg["fecha"]. ' --- ' .'Total: '.number_format($suma["precio"],2).'$$'. '</option>';
        }
      break;
      case 'sumarTotal':
        
          $idOrden=$_POST['idOrden'];
          $suma= $ordenes->get_sumaPrecioDetalle($idOrden);
          echo number_format($suma["precio"],2);

      break;

      case 'mostrarDetalles':
        $idOrden=$_POST['idOrden'];
        $tasa=$_POST['tasa'];
        $datos= $ordenes->mostrarDetalles($idOrden);
        foreach ($datos as $row) {
          $sub_array = array();
          $sub_array[] = $row["nombre"]." - ".$row["descripcion"];
          $sub_array[] = number_format($row["precio"],2);
          //$sub_array[] = $row["precio"];
          $sub_array[] = number_format(+$row["precio"] * +$tasa,2);
         // $sub_array[] = '<button type="button" onClick="eliminar_detalle('.$row["idModelo"].');"  id="'.$row["idModelo"].'" class="btn btn-danger btn-md" title="Eliminar Modelo"><i class="fas fa-trash-alt"></i></button>';
          
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
       
    case "listar":
      $datos = $venta->detalles_venta($idUsuario);
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();

        $sub_array[] = '<button title="Eliminar" type="button" onClick="eliminar_item('.$row["iddetallesFT"].');"  id="'.$row["iddetallesFT"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
        $sub_array[] = $row["nombre_serv"]." - ".$row["descripcion"];
        $sub_array[] = $row["precioTemp"];
        $sub_array[] = number_format($row["precioTemp"] * $row["tasa"],2);
        // $sub_array[] = $row["precioTemp"] * $row["tasa"] * 0.16; 
        $sub_array[] = $row["cantidad"];
        $sub_array[] = number_format($row["precioTemp"] * $row["tasa"] * $row["cantidad"],2);
        $sub_array[] = number_format($row["precioTemp"] * $row["cantidad"],2);
        
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

    case "listarSubtotales":
      $datos = $venta->detalles_venta($idUsuario);
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();
       
        $precio= ($row["precioTemp"]*$row["cantidad"])+$precio;
        $precioBs = ($row["precioTemp"] * $row["tasa"]*$row["cantidad"])+$precioBs;
        $ivaBs = ($row["precioTemp"] * $row["tasa"]*$row["cantidad"] * 0.16)+$ivaBs; 
        $iva = ($row["precioTemp"] *$row["cantidad"] * 0.16)+$iva; 
        $precioTBs = ($row["precioTemp"] * $row["tasa"] * $row["cantidad"]*1.16)+$precioTBs;
        $precioT = ($row["precioTemp"] * $row["cantidad"]*1.16)+$precioT;
        
      }
    //   $sub_array[] = $precio;
      $sub_array[] = number_format($precioBs,2);
    //   $sub_array[] = $iva;
      $sub_array[] = number_format($ivaBs,2);
    //   $sub_array[] = $precioT;
      $sub_array[] = number_format($precioTBs,2);
      
      $data[]=$sub_array;

      
        $results=array(
          "sEcho"=>1,
          "iTotalRecords"=>count($data),
          "iTotalDisplayRecords"=>count($data),
          "aaData"=>$data
          );
        echo json_encode($results);
    break;

    case 'mostrar':

      $facturaMax = $venta->Max();
      $temporalMax = $venta->datos_en_temporal();
      $TemporalUsuario = $venta->datos_en_temporal_idUsuario($idUsuario);
 
      if(is_array($temporalMax)==true and count($temporalMax)>0){

        if(is_array($TemporalUsuario)==true and count($TemporalUsuario)>0){
          foreach ($TemporalUsuario as $row) {

            //	$output["idDepartamento"] = $row["idDepartamento"];
              $output["idFactura"] = $row["idFactura"];
            }
            echo json_encode($output);
        }else{

            foreach ($temporalMax as $row) {
            //	$output["idDepartamento"] = $row["idDepartamento"];
             $temp= $row["idFactura"];
            }
            foreach ($facturaMax as $facturaMaxima) {
              //	$output["idDepartamento"] = $row["idDepartamento"];
                $fact = $facturaMaxima["idFactura"];
            }
              if ($fact>$temp) {
                foreach ($facturaMax as $row) {
                  //	$output["idDepartamento"] = $row["idDepartamento"];
                  $output["idFactura"]= $row["idFactura"]+1;
                  }

              }
              else{
                foreach ($temporalMax as $row) {
                  //	$output["idDepartamento"] = $row["idDepartamento"];
                  $output["idFactura"]= $row["idFactura"]+1;
                  }

              }
            echo json_encode($output);
        }
      }else{

          if(is_array($facturaMax)==true and count($facturaMax)>0){
            foreach ($facturaMax as $row) {
            //	$output["idDepartamento"] = $row["idDepartamento"];
              $output["idFactura"] = $row["idFactura"]+1;
            }
            echo json_encode($output);
        }else{
          $errors[]="El Servicio no existe";
        }
      }

      

      break;

    case "eliminar_item":
      $venta->eliminar_item($_POST["iddetallesFT"]);   
    break;
    
    case 'guardarOrden':
            
    
            $placa= $ordenes->registrar($_POST["idVehiculo"]);
            //echo "viendo la placa del vehiculo " , $placa;
           
            
            
            
    
    break;
    
    case 'detallesEmpleada':
            
      $jsomEmpleada=$_POST["arregloEmpleada"];
    
      
       $res=$ordenes->detallesEmpleada($jsomEmpleada);
       echo "jsom de prueba de Empleada", $res;
      
      // $venta->eliminar_temp_condicion($idUsuario);
      
      

    break;
    case 'detallesDetalles':
            
      $jsomdetalles=$_POST["arregloDetalle"];
   
      
       $res=$ordenes->detallesDetalles($jsomdetalles);
       echo $res;
      
      // $venta->eliminar_temp_condicion($idUsuario);
      
      

    break;
    case "listarordenes":
      
      $datos = $ordenes->orden();
      $data = array();
      foreach ($datos as $row) {
        $sub_array=array();
        $sub_array[] = $row["numDoc"];
        $date = new DateTime($row["fecha"]);
        $sub_array[] =$date->format('d-m-Y - h:i a');
        $sub_array[] = $row["fechaM"];
        $sub_array[] = $row["cedula"];
        $sub_array[] = $row["placa"];

        $atrib_icono="";
        $tip = "";
        $titulo2="Cancelar";
        $atrib_clases = "";
        $disable="";

        if($row["estatus"]==0){
          $tip = "¿Cancelar orden?";
          $atrib_clases = "btn btn-danger btn-md estado";
          $estado="Sin procesar";
        }else if($row["estatus"]==1){
          $tip = "Esta orden se facturó";
         // $titulo2="Facturada";
         $disable='disabled="disabled"';
          $atrib_clases = "btn btn-success disabled btn-md estado";
          $estado="Facturada";
        }else{
          $disable='disabled="disabled"';
          $atrib_clases = "btn btn-success disabled btn-md estado";
          $tip = "Esta orden se cancelo";
          //$titulo2="Orden Cancelada";
          $estado="Cancelada";
        }
        
        $sub_array[] = $estado;
        $sub_array[] = '<button title="Ver" type="button" onClick=mostrarOrden('.$row["numDoc"].') id="" class="btn btn-success btn-md"><i class="fas fa-eye" aria-hidden="true"></i></button>';  
        $sub_array[] = '<button '.$disable.' title="'.$tip.'" type="button" onClick="cancelar('.$row["numDoc"].')"  id="'.$row["numDoc"].'" class="'.$atrib_clases.'"><i class="'.$atrib_icono.'" aria-hidden="true"></i>'.$titulo2.'</button>';
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

      case "cambiarEstado":
  
            $rr=$ordenes->cambiarEstado($_POST["idOrden"]);
            echo $rr;
      break;
      
      case "cancelar":
  
        $rr=$ordenes->cancelar($_POST["numDoc"]);
      break;
}