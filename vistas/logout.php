<?php 

require_once("../config/conexion.php");

session_destroy();

header("Location:http://teg.test/vistas/index.php");
exit();

 ?>