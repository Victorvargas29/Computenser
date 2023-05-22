<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");
   require_once("../modelos/Bitacora.php");

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
          $sql->bindValue(1, '0'); 
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
   	    	

          $sql = "select o.numDoc, o.placa, o.estatus, o.fecha,
          c.cedula, c.nombre AS cliente_nom, c.apellido,  c.direccion, c.telefono,
          v.placa, v.cedula, v.idColor, v.anno, v.idModelo,
          mo.idModelo, mo.nombre as modelo_nom, mo.idMarca,
          ma.idMarca, ma.nombre as marca_nom,
          co.idColor, co.nombre AS color_nom
          from orden o
          JOIN vehiculo v ON v.placa=o.placa
          INNER JOIN cliente c ON v.cedula=c.cedula
          INNER JOIN  modelo mo ON v.idModelo=mo.idModelo
          INNER JOIN marca ma ON ma.idMarca=mo.idMarca
          INNER JOIN color co ON co.idColor=v.idColor"; 

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

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
          $sql1="insert into empleadoservicios values(null,?,?);";
          $sql1=$conectar->prepare($sql1);
        
          $sql1->bindValue(1, $arregloEmpleada["empleada"]); 
          $sql1->bindValue(2, $arregloEmpleada["ordenServicio"]); 
                         
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
          INNER JOIN modelo mo ON v.idModelo=mo.idModelo
          INNER JOIN marca ma ON mo.idMarca=ma.idMarca where c.cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$cedula);
          $sql->execute();

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        
        public function get_ordenVehiculo($idVehiculo){
          $conectar = parent::conectar();
          parent::set_names();
          $sql = "select * from orden where placa=? and estatus='0'";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$idVehiculo);
          $sql->execute();

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function get_sumaPrecioDetalle($nunDoc){
          $conectar = parent::conectar();
          parent::set_names();
          $sql = "select SUM(precio)precio from ordenservicios where numDoc=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$nunDoc);
          $sql->execute();

          return $resultado= $sql->fetch(PDO::FETCH_ASSOC);
        }
        public function mostrarDetalles($nunDoc){
          $conectar = parent::conectar();
          parent::set_names();
          $sql = "select * from ordenservicios as o inner join servicio as s on s.codeServicio=o.codeServicio where numDoc=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$nunDoc);
          $sql->execute();

          return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function reporte_orden($numDoc){

          $conectar = parent::conectar();      

          $sql = "select o.numDoc, o.placa, o.estatus, o.fecha,
          c.cedula, c.nombre AS cliente_nom, c.apellido,  c.direccion, c.telefono,
          v.placa, v.cedula, v.idColor, v.anno, v.idModelo,
          mo.idModelo, mo.nombre as modelo_nom, mo.idMarca,
          ma.idMarca, ma.nombre as marca_nom,
          co.idColor, co.nombre AS color_nom
          from orden o
          JOIN vehiculo v ON v.placa=o.placa
          INNER JOIN cliente c ON v.cedula=c.cedula
          INNER JOIN  modelo mo ON v.idModelo=mo.idModelo
          INNER JOIN marca ma ON ma.idMarca=mo.idMarca
          INNER JOIN color co ON co.idColor=v.idColor
          WHERE o.numDoc=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $numDoc);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function detalles_reporte_orden($numDoc){

          $conectar = parent::conectar();      
 /*   INNER JOIN empleadoservicios es ON os.ordenServicio=es.ordenServicio
          INNER JOIN empleada e ON es.cedula=e.cedula */
          $sql = "select os.ordenServicio, os.codeServicio, os.descripcion, os.precio,
          s.codeServicio, s.nombre as servicio_n
          from ordenservicios os     
          INNER JOIN servicio s ON os.codeServicio=s.codeServicio
          WHERE os.numDoc=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $numDoc);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function cambiarEstado($idOrden){
          $conectar = parent::conectar(); 

          $sql="update orden set estatus='1' where numDoc=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$idOrden);
          $sql->execute();
          echo $idOrden;
        }

        public function Max(){
          $conectar=parent::conectar();
          //	parent::set_names();
            $sql="select MAX(numDoc)numDoc from orden";
            $sql=$conectar->prepare($sql);
            $sql->execute();
          // echo intval($sql);
          return $resultado= $sql->fetch(PDO::FETCH_ASSOC);
        }
        
   }
   
?>