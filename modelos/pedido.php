<?php 
	require_once("../config/conexion.php");

	Class ServicioPrestado extends Conexion{

		public function get_filas_pedido(){
			$conectar= parent::conectar();
           
            $sql="select * from pedido_servicio";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
		}

		public function get_servicio(){

        	$conectar = parent::conectar();
       
       		//$sql = "select p.idPedido_Servicio, p.fecha_Servicio, p.Cliente_cedula, s.idCategoria, c.nombre as cat_nombre from servicio s INNER JOIN categoria c ON s.idCategoria=c.idCategoria";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_pedido($nombre,$precio,$idCategoria){
        	$conectar = parent::conectar();

        	$sql="insert into servicio values(null,?,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
            $sql->bindValue(2, $_POST["precio"]);
            $sql->bindValue(3, $_POST["idCategoria"]);
			$sql->execute();
        }

        public function get_pedido_por_id($idPedido_Servicio){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from pedido_servicio where idPedido_Servicio=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idPedido_Servicio);
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }

        public function editar_servicio($idServicio,$nombre,$precio){

             $conectar=parent::conectar();
    
             $sql="update pedido_servicio set nombre=?, precio=? where idServicio=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["precio"]);
             $sql->bindValue(3, $_POST["idServicio"]);
             $sql->execute();
   	    }

   	    public function eliminar_servicio($idServicio){
        
	        $conectar=parent::conectar();

	        $sql="delete from pedidoservicio where idPedido_Servicio=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idServicio);
	        $sql->execute();
	        return $resultado=$sql->fetch();
        }

	}// fin class Categoria


 ?>