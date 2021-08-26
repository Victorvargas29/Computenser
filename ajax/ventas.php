 <?php
  //llamo a la conexion de la base de datos 
  require_once("../config/conexion.php");

  //llamo al modelo Venta
  require_once("../modelos/ventas.php");
  require_once("../modelos/Servicios.php");

	$venta = new Ventas();
  $servicio = new Servicio();
  $cedula = isset($_POST["cedula"]);
	$idFactura = isset($_POST["idFactura"]);
	$idServicio = isset($_POST["idServicio"]);
	$precio = isset($_POST["precio"]);
	$nombre_ser = isset($_POST["nombre_ser"]);

  $moneda = isset($_POST["moneda"]);

  $NroFactura = isset($_POST["NroFactura"]);
  //$idUsuario = isset($_POST["idUser"]);
	$idUsuario = $_SESSION["idUsuario"];
  $tasa = isset($_POST["tasa"]);
  $cantidad = isset($_POST["cantidad"]);
  $precio=0;
  $precioBs=0;
  $iva=0;
  $ivaBs=0;
  $precioT=0;
  $precioTBs=0;
  $precioTBs=0;
  switch($_GET["op"]){
	  case "agregar_detalle":

      if($_POST["idServicio"] != 0){

        $venta->agregar_detalle($idFactura,$idServicio,$nombre_ser,$precio,$tasa,$cantidad,$idUsuario);

      }else {
        echo "debe selecionar un servicio";
      }
     

    break;

    case "listar":
      $datos = $venta->detalles_venta($idUsuario);
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();

        $sub_array[] = '<button title="Eliminar" type="button" onClick="eliminar_item('.$row["iddetallesFT"].');"  id="'.$row["iddetallesFT"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
        $sub_array[] = $row["nombre_serv"];
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
    
    case 'guardarVenta':
      
             $venta->registrar($idFactura,$cedula);
             $venta->detallesDetalles($idUsuario);
             sleep(2);
             $venta->eliminar_temp_condicion($idUsuario);
            
             echo "se registro";
    
    break;
    case "borrar_temp":
      $venta->eliminar_temp_condicion($idUsuario);
    break;

    case "listarfacturas":
      
      $datos = $venta->get_facturas();
      $data = array();
      foreach ($datos as $row) {
        if ($row["idFactura"]>1) {
          $sub_array = array();

       
        $sub_array[] = '<span>'.$row["idFactura"].'</span> ';
        $sub_array[] = $row["nombre"];
        $sub_array[] = $row["cedula"];  //onClick=mostrarFactura('.$row["idFactura"].','.$moneda.')
        $sub_array[] = '<button title="Ver" type="button" onClick=mostrarFactura('.$row["idFactura"].') id="" class="btn btn-success btn-md"><i class="fas fa-eye" aria-hidden="true"></i></button>';
        $sub_array[] = '<button title="Anular" type="button" onClick=""  id="'.$row["idFactura"].'" class="btn btn-warning btn-md"><i class="fas fa-minus" aria-hidden="true"></i></button>';
        
        $data[]=$sub_array;
        }
        
      }
        $results=array(
          "sEcho"=>1,
          "iTotalRecords"=>count($data),
          "iTotalDisplayRecords"=>count($data),
          "aaData"=>$data
          );
        echo json_encode($results);
    break;
 

}