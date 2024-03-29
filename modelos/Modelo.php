<?php 
	require_once("../config/conexion.php");
    require_once("../modelos/Bitacora.php");
	Class Modelos extends Conexion{

		public function get_filas_modelo(){
			$conectar= parent::conectar();
           
            $sql="select * from modelo";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
		}

		public function get_modelo(){

        	$conectar = parent::conectar();
            parent::set_names();

            $sql = "select m.idModelo, m.nombre as nombre, ma.nombre as marca_nom from modelo m INNER JOIN marca ma ON m.idMarca=ma.idMarca";
       		//$sql = "select m.idModelo, m.nombre as nombre, m.idMarca, m.inicio_gen, m.fin_gen, a.años as iniaños, a.id, aa.id, aa.años as finaños, ma.idMarca, ma.nombre as marca_nom from modelo m INNER JOIN marca ma ON m.idMarca=ma.idMarca INNER JOIN año a ON m.inicio_gen=a.id INNER JOIN año aa ON m.fin_gen=aa.id";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function registrar_modelo($nombre, $idMarca){
        	$conectar = parent::conectar();

        	$sql="insert into modelo values(null,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["nombre"]);
            $sql->bindValue(2, $_POST["idMarca"]);
    
			$sql->execute();
            $bita = new Bitacora();
             $bita->registrar('Registrar','modelo');
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
    
             $sql="update modelo set nombre=?, idMarca=? where idModelo=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["idMarca"]);
             $sql->bindValue(3, $_POST["idModelo"]);
             $sql->execute();
             $bita = new Bitacora();
             $bita->registrar('Actualizar','modelo');
   	    }

   	    public function eliminar_modelo($idModelo){
        
	        $conectar=parent::conectar();

	        $sql="delete from modelo where idModelo=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idModelo);
	        $sql->execute();
            $bita = new Bitacora();
          $bita->registrar('Eliminar','modelo');
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

       
        
       
        

	}// fin class modelo


 ?>