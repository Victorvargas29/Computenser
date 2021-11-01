<?php

  //conexion a la base de datos

   require_once("../config/conexion.php");


   Class Presupuestos extends Conexion {

       //listar los usuarios
   	    public function get_presupuesto(){

   	    	$conectar=parent::conectar();
   	    //	parent::set_names();

   	    	$sql="select * from detallepresupuesto d inner join servicio s  on d.idServicio=s.idServicio";
           
   	    	$sql=$conectar->prepare($sql);
   	    	$sql->execute();

   	    	return $resultado=$sql->fetchAll();
   	    }

   	    public function agregar_detalle($idPresupuesto,$idServicio,$nombre_ser,$precio,$tasa,$descripcion,$cantidad,$idUsuario){

             $conectar=parent::conectar();
             //parent::set_names();
             $sql="insert into t_detallepresupuesto values(null,?,?,?,?,?,?,?,?);";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["idPresupuesto"]); 
             $sql->bindValue(2, $_POST["idServicio"]); 
             $sql->bindValue(3, $_POST["nombre_ser"]);
             $sql->bindValue(4, $_POST["precio"]);
             $sql->bindValue(5, $_POST["descripcion"]);
             $sql->bindValue(6, $_POST["tasa"]);
             $sql->bindValue(7, $_POST["cantidad"]);
             $sql->bindValue(8, $idUsuario); 
            // $sql->bindValue(4, $_POST["tasa"]);                   
             $sql->execute();
             //echo "se registro";
            // print_r($_POST);
   	    }
         public function registrar($idPresupuesto,$cedula,$moneda,$placa,$comboCedula){

          $conectar=parent::conectar();
          //parent::set_names();
          $sql="insert into presupuesto values(?,now(),?,'0',?);";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $_POST["idPresupuesto"]); 
          $sql->bindValue(2, $_POST["comboCedula"]."".$_POST["cedula"]); 
         
          $sql->bindValue(3, $_POST["placa"]); 
         
          ; 
         // $sql->bindValue(4, $_POST["tasa"]);                   
          $sql->execute();
          //echo detallesDetalles();
          //eliminar_temporal();
          echo $_POST["placa"];
         // print_r($_POST);
      }

          
          public function eliminar_temporal(){
            $conectar=parent::conectar();

          $sql="delete from t_detallepresupuesto";
          $sql=$conectar->prepare($sql);
          
          $sql->execute();
          return $resultado=$sql->fetch();

          }

          public function eliminar_temp_condicion($idUsuario){
            $conectar=parent::conectar();

          $sql="delete from t_detallepresupuesto where idUsuario=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();
          return $resultado=$sql->fetch();

          }

   	    public function editar_presupuesto($cedula, $nombre, $apellido,$direccion,$telefono){

             $conectar=parent::conectar();
            // parent::set_names();
             $sql="update presupuesto set nombre=?, apellido=?, direccion=?, telefono=? where cedula=?";
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

   	    public function get_presupuesto_por_id($cedula){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from presupuesto where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function eliminar_presupuesto($cedula){
          $conectar=parent::conectar();

          $sql="delete from presupuesto where cedula=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $cedula);
          $sql->execute();
          return $resultado=$sql->fetch();
        }

        public function detalles_presupuesto($idUsuario){
         
          $conectar=parent::conectar();
          $sql="select * from t_detallepresupuesto where idUsuario=?"; 
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();

          return $resultado=$sql->fetchAll();

        }
        public function presupuesto(){
         
          $conectar=parent::conectar();
   	    	

          $sql="select * from presupuesto"; 

          $sql=$conectar->prepare($sql);
          $sql->execute();

          return $resultado=$sql->fetchAll();

        }

        public function eliminar_item($id_tdetalle){
          $conectar=parent::conectar();

          $sql="delete from t_detallepresupuesto where id_tdetalle=?";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$id_tdetalle);
          $sql->execute();

          return $resultado=$sql->fetch();
        }


        public function datos_en_temporal(){
          $conectar=parent::conectar();
          //	parent::set_names();
        
            $sql="select idPresupuesto from t_detallepresupuesto";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function datos_en_temporal_idUsuario($idUsuario){
          $conectar=parent::conectar();
          //	parent::set_names();
        
            $sql="select idPresupuesto, idUsuario from t_detallepresupuesto where idUsuario=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $idUsuario);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function Max2(){
          $conectar=parent::conectar();
          //	parent::set_names();
            $sql="select MAX(idPresupuesto) from presupuesto";
            $sql=$conectar->prepare($sql);
            $sql->execute();
          // echo intval($sql);
            return $resultado=$sql->fetchAll();
        }

        public function Max(){
          $conectar=parent::conectar();
        //	parent::set_names();
          $sql="select idPresupuesto from presupuesto order by idPresupuesto asc";
          $sql=$conectar->prepare($sql);
          $sql->execute();
         // echo intval($sql);
          return $resultado=$sql->fetchAll();
        }

        public function detallesDetalles($idUsuario){

          $conectar=parent::conectar();
        //	parent::set_names();

          $sql="insert into detallepresupuesto (idPresupuesto, idServicio,precio,descripcion,tasa,cantidad) select idPresupuesto, idServicio,precio,descripcion,tasa,cantidad from t_detallepresupuesto where idUsuario=?";

          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idUsuario);
          $sql->execute();
         // echo intval($sql);

          return $resultado=$sql->fetchAll();
        }
        
        public function get_presupuesto_idPresupuesto($idPresupuesto){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from presupuesto where idPresupuesto=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idPresupuesto);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

         public function get_Presupuestos(){
          
          $conectar=parent::conectar();
          //parent::set_names();
          $sql = "select * from presupuesto AS f inner join cliente AS c ON f.cedula= c.cedula";
          $sql=$conectar->prepare($sql);
          $sql->execute();
          return $resultado=$sql->fetchAll();

   	    }

        public function get_detalles_Presupuesto($idPresupuesto){

          $conectar = parent::conectar();      
  
          $sql = "select f.idPresupuesto, f.tipo_moneda, f.placa, f.fecha, df.descripcion, s.Nombre, df.precio, df.tasa, df.cantidad,c.cedula,c.apellido, c.nombre, c.direccion,c.telefono from presupuesto AS f INNER JOIN cliente AS c ON f.cedula=c.cedula INNER JOIN detallepresupuesto df ON f.idPresupuesto=df.idPresupuesto JOIN servicio AS s on df.idServicio=s.idServicio WHERE f.idPresupuesto=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idPresupuesto);
          $sql->execute();
          //print_r($_POST);
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function cambiar_moneda($idPresupuesto,$tipo
        ){
          $conectar = parent::conectar(); 
          echo $_POST["tipo_moneda"];
            //el parametro est se envia por via ajax
   	    	if($_POST["tipo_moneda"]==0){
            $tipo=1;
          } else {
            $tipo=0;
          }
            $sql="update presupuesto set tipo_moneda=? where idPresupuesto=?";

          $sql=$conectar->prepare($sql);


         $sql->bindValue(1,$tipo);
         $sql->bindValue(2,$idPresupuesto);
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
        
        public function anular($idPresupuesto){
          $conectar = parent::conectar(); 

          $sql="update presupuesto set anulado=1 where idPresupuesto=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$idPresupuesto);
          $sql->execute();
        }
   }
   
?>