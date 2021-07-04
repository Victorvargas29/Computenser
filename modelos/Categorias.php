<?php 
	require_once("../config/conexion.php");

	Class Categoria extends Conexion{

		public function get_filas_categoria(){
			$conectar= parent::conectar();
           
            $sql="select * from categoria";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
		}

		public function get_categoria(){

        	$conectar = parent::conectar();
       
       		$sql = "select c.idCategoria, c.nombre as nombre, c.idDepartamento, d.idDepartamento, d.nombre as depa_nombre from categoria c INNER JOIN departamento d ON c.idDepartamento=d.idDepartamento";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_categoria($nombre, $idDepartamento){
        	$conectar = parent::conectar();

        	$sql="insert into categoria values(null,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
            $sql->bindValue(2, $_POST["idDepartamento"]);
			$sql->execute();
        }

        public function get_categoria_por_id($idCategoria){

        	$conectar= parent::conectar();

            $sql="select * from categoria where idCategoria=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $idCategoria);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function editar_categoria($idCategoria, $nombre, $idDepartamento){

             $conectar=parent::conectar();
    
             $sql="update categoria set nombre=?, idDepartamento=? where idCategoria=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idDepartamento"]);
             $sql->bindValue(3, $_POST["idCategoria"]);
             $sql->execute();
   	    }

   	    public function eliminar_categoria($idCategoria){
        
	        $conectar=parent::conectar();

	        $sql="delete from categoria where idCategoria=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idCategoria);
	        $sql->execute();
	        return $resultado=$sql->fetch();
        }

        public function categoria_por_departamento($idDepartamento){
            $conectar=parent::conectar();

            $sql="select * from categoria where idDepartamento=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idDepartamento);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
        }

	}// fin class Categoria


 ?>