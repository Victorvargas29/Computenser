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
  $descripcion = isset($_POST["descripcion"]);
	$placa = isset($_POST["placa"]);
	$oentrega = isset($_POST["oentrega"]);
  $comboCedula = isset($_POST["comboCedula"]);

 

  $moneda = isset($_POST["moneda"]);

  $estado = isset($_POST["estado"]);

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

        $venta->agregar_detalle($jsomdetalles);

      }else {
        echo "debe selecionar un servicio";
      }
     

    break;

   

    /*case "listarSubtotales":
     // $datos = $venta->detalles_venta($idUsuario);
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
    break;*/
    case "eliminar_item":
      $venta->eliminar_item($_POST["iddetallesFT"]);   
    break;
    
    case 'guardarFactura':
            

            $res= $venta->registrar($_POST["tasa"],$_POST["idOrden"]);
            echo $res;
             //$venta->detallesDetalles($idUsuario);
             sleep(2);
             //$venta->eliminar_temp_condicion($idUsuario);
            
            
    
    break;
    case 'detallesDetalles':
            
      $jsomEmpleada=$_POST["arregloEmpleada"];
     // $res= $venta->registrar($_POST["cedula"],$_POST["comboCedula"],$_POST["moneda"],$_POST["placa"],$_POST["oentrega"]);
      
       $res=$venta->detallesDetalles($jsomdetalles);
       echo "jsom de prueba de Empleada" , $res;
      // sleep(2);
      // $venta->eliminar_temp_condicion($idUsuario);
      
      

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

          $est = '';
          $atrib = "";
          $atrib_icon = "";
          $titulo="";

         if($row["tipo_moneda"] == 0){
           $est = 'Bolivares';
           $atrib = "btn boton-bs btn-md estado";
           $atrib_icon = "";
           $titulo="Bs";
         }
         else{ $est = 'Dolares';
          $atrib = "btn boton-verde btn-md estado";
          $atrib_icon = "fas fa-dollar-sign";
         }


         $tip = "";
         $atrib_clases = "";
         $atrib_icono="";
         $titulo2="";

        if($row["anulado"] == 1){
          $atrib_clases = "btn btn-danger btn-md estado";
          $titulo2="Anulada";
        }
        else{ 
         // $atrib_icono="fas fa-check";
          $tip = "Anular";
          $titulo2="Anular";
          $atrib_clases = "btn btn-success btn-md estado";
        }
         

        $sub_array[] = '<span>'.$row["idFactura"].'</span> ';
        $sub_array[] = $row["nombre"];
        $sub_array[] = $row["cedula"];  //onClick=mostrarFactura('.$row["idFactura"].','.$moneda.')
        $sub_array[] = '<button title="'.$est.'" type="button" onClick="tipomoneda('.$row["idFactura"].','.$row["tipo_moneda"].');" name="tipo_moneda" id="'.$row["idFactura"].'" class="'.$atrib.'"><i class="'.$atrib_icon.'"></i>'.$titulo.'</button>';
        $sub_array[] = '<button title="Ver" type="button" onClick=mostrarFactura('.$row["idFactura"].') id="" class="btn btn-success btn-md"><i class="fas fa-eye" aria-hidden="true"></i></button>';
        $sub_array[] = '<button title="'.$tip.'" type="button" onClick="anulacion('.$row["idFactura"].','.$row["anulado"].')"  id="'.$row["idFactura"].'" class="'.$atrib_clases.'"><i class="'.$atrib_icono.'" aria-hidden="true"></i>'.$titulo2.'</button>';
        
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

    case "activarydesactivar":
        //los parametros id_usuario y est vienen por via ajax
     
        //valida el id del usuario
         // if(is_array($datos)==true and count($datos)>0){
            //edita el estado del usuario 
            $venta->cambiar_moneda($_POST["idFactura"],$_POST["tipo_moneda"]);
      //    }
      break;
      case "anular":
  
            $venta->anular($_POST["idFactura"]);

      break;
}