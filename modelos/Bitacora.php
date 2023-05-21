<?php

  //conexion a la base de datos

 

   require_once("../config/conexion.php");

   
    class Bitacora extends conexion {


        public function registrar($operacion, $tabla){
        $idUsuario = $_SESSION["idUsuario"];

        $conectar=parent::conectar();
        //parent::set_names();
        $sql="insert into bitacora values(null,?,?,?,now());";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1, $idUsuario);
        $sql->bindValue(2, $operacion);
        $sql->bindValue(3, $tabla);

        $sql->execute();
        print_r($_POST);
        }

        public function get_bitacora(){
            $conectar=parent::conectar();
            $sql="select * from bitacora"; 
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>