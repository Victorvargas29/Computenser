<?php 

require_once("../config/conexion.php");

require_once("../modelos/Departamentos.php");

	$departamento = new Departamentos();

	//$id_empleada = isset($_POST["id_empleada"]); // $_POST["id_empleada"] del atributo name
	$idDepartamento = isset($_POST["idDepartamento"]);
   $nombre = isset($_POST["nombre"]);

   	switch ($_GET["op"]) {
   		case 'guardaryeditar':

        
		$datosNombre = $departamento->get_departamento_por_nombre($_POST["nombre"]);
        if(empty($_POST["idDepartamento"])){
          $datos = $departamento->get_departamento_por_id($_POST["idDepartamento"]);
          
            if(is_array($datos)==true and count($datos)==0){
				if(is_array($datosNombre)==true and count($datosNombre)==0){
					$departamento->registrar_departamento($nombre);
					echo "se registro";
				}else{
					echo "el Departamento ya existe";
				  }
            }
        }else{

			if(is_array($datosNombre)==true and count($datosNombre)==0){
				$departamento->editar_departamento($idDepartamento, $nombre);
            	echo "se edito";	
			}else{
				echo "el Departamento ya existe";
			  }
            
        }
           
      break;

   		case 'mostrar':
   			
   			$datos = $departamento->get_departamento_por_id($_POST["idDepartamento"]);
   			
   			if(is_array($datos)==true and count($datos)>0){
   				foreach ($datos as $row) {
   				//	$output["idDepartamento"] = $row["idDepartamento"];
   					$output["nombre"] = $row["nombre"];
   				}
   				echo json_encode($output);
   			}else{
   				$errors[]="El Departamento no existe";
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

   			$datos = $departamento->get_departamento();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["idDepartamento"];
   					$sub_array[]=$row["nombre"];

   					 $sub_array[] = '<button type="button" onClick="mostrar('.$row["idDepartamento"].');"  id="'.$row["idDepartamento"].'" class="btn btn-warning btn-md update" title="Editar Departamento"><i class="fas fa-edit"></i></button>';


                   $sub_array[] = '<button type="button" onClick="eliminar_departamento('.$row["idDepartamento"].');"  id="'.$row["idDepartamento"].'" class="btn btn-danger btn-md" title="Eliminar Departamento"><i class="fas fa-trash-alt"></i></button>';

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

            case "eliminar_departamento":

            $datos = $departamento->get_departamento_por_id($_POST["idDepartamento"]);
            if (is_array($datos)==true and count($datos)>0) {
                  $departamento->eliminar_departamento($_POST["idDepartamento"]);
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