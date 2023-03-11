<?php 
	require_once("../config/conexion.php");

	Class Modelos extends Conexion{

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

            $sql = "select m.idModelo, m.nombre as nombre,  a.annos as iniannos, aa.annos as finannos, ma.nombre as marca_nom from modelo m INNER JOIN marca ma ON m.idMarca=ma.idMarca INNER JOIN anno a ON m.inicio_gen=a.id INNER JOIN anno aa ON m.fin_gen=aa.id";
       		//$sql = "select m.idModelo, m.nombre as nombre, m.idMarca, m.inicio_gen, m.fin_gen, a.años as iniaños, a.id, aa.id, aa.años as finaños, ma.idMarca, ma.nombre as marca_nom from modelo m INNER JOIN marca ma ON m.idMarca=ma.idMarca INNER JOIN año a ON m.inicio_gen=a.id INNER JOIN año aa ON m.fin_gen=aa.id";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_modelo($nombre, $idMarca,$inicio_gen,$fin_gen){
        	$conectar = parent::conectar();

        	$sql="insert into modelo values(null,?,?,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
            $sql->bindValue(2, $_POST["idMarca"]);
            $sql->bindValue(3, $_POST["idInicio"]);
            $sql->bindValue(4, $_POST["idFin"]);
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

        public function editar_modelo($idModelo, $nombre, $idMarca){

             $conectar=parent::conectar();
    
             $sql="update modelo set nombre=?, idMarca=?, inicio_gen=?, fin_gen=? where idModelo=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idMarca"]);
             $sql->bindValue(3, $_POST["idInicio"]);
             $sql->bindValue(4, $_POST["idFin"]);
             $sql->bindValue(5, $_POST["idModelo"]);
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

        public function modelo_por_marca($idMarca){
            $conectar=parent::conectar();

            $sql="select * from modelo where idMarca=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idMarca);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
        }
		
        public function get_años(){
			$conectar= parent::conectar();
            $sql="select * from anno";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
		}


	}// fin class modelo


 ?>