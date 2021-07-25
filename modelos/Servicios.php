<?php 
	require_once("../config/conexion.php");

	Class Servicio extends Conexion{

		public function get_filas_servicio(){
			$conectar= parent::conectar();
           
            $sql="select * from servicio";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
		}

		public function get_servicio(){

        	$conectar = parent::conectar();
       
       		$sql = "select s.idServicio, s.nombre as nombre, s.precio, s.idCategoria, c.nombre as cat_nombre, d.nombre as depa_nombre from servicio s INNER JOIN categoria c ON s.idCategoria=c.idCategoria INNER JOIN departamento d ON c.idDepartamento=d.idDepartamento";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_servicio($nombre,$precio,$idCategoria){
        	$conectar = parent::conectar();

        	$sql="insert into servicio values(null,?,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
            $sql->bindValue(2, $_POST["precio"]);
            $sql->bindValue(3, $_POST["idCategoria"]);
			$sql->execute();
        }

        public function get_servicio_por_id($idServicio){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select nombre, precio, idCategoria from servicio where idServicio=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idServicio);
          ;
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }

        public function editar_servicio($idServicio,$nombre,$precio){

             $conectar=parent::conectar();
    
             $sql="update servicio set nombre=?, precio=? where idServicio=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["precio"]);
             $sql->bindValue(3, $_POST["idServicio"]);
             $sql->execute();
   	    }

   	    public function eliminar_servicio($idServicio){
        
	        $conectar=parent::conectar();

	        $sql="delete from servicio where idServicio=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idServicio);
	        $sql->execute();
	        return $resultado=$sql->fetch();
        }


        public function get_nombre_servicio_por_id($idServicio){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select nombre from servicio where idServicio=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idServicio);
          ;
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }

	}// fin class Categoria


 ?>