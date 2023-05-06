<?php 

require_once("../modelos/Proveedor.php");

	$proveedor = new Proveedores();

	$rif = isset($_POST["rif"]);
  $comboRif=isset($_POST["comboRif"]);
	$nombre = isset($_POST["nombre"]);
  $direccion = isset($_POST["direccion"]);

   	switch ($_GET["op"]) {

   		case 'guardaryeditar':

        $datos = $proveedor->get_proveedor_por_id($_POST["rif"]);
       
          if(is_array($datos)==true and count($datos)==0){
              
            $proveedor->registrar_proveedor($rif,$nombre,$direccion);
			  
			   	echo "se registro", $rif;
           
            }else{

             	echo "el proveedor ya existe";
              	$proveedor->editar_proveedor($rif, $nombre,$direccion);
           		echo "se edito";

            }
   
      break;

   		case 'mostrar':
   			
   			$datos = $proveedor->get_proveedor_por_id($_POST["rif"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {

   					$output["rif"] = $row["rif"];
   					$output["nombre"] = $row["nombre"];
            $output["direccion"] = $row["direccion"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El proveedor no existe";
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

   			$datos = $proveedor->get_proveedor();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["rif"];
   					$sub_array[]=$row["nombre"];
            		$sub_array[]=$row["direccion"];
            		$rif=$row["rif"];
   					 $sub_array[] = '<button type="button" onClick="mostrar('."'".$rif."'".');"  id="'.$row["rif"].'" class="btn btn-warning btn-md update" title="Editar proveedor"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_proveedor('."'".$rif."'".');"  id="'.$rif.'" class="btn btn-danger btn-md" title="Eliminar proveedor"><i class="fas fa-trash-alt"></i></button>';

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

			case 'listarEnProducto':

			$datos = $proveedor->get_proveedor();
				$data = array();
				foreach ($datos as $row) {
					$sub_array = array();

					$sub_array[]=$row["rif"];
					$sub_array[]=$row["nombre"];
					$rif=$row["rif"];
						$sub_array[] = '<button type="button" onClick="asociar('."'".$rif."'".');"  id="'.$row["rif"].'" class="btn btn-warning btn-md update" title="Asociar proveedor al producto"><i class="fas fa-edit"></i></button>';


				
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

            case "eliminar_proveedor":

            $datos = $proveedor->get_proveedor_por_id($_POST["rif"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $proveedor->eliminar_proveedor($_POST["rif"]);
                  $messages[]="se elimino correctamente";
            }

   		    break;

			

          case "listar_en_compras":

     $datos=$proveedor->get_proveedor();

     //Vamos a declarar un array
   $data= Array();

     foreach($datos as $row)
      {
        $sub_array = array();

    
        
          $sub_array[] = $row["rif"];
         $sub_array[] = $row["nombre"];        
        $sub_array[] = $row["direccion"];
            
        $data[] = $sub_array;
      }

      $results = array(
      "sEcho"=>1, //Información para el datatables
      "iTotalRecords"=>count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);


     break;

case "buscar_proveedor":


  $datos=$proveedor->get_proveedor_por_id($_POST["rif"]);


        if(is_array($datos)==true and count($datos)>0){

        foreach($datos as $row)
        {
          
          $output["rif"] = $row["rif"];
          $output["nombre"] = $row["nombre"];
          $output["direccion"] = $row["direccion"];
          
        }

      

          } else {
                 
                 //si no existe el registro entonces no recorre el array
                
                 $output["error"]="El proveedor seleccionado está inactivo, intenta con otro";


          }

          echo json_encode($output);

     break;




   	}

 ?>
