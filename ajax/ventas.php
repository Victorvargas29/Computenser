 <?php
  
  //llamo a la conexion de la base de datos 
  require_once("../config/conexion.php");

  //llamo al modelo Venta
  require_once("../modelos/ventas.php");

	$venta = new Ventas();
	$idFactura = isset($_POST["idFactura"]);
	$idServicio = isset($_POST["idServicio "]);
	$precio = isset($_POST["precio"]);
	$tasa= isset($_POST["tasa"]);
 
 //$bs=$precio * $tasa;

 

  switch($_GET["op"]){
	  case "guardar":
   // $bs=$precio * $tasa;


      $venta->registrar_venta($idFactura,$idServicio,$precio);
	  
      break;

      case 'listar':

        $datos = $servicio->get_servicio();
          $data = array();
          foreach ($datos as $row) {
            $sub_array = array();

            $sub_array[]=$row["iddetallesFT"];
            $sub_array[]=$row["Nombre"];
           $sub_array[]=$row["precio"] * $row["tasa"];
           $sub_array[]=$row["precio"];
           $sub_array[]=$row["precio"] * 0.16;


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


}