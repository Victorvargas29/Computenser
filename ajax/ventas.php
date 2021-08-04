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
	$idServicio = isset($_POST["idServicio "]);
	$precio = isset($_POST["precio"]);
	$nombre_ser = isset($_POST["nombre_ser"]);

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
	  case "guardar":

    //  $datos = $servicio->get_nombre_servicio_por_id($idServicio);


      $venta->registrar_venta($idFactura,$idServicio,$nombre_ser,$precio,$tasa,$cantidad,$idUsuario);
    break;

    case "listar":
      $datos = $venta->detalles_venta();
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();

        $sub_array[] = '<button title="Eliminar" type="button" onClick="eliminar_item('.$row["iddetallesFT"].');"  id="'.$row["iddetallesFT"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
        $sub_array[] = $row["nombre_serv"];
        $sub_array[] = $row["precioTemp"];
        $sub_array[] = $row["precioTemp"] * $row["tasa"];
        $sub_array[] = $row["precioTemp"] * $row["tasa"] * 0.16; 
        $sub_array[] = $row["cantidad"];
        $sub_array[] = $row["precioTemp"] * $row["tasa"] * $row["cantidad"];
        $sub_array[] = $row["precioTemp"] * $row["cantidad"];
        
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
      $datos = $venta->detalles_venta();
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();

       // $sub_array[] = '<button title="Eliminar" type="button" onClick="eliminar_item('.$row["iddetallesFT"].');"  id="'.$row["iddetallesFT"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
       
        $precio= ($row["precioTemp"]*$row["cantidad"])+$precio;
        $precioBs = ($row["precioTemp"] * $row["tasa"]*$row["cantidad"])+$precioBs;
        $ivaBs = ($row["precioTemp"] * $row["tasa"]*$row["cantidad"] * 0.16)+$ivaBs; 
        $iva = ($row["precioTemp"] *$row["cantidad"] * 0.16)+$iva; 
        $precioTBs = ($row["precioTemp"] * $row["tasa"] * $row["cantidad"]*1.16)+$precioTBs;
        $precioT = ($row["precioTemp"] * $row["cantidad"]*1.16)+$precioT;
        
        //$data[]=$sub_array;
      }
      $sub_array[] = $precio;
      $sub_array[] = $precioBs;
      $sub_array[] = $iva;
      $sub_array[] = $ivaBs;
      $sub_array[] = $precioT;
      $sub_array[] = $precioTBs;
      
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
   			
      $datos = $venta->Max();
      
      if(is_array($datos)==true and count($datos)>0){
        foreach ($datos as $row) {

        //	$output["idDepartamento"] = $row["idDepartamento"];
          $output["idFactura"] = $row["idFactura"]+1;
        }
        echo json_encode($output);
      }else{
        $errors[]="El Servicio no existe";
      }

      break;

    case "eliminar_item":
      $venta->eliminar_item($_POST["iddetallesFT"]);   
    break;
    
    case 'guardarVenta':
      
             $venta->registrar($cedula);
             $venta->detallesDetalles();
             sleep(2);
             $venta->eliminar_temporal();
            
             echo "se registro";
    
    break;
    case "borrar_temp":
      $venta->eliminar_temporal();
    break;
}