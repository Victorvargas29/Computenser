<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Ventas extends Conexion {

       //listar los usuarios
   	    public function get_venta(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from detallefactura d inner join servicio s  on d.idServicio=s.idServicio";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }

   	    public function registrar_venta($idFactura,$idServicio,$nombre_ser,$precio,$tasa,$cantidad){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into detallesfacturatemporal values(null,?,?,?,?,?,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["idFactura"]); 
             $sql->bindValue(2, $_POST["idServicio"]); 
             $sql->bindValue(3, $_POST["nombre_ser"]);
             $sql->bindValue(4, $_POST["precio"]);
             $sql->bindValue(5, $_POST["tasa"]);
             $sql->bindValue(6, $_POST["cantidad"]); 
            // $sql->bindValue(4, $_POST["tasa"]);                   
             $sql->execute();
             //echo "se registro";
            // print_r($_POST);
   	    }

   	    public function editar_venta($cedula, $nombre, $apellido,$direccion,$telefono){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update venta set nombre=?, apellido=?, direccion=?, telefono=? where cedula=?";
             //echo $sql;    //imprime la consulta para verificar en phpmyadmin
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["nombre"]);
             $sql->bindValue(2, $_POST["apellido"]);
             $sql->bindValue(3, $_POST["direccion"]);
             $sql->bindValue(4, $_POST["telefono"]);
             $sql->bindValue(5, $_POST["cedula"]);
             $sql->execute();
        //print_r($_POST); 	//comprobar que si se estan enviando los datos
   	    /*para q se muestre los valores en la consola hay q agregar console.log(datos);
   	    en el js debajo del success   */
   	    }

   	    public function get_venta_por_id($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from venta where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_venta($cedula){
          $conectar=parent::conectar();

          $sql="delete from venta0 where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetch();
        }

        public function detalles_venta(){
         
          $conectar=parent::conectar();
   	    	

          $sql="select * from detallesfacturatemporal"; 

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();

        }

        public function eliminar_item($idTemporal){
          $conectar=parent::conectar();

          $sql="delete from detallesfacturatemporal where iddetallesFT=?";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$idTemporal);
          $sql->execute();

          return $resultado=$sql->fetch();
        }
        public function Max(){

          $conectar=parent::conectar();
        //	parent::set_names();

          $sql="select MAX(idFactura) FROM factura";

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetch();
        }




   }
   
?>