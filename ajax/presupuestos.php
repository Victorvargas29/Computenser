 <?php
  //llamo a la conexion de la base de datos 
  require_once("../config/conexion.php");

  //llamo al modelo Venta
  require_once("../modelos/Presupuestos.php");
  require_once("../modelos/Servicios.php");

	$presupuesto = new Presupuestos();
  $servicio = new Servicio();
  $cedula = isset($_POST["cedula"]);
	$idPresupuesto = isset($_POST["idPresupuesto"]);
	$idServicio = isset($_POST["idServicio"]);
	$id_tdetalles = isset($_POST["id_tdetalles"]);
  
	$precio = isset($_POST["precio"]);
	$nombre_ser = isset($_POST["nombre_ser"]);
  $descripcion = isset($_POST["descripcion"]);
	$placa = isset($_POST["placa"]);
  $comboCedula = isset($_POST["comboCedula"]);

 

  $moneda = isset($_POST["moneda"]);

  $estado = isset($_POST["estado"]);

  $NroPresupuesto = isset($_POST["NroPresupuesto"]);
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

     

        $presupuesto->agregar_detalle($idPresupuesto,$id_tdetalles,$nombre_ser,$precio,$tasa,$descripcion,$cantidad,$idUsuario);

 

    break;

    case "listar":
      $datos = $presupuesto->detalles_presupuesto($idUsuario);
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();

        $sub_array[] = '<button title="Eliminar" type="button" onClick="eliminar_item('.$row["id_tdetalle"].');"  id="'.$row["id_tdetalle"].'" class="btn btn-danger btn-md"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>';
        $sub_array[] = $row["nomb_serv"]." - ".$row["descripcion"];
        $sub_array[] = $row["precio"];
        $sub_array[] = number_format($row["precio"] * $row["tasa"],2);
        // $sub_array[] = $row["precioTemp"] * $row["tasa"] * 0.16; 
        $sub_array[] = $row["cantidad"];
        $sub_array[] = number_format($row["precio"] * $row["tasa"] * $row["cantidad"],2);
        $sub_array[] = number_format($row["precio"] * $row["cantidad"],2);
        
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
      $datos = $presupuesto->detalles_presupuesto($idUsuario);
      $data = array();
      foreach ($datos as $row) {
        $sub_array = array();
       
        $precio= ($row["precio"]*$row["cantidad"])+$precio;
        $precioBs = ($row["precio"] * $row["tasa"]*$row["cantidad"])+$precioBs;
        $ivaBs = ($row["precio"] * $row["tasa"]*$row["cantidad"] * 0.16)+$ivaBs; 
        $iva = ($row["precio"] *$row["cantidad"] * 0.16)+$iva; 
        $precioTBs = ($row["precio"] * $row["tasa"] * $row["cantidad"]*1.16)+$precioTBs;
        $precioT = ($row["precio"] * $row["cantidad"]*1.16)+$precioT;
        
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

      $presupuestoMax = $presupuesto->Max();
      $temporalMax = $presupuesto->datos_en_temporal();
      $TemporalUsuario = $presupuesto->datos_en_temporal_idUsuario($idUsuario);
 
      if(is_array($temporalMax)==true and count($temporalMax)>0){

        if(is_array($TemporalUsuario)==true and count($TemporalUsuario)>0){
          foreach ($TemporalUsuario as $row) {

            //	$output["idDepartamento"] = $row["idDepartamento"];
              $output["idPresupuesto"] = $row["idPresupuesto"];
            }
            echo json_encode($output);
        }else{

            foreach ($temporalMax as $row) {
            //	$output["idDepartamento"] = $row["idDepartamento"];
             $temp= $row["idPresupuesto"];
            }
            foreach ($presupuestoMax as $presupuestoMaxima) {
              //	$output["idDepartamento"] = $row["idDepartamento"];
                $fact = $presupuestoMaxima["idPresupuesto"];
            }
              if ($fact>$temp) {
                foreach ($presupuestoMax as $row) {
                  //	$output["idDepartamento"] = $row["idDepartamento"];
                  $output["idPresupuesto"]= $row["idPresupuesto"]+1;
                  }

              }
              else{
                foreach ($temporalMax as $row) {
                  //	$output["idDepartamento"] = $row["idDepartamento"];
                  $output["idPresupuesto"]= $row["idPresupuesto"]+1;
                  }

              }
            echo json_encode($output);
        }
      }else{

          if(is_array($presupuestoMax)==true and count($presupuestoMax)>0){
            foreach ($presupuestoMax as $row) {
            //	$output["idDepartamento"] = $row["idDepartamento"];
              $output["idPresupuesto"] = $row["idPresupuesto"]+1;
            }
            echo json_encode($output);
        }else{
          $errors[]="El Servicio no existe";
        }
      }

      

      break;

    case "eliminar_item":
      $presupuesto->eliminar_item($_POST["id_tdetalle"]);   
    break;
    
    case 'guardarVenta':
            
    
             $presupuesto->registrar($idPresupuesto,$cedula,$moneda,$placa,$comboCedula);
             $presupuesto->detallesDetalles($idUsuario);
             sleep(2);
             $presupuesto->eliminar_temp_condicion($idUsuario);
            
            
    
    break;
    case "borrar_temp":
      $presupuesto->eliminar_temp_condicion($idUsuario);
    break;

    case "listarpresupuestos":
      
      $datos = $presupuesto->get_presupuestos();
      $data = array();
      foreach ($datos as $row) {
        if ($row["idPresupuesto"]>1) {
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
         

        $sub_array[] = '<span>'.$row["idPresupuesto"].'</span> ';
        $sub_array[] = $row["nombre"];
        $sub_array[] = $row["cedula"];  //onClick=mostrarPresupuesto('.$row["idPresupuesto"].','.$moneda.')
        $sub_array[] = '<button title="'.$est.'" type="button" onClick="tipomoneda('.$row["idPresupuesto"].','.$row["tipo_moneda"].');" name="tipo_moneda" id="'.$row["idPresupuesto"].'" class="'.$atrib.'"><i class="'.$atrib_icon.'"></i>'.$titulo.'</button>';
        $sub_array[] = '<button title="Ver" type="button" onClick=mostrarPresupuesto('.$row["idPresupuesto"].') id="" class="btn btn-success btn-md"><i class="fas fa-eye" aria-hidden="true"></i></button>';
        $sub_array[] = '<button title="'.$tip.'" type="button" onClick="anulacion('.$row["idPresupuesto"].','.$row["anulado"].')"  id="'.$row["idPresupuesto"].'" class="'.$atrib_clases.'"><i class="'.$atrib_icono.'" aria-hidden="true"></i>'.$titulo2.'</button>';
        
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
            $presupuesto->cambiar_moneda($_POST["idPresupuesto"],$_POST["tipo_moneda"]);
      //    }
      break;
      case "anular":
        
            $presupuesto->anular($_POST["idPresupuesto"]);

      break;
}