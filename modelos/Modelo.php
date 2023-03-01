<?php 
	require_once("../config/conexion.php");

	Class Modelo extends Conexion{

		public function get_filas_modelo(){
			$conectar= parent::conectar();
           
            $sql="select * from modelo";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
		}

		public function get_modelo(){

        	$conectar = parent::conectar();
       
       		$sql = "select c.idModelo, c.nombre as nombre, c.idDepartamento, d.idDepartamento, d.nombre as depa_nombre from modelo c INNER JOIN departamento d ON c.idDepartamento=d.idDepartamento";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_modelo($nombre, $idDepartamento){
        	$conectar = parent::conectar();

        	$sql="insert into modelo values(null,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
            $sql->bindValue(2, $_POST["idDepartamento"]);
			$sql->execute();
        }

        public function get_modelo_por_id($idModelo){

        	$conectar= parent::conectar();

            $sql="select * from modelo where idModelo=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $idModelo);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function editar_modelo($idModelo, $nombre, $idDepartamento){

             $conectar=parent::conectar();
    
             $sql="update modelo set nombre=?, idDepartamento=? where idModelo=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idDepartamento"]);
             $sql->bindValue(3, $_POST["idModelo"]);
             $sql->execute();
   	    }

   	    public function eliminar_modelo($idModelo){
        
	        $conectar=parent::conectar();

	        $sql="delete from modelo where idModelo=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idModelo);
	        $sql->execute();
	        return $resultado=$sql->fetch();
        }

        public function modelo_por_departamento($idDepartamento){
            $conectar=parent::conectar();

            $sql="select * from modelo where idDepartamento=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idDepartamento);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
        }

	}// fin class modelo


 ?>