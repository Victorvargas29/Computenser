<?php 
	require_once("../config/conexion.php");

	Class Inventario extends Conexion{

		public function get_filas_inventario(){
			$conectar= parent::conectar();
           
            $sql="select * from inventario";
             
            $sql=$conectar->prepare($sql);

            $sql->execute();

            $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

            return $sql->rowCount();
		}

		public function get_inventario(){

        	$conectar = parent::conectar();
       
       		$sql = "select i.idInventario, i.cantidad, p.nombre as nombreP, p.cantidadP, pp.nombre as nombrePP from inventario i INNER JOIN producto p ON i.idProducto=p.idProducto INNER JOIN presentacionproducto pp ON p.idPresentacionP=pp.idPresentacionP";

        	$sql=$conectar->prepare($sql);

        	$sql->execute();

        	return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        }
/** listar detalles del inventario 
 * 
 * DETALLES INVENTARIO
 * 
*/

    public function get_detalles_inventario($idInventario){

    $conectar = parent::conectar();

 /*   $sql = "select i.idInventario, i.cantidad, p.nombre from inventario i INNER JOIN producto p ON i.idProducto=p.idProducto where i.idInventario=?";*/

 $sql = "select i.idInventario, i.cantidad as cantidad2, p.nombre as nombreP, p.cantidadP, pp.nombre as presentacion from inventario as i, producto as p, presentacionproducto as pp where i.idProducto=p.idProducto and p.idPresentacionP=pp.idPresentacionP and i.idInventario=?";



/* $sql = "select idInventario, cantidad as cantidad2 from inventario where idInventario=?";
*/
// p.cantidadP, pp.nombre as nombrePP
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $idInventario);
        $sql->execute();
        //print_r($_POST);
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }

        public function get_inventarioDetalles($idInventario){

        	$conectar = parent::conectar();
       
       /*		$sql = "select d.idDetallesI, d.estado, d.cantidadantigua, d.movimiento from detallesinventario d INNER JOIN inventario i on d.idInventario=i.idInventario INNER JOIN producto p ON i.idProducto=p.idProducto where d.idInventario=?";*/

       $sql = "select d.idDetalles, d.fecha, d.estado, d.cantidadantigua, d.movimiento from detallesinventario as d, inventario as i, producto as p where d.idInventario=i.idInventario and i.idProducto=p.idProducto and d.idInventario=?";


/*
        $sql = "select d.idDetallesI,d.fecha,d.estado,d.movimiento, d.cantidadantigua, p.nombre as nombreP, p.cantidadP, pp.nombre as nombrePP from detallesinventario d INNER JOIN inventario i on d.idInventario=i.idInventario INNER JOIN producto p ON i.idProducto=p.idProducto INNER JOIN presentacionproducto pp ON p.idPresentacionP=pp.idPresentacionP where d.idInventario=?";
        */


        	$sql=$conectar->prepare($sql);
            $sql->bindValue(1,$idInventario);
        	$sql->execute();
           // print_r($_POST);
        	 $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    
    $html= "  <thead style='background-color:#A9D0F5'>

                                    <th>Id</th> 
                                    <th>Fecha</th>   
                                    <th>Cantidad Antigua</th>
                                    <th>Estado</th>
                                    <th>Movimiento</th>
                                    <th>Total</th> 
                                </thead>


                              ";

           

              foreach($resultado as $row)
        {
            $total = $row['cantidadantigua']+$row['movimiento'];
         
        $html.="<tr><td>".$row['idDetalles']."</td> <td>".$row['fecha']."</td> <td>".$row['cantidadantigua']."</td><td> ".$row['estado']."</td> <td>".$row['movimiento']."</td> <td> ".$total."</td> </tr>";

        }
 /*$html.= "<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                     <p>SUB-TOTAL</p>
                                     <p>IVA(20%)</p>
                                     <p >TOTAL</p>
                                    </th>
                                    <th>

                                    <p><strong>60</strong></p>

                                     <p><strong>78</strong></p>

                                     <p><strong>60</strong></p>

                                    </th> 
                                </tfoot>";*/
      
      echo $html;


        }


        public function registrar_inventarioDetalles($cantidad,$cantidadN,$idInventario){
        	$conectar = parent::conectar();

        	$sql="insert into inventarioDetalles values(null,now(),?,?,?,'Mas');";
            $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["idInventario"]);
             $sql->bindValue(2, $_POST["cantidad"]);
             $sql->bindValue(3, $_POST["cantidadN"]);
           
            
			$sql->execute();
        }






        public function registrar_inventario($cantidad,$idProducto){
        	$conectar = parent::conectar();

        	$sql="insert into inventario values(null,?,?);";
            $sql=$conectar->prepare($sql);
        	$sql->bindValue(1, $_POST["cantidad"]);
            $sql->bindValue(2, $_POST["idProducto"]);
            
			$sql->execute();
        }
        

        public function get_inventario_por_id($idInventario){

        	$conectar=parent::conectar();
          //parent::set_names();
          $sql="select * from inventario where idInventario=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1, $idInventario);
          $sql->execute();
          return $resultado=$sql->fetchAll();
        }

        public function editar_inventario($idInventario,$cantidad,$idProducto){

             $conectar=parent::conectar();
    
             $sql="update inventario set cantidad=?, idProducto=? where idInventario=?";
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $_POST["cantidad"]);
             $sql->bindValue(2, $_POST["idProducto"]);
             $sql->bindValue(3, $_POST["idInventario"]);
             $sql->execute();
   	    }

   	    public function eliminar_inventario($idInventario){
        
	        $conectar=parent::conectar();

	        $sql="delete from inventario where idInventario=?";
	        $sql=$conectar->prepare($sql);
	        $sql->bindValue(1, $idInventario);
	        $sql->execute();
	        return $resultado=$sql->fetch();
        }

	}// fin class Inventario


 ?>