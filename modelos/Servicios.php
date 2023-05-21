<?php 
	require_once("../config/conexion.php");
  require_once("../modelos/Bitacora.php");
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
       
       		$sql = "select s.codeServicio, s.nombre as nombre, s.precio from servicio s";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function get_servicio2(){

        	$conectar = parent::conectar();
       
       		$sql = "select codeServicio, nombre, precio from servicio";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_OBJ);
        }

        public function registrar_servicio($nombre,$precio){
        	  $conectar = parent::conectar();

        	  $sql="insert into servicio values(null,?,?,?);";
            $sql=$conectar->prepare($sql);
        	  $sql->bindValue(1,$nombre);
            $sql->bindValue(2, $precio);
			      $sql->execute();
            $bita = new Bitacora();
             $bita->registrar('Registrar','servicio');
        }

        public function get_servicio_por_id($idServicio){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from servicio where codeServicio=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idServicio);
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }
        public function get_servicio_por_nombre($nombre){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from servicio where nombre=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $nombre);
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }

        public function editar_servicio($idServicio,$nombre,$precio){

             $conectar=parent::conectar();
    
             $sql="update servicio set nombre=?, precio=? where codeServicio=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["precio"]);
             $sql->bindValue(3, $_POST["idServicio"]);
             $sql->execute();
             $bita = new Bitacora();
             $bita->registrar('Actualizar','servicio');
   	    }

   	    public function eliminar_servicio($idServicio){
        
	        $conectar=parent::conectar();

	        $sql="delete from servicio where codeServicio=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idServicio);
	        $sql->execute();
          $bita = new Bitacora();
          $bita->registrar('Eliminar','servicio');
	        return $resultado=$sql->fetch();
        }


        public function get_nombre_servicio_por_id($idServicio){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select nombre from servicio where codeServicio=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idServicio);
          ;
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }

	}// fin class 


 ?>