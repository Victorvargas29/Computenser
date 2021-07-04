<?php 



require_once("../modelos/PresentacionP.php");

	$presentacion = new PresentacionP();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$idPresentacionP = isset($_POST["idPresentacionP"]);
   	$nombre = isset($_POST["nombre"]);

   	switch ($_GET["op"]) {

   		case 'guardaryeditar':

        
        
        if(empty($_POST["idPresentacionP"])){

          $datos = $presentacion->get_presentacionP_por_id($_POST["idPresentacionP"]);
		   
		  if(is_array($datos)==true and count($datos)==0){

               $presentacion->registrar_presentacionP($nombre);
               echo "se registro";
               
            }else{
				
				echo "el producto ya existe";
              
              
            }
        }else{

            $presentacion->editar_presentacionP($idPresentacionP, $nombre);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $presentacion->get_presentacionP_por_id($_POST["idPresentacionP"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				
   					$output["nombre"] = $row["nombre"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Presentacion no existe";
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

   			$datos = $presentacion->get_presentacionP();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idPresentacionP"];
   					$sub_array[]=$row["nombre"];

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idPresentacionP"].');"  id="'.$row["idPresentacionP"].'" class="btn btn-warning btn-md update" title="Editar"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_presentacionP('.$row["idPresentacionP"].');"  id="'.$row["idPresentacionP"].'" class="btn btn-danger btn-md" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_presentacionP":

            $datos = $presentacion->get_presentacionP_por_id($_POST["idPresentacionP"]);
            
            if (is_array($datos)==true and count($datos)>0) {
                  $presentacion->eliminar_presentacionP($_POST["idPresentacionP"]);
                  $messages[]="se elimino correctamente";
            }


  //prueba mensaje de success
          if(isset($messages)){
            ?>
            <div class="alert alert-success" role="alert">
        
              <button type="button" class="close" data-dismiss="alert">&times;                
              </button>
              <strong>¡Bien hecho!</strong>
              <?php 
                foreach ($messages as $message) {
                  echo $message;
                }
               ?>
            </div>
            <?php
          }//fin mensaje

   		    break;
   	}

 ?>