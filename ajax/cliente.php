<?php 

require_once("../modelos/Clientes.php");

	$cliente = new Clientes();

	$cedula = isset($_POST["cedula"]);
  $comboCedula=isset($_POST["comboCedula"]);
	$nombre = isset($_POST["nombre"]);
	$apellido = isset($_POST["apellido"]);
  $direccion = isset($_POST["direccion"]);
	$telefono = isset($_POST["telefono"]);
  $correo = isset($_POST["correo"]);

   	switch ($_GET["op"]) {

   		case 'guardaryeditar':

        $datos = $cliente->get_cliente_por_id($_POST["cedula"]);
       
          if(is_array($datos)==true and count($datos)==0){
              
            $cliente->registrar_cliente($cedula,$nombre,$apellido,$direccion,$telefono,$correo);
			  
			   	echo "se registro", $cedula;
           
            }else{

             	echo "el cliente ya existe";
              	$cliente->editar_cliente($cedula, $nombre, $apellido, $direccion,$telefono,$correo);
           		echo "se edito";

            }
   
      break;

   		case 'mostrar':
   			
   			$datos = $cliente->get_cliente_por_id($_POST["cedula"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idDepartamento"] = $row["idDepartamento"];
   					$output["cedula"] = $row["cedula"];
   					$output["nombre"] = $row["nombre"];
   					$output["apellido"] = $row["apellido"];
            $output["direccion"] = $row["direccion"];
   					$output["telefono"] = $row["telefono"];
            $output["correo"] = $row["correo"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El cliente no existe";
   			}

   	//inicio mensaje errors
   	if(isset($errors)){
   		?>
   		<div class="alert alert-danger" role="alert">
   			<button type="button" class="close" data-dismiss="alert">&times;</button>
   			<strong>Error!</strong>
   			<?php
   				foreach ($errors as $error) {
   					echo $error;
   				}

   			?>
   		</div>

   		<?php
   	}//fin mensaje error

   			break;

   		case 'listar':

   			$datos = $cliente->get_cliente();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["cedula"];
   					$sub_array[]=$row["nombre"];
   					$sub_array[]=$row["apellido"];
            $sub_array[]=$row["direccion"];
   					$sub_array[]=$row["telefono"];
            $sub_array[]=$row["correo"];
   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["cedula"].');"  id="'.$row["cedula"].'" class="btn btn-warning btn-md update" title="Editar cliente"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_cliente('.$row["cedula"].');"  id="'.$row["cedula"].'" class="btn btn-danger btn-md" title="Eliminar cliente"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_cliente":

            $datos = $cliente->get_cliente_por_id($_POST["cedula"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $cliente->eliminar_cliente($_POST["cedula"]);
                  $messages[]="se elimino correctamente";
            }

   		    break;

          case "listar_en_ventas":

     $datos=$cliente->get_cliente();

     //Vamos a declarar un array
   $data= Array();

     foreach($datos as $row)
      {
        $sub_array = array();

   /*     $est = '';
        
         $atrib = "btn btn-success btn-md estado";
        if($row["estado"] == 0){
          $est = 'INACTIVO';
          $atrib = "btn btn-warning btn-md estado";
        }
        else{
          if($row["estado"] == 1){
            $est = 'ACTIVO';
            
          } 
        }*/
        
        
          $sub_array[] = $row["cedula"];
         $sub_array[] = $row["nombre"];
         $sub_array[] = $row["apellido"];
         
        $sub_array[] = $row["direccion"];
        $sub_array[] = $row["telefono"];
        $sub_array[] = $row["correo"];
                /* $sub_array[] = '<button type="button"  name="estado" id="'.$row["id_cliente"].'" class="'.$atrib.'">'.$est.'</button>';*/


               /*  $sub_array[] = '<button type="button" onClick="agregar_registro('.$row["cedula"].');" id="'.$row["cedula"].'" class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';*/
                
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);


     break;

case "buscar_cliente":


  $datos=$clientes->get_cliente_por_id($_POST["cedula"]);


          // comprobamos que el cliente esté activo, de lo contrario no lo agrega
        if(is_array($datos)==true and count($datos)>0){

        foreach($datos as $row)
        {
          
          $output["cedula"] = $row["cedula"];
          $output["nombre"] = $row["nombre"];
          $output["apellido"] = $row["apellido"];
          $output["direccion"] = $row["direccion"];
          $output["telefono"] = $row["telefono"];
          $output["correo"] = $row["correo"];

        //  $output["estado"] = $row["estado"];
          
        }

      

          } else {
                 
                 //si no existe el registro entonces no recorre el array
                
                 $output["error"]="El cliente seleccionado está inactivo, intenta con otro";


          }

          echo json_encode($output);

     break;




   	}

 ?>
