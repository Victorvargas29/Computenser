<?php 

require_once("../config/conexion.php");

session_destroy();

header("Location:".conexion::ruta()."vistas/index.php");
exit();

 ?>