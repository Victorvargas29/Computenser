<?php 

//require_once("../config/conexion.php");

require_once("../modelos/Productos.php");

require_once("../modelos/Modelo.php");
	$modelo = new Modelos();
	$producto = new Producto();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
    $idProducto = isset($_POST["idProducto"]);
    $nombre = isset($_POST["nombre"]);  //nombre producto
    $idDepartamento = isset($_POST["idDepartamento"]);
	$idPresentacionP = isset($_POST["idPresentacionP"]);
	$cantidadP = isset($_POST["cantidadP"]);
   

   	switch ($_GET["op"]) {

   		case 'guardaryeditar':
				
			$datos = $producto->get_producto_por_id($_POST["idProducto"]);
          
            if(is_array($datos)==true and count($datos)==0){

               $producto->registrar_producto($nombre, $idDepartamento, $idPresentacionP,$cantidadP);
               echo "se registro";
               
            }else{

            $producto->editar_producto($idProducto, $nombre, $idDepartamento,$idPresentacionP,$cantidadP);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $producto->get_producto_por_id($_POST["idProducto"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idDepartamento"] = $row["idDepartamento"];
   					$output["nombre"] = $row["nombre"];
                    $output["idDepartamento"]=$row["idDepartamento"];
                    $output["idPresentacionP"]=$row["idPresentacionP"];
                    $output["cantidadP"]=$row["cantidadP"];


   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El PRODUCTO no existe";
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

   			$datos = $producto->get_producto();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idProducto"];
   					$sub_array[]=$row["nombre"];
                    //$sub_array[]=$row["depa_nombre"+"nombreP"];
                    $sub_array[]=$row["cantidadP"]." ".$row["nombreP"];

                   
                   

					$sub_array[]=$row["depa_nombre"];
   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idProducto"].');"  id="'.$row["idProducto"].'" class="btn btn-warning btn-md update" title="Editar producto"><i class="fas fa-edit"></i></button>';


            $sub_array[] = '<button type="button" onClick="eliminar_producto('.$row["idProducto"].');"  id="'.$row["idProducto"].'" class="btn btn-danger btn-md" title="Eliminar producto"><i class="fas fa-trash-alt"></i> </button>';

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

            case "eliminar_producto":

            $datos = $producto->get_producto_por_id($_POST["idProducto"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $producto->eliminar_producto($_POST["idProducto"]);
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
          }//fin mensaje categoria

   		    break;
			case 'selectGen':
				$idModelo=$_POST['idModelo'];
				$rspta=$modelo->generacion_por_modelo($idModelo);
				echo '<option value="0" selected disabled>Seleccione generacion</option>';
				foreach($rspta as $regi){
					echo '<option class="font-weight-bold" value='.$regi->id.'>'.'• '.$regi->anno1.'-'.$regi->anno2.'</option>';
				}
		
			break;

   	}

 ?>