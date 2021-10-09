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

   	    public function agregar_detalle($idFactura,$idServicio,$nombre_ser,$precio,$tasa,$cantidad,$idUsuario){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into detallesfacturatemporal values(null,?,?,?,?,?,?,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["idFactura"]); 
             $sql->bindValue(2, $_POST["idServicio"]); 
             $sql->bindValue(3, $_POST["nombre_ser"]);
             $sql->bindValue(4, $_POST["precio"]);
             $sql->bindValue(5, $_POST["tasa"]);
             $sql->bindValue(6, $_POST["cantidad"]);
             $sql->bindValue(7, $idUsuario); 
            // $sql->bindValue(4, $_POST["tasa"]);                   
             $sql->execute();
             //echo "se registro";
            // print_r($_POST);
   	    }
         public function registrar($idFactura,$cedula){

          $conectar=parent::conectar();
          //parent::set_names();
          $sql="insert into factura values(?,now(),?,?,'0');";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $_POST["idFactura"]); 
          $sql->bindValue(2, $_POST["cedula"]); 
          $sql->bindValue(3, $_POST["moneda"]); 
          ; 
         // $sql->bindValue(4, $_POST["tasa"]);                   
          $sql->execute();
          //echo detallesDetalles();
          //eliminar_temporal();
          echo "se registro";
         // print_r($_POST);
      }

          
          public function eliminar_temporal(){
            $conectar=parent::conectar();

          $sql="delete from detallesfacturatemporal";
          $sql=$conectar->prepare($sql);
          
          $sql->execute();
          return $resultado=$sql->fetch();

          }

          public function eliminar_temp_condicion($idUsuario){
            $conectar=parent::conectar();

          $sql="delete from detallesfacturatemporal where idUsuario=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();
          return $resultado=$sql->fetch();

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

        public function detalles_venta($idUsuario){
         
          $conectar=parent::conectar();
          $sql="select * from detallesfacturatemporal where idUsuario=?"; 
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();

          return $resultado=$sql->fetchAll();

        }
        public function venta(){
         
          $conectar=parent::conectar();
   	    	

          $sql="select * from factura"; 

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


        public function datos_en_temporal(){
          $conectar=parent::conectar();
          //	parent::set_names();
        
            $sql="select idFactura from detallesfacturatemporal";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function datos_en_temporal_idUsuario($idUsuario){
          $conectar=parent::conectar();
          //	parent::set_names();
        
            $sql="select idFactura, idUsuario from detallesfacturatemporal where idUsuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idUsuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function Max2(){
          $conectar=parent::conectar();
          //	parent::set_names();
            $sql="select MAX(idFactura) from factura";
            $sql=$conectar->prepare($sql);
            $sql->execute();
          // echo intval($sql);
            return $resultado=$sql->fetchAll();
        }

        public function Max(){
          $conectar=parent::conectar();
        //	parent::set_names();
          $sql="select idFactura from factura order by idFactura asc";
          $sql=$conectar->prepare($sql);
          $sql->execute();
         // echo intval($sql);
          return $resultado=$sql->fetchAll();
        }

        public function detallesDetalles($idUsuario){

          $conectar=parent::conectar();
        //	parent::set_names();

          $sql="insert into detallefactura (idFactura, idServicio,precio,tasa,cantidad) select idFactura, idServicio,precioTemp,tasa,cantidad from detallesfacturatemporal where idUsuario=?";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();
         // echo intval($sql);

          return $resultado=$sql->fetchAll();
        }
        
        public function get_venta_idfactura($idFactura){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from factura where idFactura=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idFactura);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

         public function get_facturas(){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql = "select * from factura AS f inner join cliente AS c ON f.cedula= c.cedula";
          $sql=$conectar->prepare($sql);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function get_detalles_factura($idFactura){

          $conectar = parent::conectar();      
  
          $sql = "select f.idFactura, f.tipo_moneda, f.fecha, s.Nombre, df.precio, df.tasa, df.cantidad,c.cedula,c.apellido, c.nombre, c.direccion,c.telefono from factura AS f INNER JOIN cliente AS c ON f.cedula=c.cedula INNER JOIN detallefactura df ON f.idFactura=df.idFactura JOIN servicio AS s on df.idServicio=s.idServicio WHERE f.idFactura=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idFactura);
          $sql->execute();
          //print_r($_POST);
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function cambiar_moneda($idFactura,$tipo
        ){
          $conectar = parent::conectar(); 
          echo $_POST["tipo_moneda"];
            //el parametro est se envia por via ajax
   	    	if($_POST["tipo_moneda"]==0){
            $tipo=1;
          } else {
            $tipo=0;
          }
            $sql="update factura set tipo_moneda=? where idFactura=?";

          $sql=$conectar->prepare($sql);


         $sql->bindValue(1,$tipo);
         $sql->bindValue(2,$idFactura);
          $sql->execute();
          print_r($_POST);

        }

        public function consulta_estado(){
          $conectar = parent::conectar(); 
          $sql = "select * from moneda";
          $sql=$conectar->prepare($sql);

          $sql->execute();
          return $resultado=$sql->fetchAll();
        }
        
        public function anular($idFactura){
          $conectar = parent::conectar(); 

          $sql="update factura set anulado=1 where idFactura=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$idFactura);
          $sql->execute();
        }
   }
   
?>