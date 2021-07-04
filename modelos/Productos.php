<?php 
	require_once("../config/conexion.php");

	Class Producto extends Conexion{

		public function get_filas_producto(){
			$conectar= parent::conectar();
           
            $sql="select * from producto";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
		}

		public function get_producto(){

        	$conectar = parent::conectar();
       
       		$sql = "select p.idProducto, p.nombre as nombre, p.idDepartamento, p.cantidadP, p.idPresentacionP, d.idDepartamento, d.nombre as depa_nombre, pr.idPresentacionP, pr.nombre as nombreP from producto p INNER JOIN departamento d ON p.idDepartamento=d.idDepartamento INNER JOIN presentacionProducto pr ON p.idPresentacionP=pr.idPresentacionP";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_producto($nombre, $idDepartamento, $idPresentacionP,$cantidadP){
        	$conectar = parent::conectar();

        	$sql="insert into producto values(null,?,?,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
			$sql->bindValue(2, $_POST["idDepartamento"]);
            $sql->bindValue(3, $_POST["idPresentacionP"]);
            $sql->bindValue(4, $_POST["cantidadP"]);
			$sql->execute();
        }

        public function get_producto_por_id($idProducto){

        	$conectar= parent::conectar();

            $sql="select * from producto where idProducto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $idProducto);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function editar_producto($idProducto, $nombre, $idDepartamento,$idPresentacionP,$cantidadP){

             $conectar=parent::conectar();
    
             $sql="update producto set nombre=?, idDepartamento=?, idPresentacionP=?, cantidadP=? where idProducto=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idDepartamento"]);
			 $sql->bindValue(3, $_POST["idPresentacionP"]);
			 $sql->bindValue(4, $_POST["cantidadP"]);
			 $sql->bindValue(5, $_POST["idProducto"]);
             $sql->execute();
   	    }

   	    public function eliminar_producto($idProducto){
        
	        $conectar=parent::conectar();

	        $sql="delete from producto where idProducto=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idProducto);
	        $sql->execute();
	        return $resultado=$sql->fetch();
        }

	}// fin class PRODUCTO


 ?>