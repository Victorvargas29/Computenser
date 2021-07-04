  
  <?php

 require_once("../config/conexion.php");
 require_once("../modelos/Empleadas.php");

	$empleada = new Empleadas();

  class ServiciosPrestados extends Conexion{


      public function get_filas_servicios_p(){

            $conectar= parent::conectar();
           
             $sql="select * from pedido_servicio";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }


		 public function get_servicios_p(){

		 $conectar= parent::conectar();
       
         $sql="select * from pedido_servicio";

         //echo $sql;
         
         $sql=$conectar->prepare($sql);

         $sql->execute();

         return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
		
		}

	

			

   }