<?php 

//require_once("../config/conexion.php");

require_once("../modelos/Categorias.php");
require_once("../modelos/Departamentos.php");

	$categoria = new Categoria();
  $depar = new Departamentos();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
  $idCategoria = isset($_POST["idCategoria"]);
  $nombre = isset($_POST["nombre"]);  //nombre categoria
	$idDepartamento = isset($_POST["idDepartamento"]);
   

   	switch ($_GET["op"]) {

      case 'selectDepartamento':
        $rspta=$depar->get_departamento_2();
        echo '<option value="0" selected disabled>Seleccione departamento </option>';
        foreach ($rspta as $reg) {
          echo '<option class="font-weight-bold" value='. $reg->idDepartamento .'>'. $reg->nombre . '</option>';
        }


      break;

   		case 'guardaryeditar':
 
        if(empty($_POST["idCategoria"])){
          $datos = $categoria->get_categoria_por_id($_POST["idCategoria"]);
            if(is_array($datos)==true and count($datos)==0){

               $categoria->registrar_categoria($nombre, $idDepartamento);
               echo "se registro";
               
            }else{

              echo "el producto ya existe";
              
            }
        }else{

            $categoria->editar_categoria($idCategoria,$nombre,$idDepartamento);
            echo "se edito";
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $categoria->get_categoria_por_id($_POST["idCategoria"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idDepartamento"] = $row["idDepartamento"];
   					$output["nombre"] = $row["nombre"];
            $output["idDepartamento"]=$row["idDepartamento"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Categoria no existe";
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

   			$datos = $categoria->get_categoria();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idCategoria"];
   					$sub_array[]=$row["nombre"];
            $sub_array[]=$row["depa_nombre"];

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idCategoria"].');"  id="'.$row["idCategoria"].'" class="btn btn-warning btn-md update" title="Editar Categoria"><i class="fas fa-edit"></i></button>';


            $sub_array[] = '<button type="button" onClick="eliminar_categoria('.$row["idCategoria"].');"  id="'.$row["idCategoria"].'" class="btn btn-danger btn-md" title="Eliminar Categoria"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_categoria":

            $datos = $categoria->get_categoria_por_id($_POST["idCategoria"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $categoria->eliminar_categoria($_POST["idCategoria"]);
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