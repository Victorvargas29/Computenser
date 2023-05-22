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

  
         public function registrar($tasa,$idorden){
         //echo $comboCedula;
          $conectar=parent::conectar();
          
          $sql="insert into factura values(null,now(),?,?,?);";
        
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, '0'); 
          $sql->bindValue(2, $tasa); 
          $sql->bindValue(3, $idorden);
          
          
          $result=$sql->execute();
          return $idorden;
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

       
        public function venta(){
         
          $conectar=parent::conectar();
   	    	

          $sql="select * from factura"; 

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();

        }

        public function Max(){
          $conectar=parent::conectar();
          //	parent::set_names();
            $sql="select MAX(idFactura)idFactura from factura";
            $sql=$conectar->prepare($sql);
            $sql->execute();
          // echo intval($sql);
          return $resultado= $sql->fetch(PDO::FETCH_ASSOC);
        }

        public function Max2(){
          $conectar=parent::conectar();
        //	parent::set_names();
          $sql="select idFactura from factura order by idFactura asc";
          $sql=$conectar->prepare($sql);
          $sql->execute();
         // echo intval($sql);
          return $resultado=$sql->fetchAll();
        }
        //$_POST
        public function detallesDetalles($jsomdetalles){
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="insert into detallefactura values(null,?,?,?,?,?,?);";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $jsomdetalles["idFactura"]); 
          $sql->bindValue(2, $jsomdetalles["idServicio"]); 
          $sql->bindValue(3, $jsomdetalles["precio"]);
          $sql->bindValue(4, $jsomdetalles["descripcion"]);
          $sql->bindValue(5, $jsomdetalles["tasa"]);
          $sql->bindValue(6, $jsomdetalles["cantidad"]);
         // $sql->bindValue(4, $_POST["tasa"]);                   
          $sql->execute();

          return $resultado=$sql->fetchAll();
        }
        
        public function reporte_factura($idFactura){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select f.idFactura, f.fecha, f.tasa,f.anulado,f.numDoc,o.placa, c.cedula,c.nombre,c.apellido,c.direccion,c.telefono
          from factura f 
          INNER JOIN orden o ON o.numDoc=f.numDoc 
          JOIN vehiculo v ON v.placa=o.placa
          JOIN cliente c ON c.cedula=v.cedula WHERE f.idFactura=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idFactura);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

   	    }
         public function detalles_reporte_factura($numDoc){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * FROM  ordenservicios os 
          INNER JOIN servicio s ON os.codeServicio=s.codeServicio 
          WHERE os.numDoc=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $numDoc);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

   	    }

         public function get_facturas(){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql = "select f.idFactura, f.fecha, f.anulado, f.numDoc, o.placa, c.cedula, c.nombre, c.apellido 
           from factura AS f
           inner join orden AS o ON f.numDoc=o.numDoc
           join vehiculo as v ON o.placa=v.placa
           join cliente as c ON v.cedula=c.cedula";
          $sql=$conectar->prepare($sql);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function get_detalles_factura($idFactura){

          $conectar = parent::conectar();      
  
          $sql = "select f.idFactura, f.tipo_moneda, f.placa, f.oentrega, f.fecha, s.Nombre, df.descripcion, df.precio, df.tasa, df.cantidad,c.cedula,c.apellido, c.nombre, c.direccion,c.telefono from factura AS f INNER JOIN cliente AS c ON f.cedula=c.cedula INNER JOIN detallefactura df ON f.idFactura=df.idFactura JOIN servicio AS s on df.idServicio=s.idServicio WHERE f.idFactura=?";
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