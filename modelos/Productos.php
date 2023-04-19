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
		public function get_lineas(){
			$conectar= parent::conectar();
           
            $sql="select * from linea";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
		}

		public function get_producto(){

        	$conectar = parent::conectar();
       
       		$sql = "select p.precio, p.cantidad, p.nombre as nombreP, p.idProducto, l.nombre as nombreL, g.anno1, g.anno2, g.id as idGen, m.idModelo from producto p INNER JOIN linea l ON p.linea_id=l.id INNER JOIN generacion g ON p.generacion_id=g.id JOIN modelo m on g.idModelo=m.idModelo";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_producto($nombre, $precio, $cantidad,$idLinea,$idGeneracion){
        	$conectar = parent::conectar();

        	$sql="insert into producto values(null,?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $nombre);
			$sql->bindValue(2, $precio);
            $sql->bindValue(3, $cantidad);
            $sql->bindValue(4, $idLinea);
            $sql->bindValue(5, $idGeneracion);
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
        public function get_producto_por_nombre($nombre){

        	$conectar= parent::conectar();

            $sql="select * from producto where nombre=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $nombre);
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