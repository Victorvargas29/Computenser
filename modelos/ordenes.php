<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Ordenes extends Conexion {

       //listar los usuarios
   	    public function get_orden(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from detallefactura d inner join servicio s  on d.idServicio=s.idServicio";

   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }

   	   
         public function registrar($placa){

          $conectar=parent::conectar();
          //parent::set_names();
          $sql="insert into orden values(null,now(),?,?);";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, "Sin procesar"); 
          $sql->bindValue(2, $placa); 
         
         
         // $sql->bindValue(4, $_POST["tasa"]);                   
          $sql->execute();
          $ress = $conectar->lastInsertId();
          //echo detallesDetalles();
          //eliminar_temporal();
          echo $ress;
          return $ress;
         // print_r($_POST);
      }

          

        

   	   
   	    public function get_orden_por_id($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from orden where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

      

       
        public function orden(){
         
          $conectar=parent::conectar();
   	    	

          $sql="select * from orden"; 

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();

        }

        
        public function detallesDetalles($jsomdetalles){
          
          $text=$jsomdetalles["idServicio"]."".$jsomdetalles["idOrden"];
          $text=str_replace(" ","",$text);
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="insert into ordenservicios values(?,?,?,?,?);";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $text); 
          $sql->bindValue(2, $jsomdetalles["idServicio"]); 
          $sql->bindValue(3, $jsomdetalles["idOrden"]);
          $sql->bindValue(4, $jsomdetalles["descripcion"]);
          $sql->bindValue(5, $jsomdetalles["precio"]);                   
          $sql->execute();
          
          return $text;
        }
        public function detallesEmpleada($arregloEmpleada){

          $conectar=parent::conectar();
          //parent::set_names();
          $sql1="insert into empleadoservicios values(null,'25135123',?);";
          $sql1=$conectar->prepare($sql1);
        
          $sql1->bindValue(1, $arregloEmpleada["ordenServicio"]); 
                         
          $sql1->execute();

          return $arregloEmpleada["ordenServicio"];
        }
        
       

         public function get_facturas(){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql = "select * from factura AS f inner join cliente AS c ON f.cedula= c.cedula";
          $sql=$conectar->prepare($sql);
          $sql->execute();
          return $resultado=$sql->fetchAll();

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
        public function get_vehiculo($cedula){
          $conectar = parent::conectar();
          parent::set_names();
          $sql = "select c.cedula, ma.nombre as marca_nom, mo.nombre as modelo_nom, ma.idMarca, mo.idModelo, v.placa, co.nombre as color_nom, v.anno 
          from vehiculo v 
          INNER JOIN cliente c ON v.cedula=c.cedula
          INNER JOIN color co ON v.idColor=co.idColor
          INNER JOIN generacion g ON v.idGeneracion=g.id
          INNER JOIN modelo mo ON g.idModelo=mo.idModelo
          INNER JOIN marca ma ON mo.idMarca=ma.idMarca where c.cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$cedula);
          $sql->execute();

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }
   }
   
?>