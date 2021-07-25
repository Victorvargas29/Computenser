 <?php
  //llamo a la conexion de la base de datos 
  require_once("../config/conexion.php");

  //llamo al modelo Venta
  require_once("../modelos/ventas.php");
  require_once("../modelos/Servicios.php");

	$venta = new Ventas();
  $servicio = new Servicio();

	$idFactura = isset($_POST["idFactura"]);
	$idServicio = isset($_POST["idServicio "]);
	$precio = isset($_POST["precio"]);
	$nombre_ser = isset($_POST["nombre_ser"]);
 
	$tasa = isset($_POST["tasa"]);
  $cantidad = isset($_POST["cantidad"]);

  switch($_GET["op"]){
	  case "guardar":



    //  $datos = $servicio->get_nombre_servicio_por_id($idServicio);


      $venta->registrar_venta($idFactura,$idServicio,$nombre_ser,$precio,$tasa,$cantidad);
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

    case "eliminar_item":
      $venta->eliminar_item($_POST["iddetallesFT"]);   
    break;

}