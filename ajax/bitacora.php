<?php 

require_once("../config/conexion.php");

require_once("../modelos/Bitacora.php");

	$bitacora = new Bitacora();

   	switch ($_GET["op"]) {

   		case 'listar_bitacora':

   			$datos = $bitacora->get_bitacora();
   				$data = array();
   				foreach ($datos as $row) {
   					$sub_array = array();

   					$sub_array[]=$row["id"];
   					$sub_array[]=$row["usuario"];
					$sub_array[]=$row["operacion"];
					$sub_array[]=$row["tabla"];
					$sub_array[]=$row["fecha"];

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

 ?>