
<?php

require_once("../modelos/Usuarios.php");
require_once("../modelos/ordenes.php");
require_once("../modelos/Empleadas.php");

$empleadas = new Empleadas();
$orden = new Ordenes();
//$ven= $orden->detalles_orden($_SESSION["idUsuario"]);

$emp = $empleadas->get_empleada();

require_once("../modelos/Clientes.php");

$clientes = new clientes();

$cli = $clientes->get_Cliente();


    require_once("../modelos/Productos.php");

    $productos = new Producto();

    $prod = $productos->get_producto();
       
       

   // if(isset($_SESSION["idUsuario"])){

   // }
    
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="panel panel-default"> 
    </div>

        <!--VISTA MODAL PARA AGREGAR CLIENTE-->
        <?php // require_once("modal/lista_clientes_modal.php");?>
        <!--VISTA MODAL PARA AGREGAR CLIENTE-->
        <!--VISTA MODAL PARA AGREGAR PRODUCTO -->    
        <?php // require_once("modal/lista_productos_ordenes_modal.php");?>
        <section class="formulario-orden">
    
    <form action="http://computenser.test/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_orden">
    <!--  <form action="http://merilara.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_orden">    
      <form action="http://demos.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_orden">-->
        <div class="container"> <!--container-->
            <div class="row pb-1 pt-3">
              <div class="col-lg-6">
                <h1 class="col-lg-6 ml-3">Orden</h1>
              </div>
            </div>
            <div class="row"> 
              
              <div class="row">               
                <div class="col">
                  <div class="row">               
                      <div class="col-lg-2 ">
                        <label class="col-form-label ml-4">Cedula:</label>
                      </div>
                      <div class="col-lg-10">

                        <select class="form-control font-weight-bold" data-width="26rem" data-live-search="true" data-tokens id="cedula" name="cedula">
                        </select>
                      </div>
                    </div>
                  </div>
                <div class="col">
                  <div class="row">               
                    <div class="col-lg-2">
                      <label class="col-form-label ml-3">Vehiculo:</label>
                    </div>
                    <div class="col-lg-10">
                        <select class="form-control font-weight-bold"  data-width="26rem" data-live-search="true" data-tokens id="idVehiculo" name="idVehiculo">
                        <option value="0"  selected disabled>Ingrese la placa </option>
                      </select>
                    </div>
                  </div>
                </div>
            </div>        
  
            <div class="container">

                  <div class="row pb-1 pt-3">
                    <h3 class="col-lg-6">Servicios</h3>
                  </div>
              

                <div class="row pt-4 pb-2">
                  
                  
                    <div class="col-lg-1 ">
                      <label class="col-form-label">Servicios:</label>
                    </div>
                    <div class="col-lg-11">
                      <select class="form-control font-weight-bold" data-width="61rem"  id="idServicio" name="idServicio" required>
                        <option selected disabled value="0">Seleccione el Servicio</option>

                      </select>
                        <input type="hidden" name="nombreServi" id="nombreServi"   class="form-control"></input>
                        <input type="hidden" name="precio" id="precio"   class="form-control"></input>

                    </div>   
                </div>   
                    
                    
                  
                 
                
              <div class="row pt-4 pb-2">                    
                  <div class="col-lg-10">
                    <div class="row">
                      <div class="col-lg-1 ">
                        <label class="col-form-label">Descripcion:</label>
                      </div>
                      <div class="col-lg-11">        
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" required  class="form-control ml-3"></input>
                      </div>
                    </div>
                  </div>
                  
              
                  <div class="col-lg-2">
                        <div class="btn-group text-center">
                          <button id="btnAgregar" type="button" onClick="agregar_detalles()" class="btn btn-primary "  style="width:7.5rem" data-toggle="modal">Agregar </i></button>
                          <input type="hidden" name="iddetallesFT" id="iddetallesFT"/>
                        </div>
                    <!--  <h4 class="text-center"><strong>Tipo de Pago</strong></h4>
                      <select name="tipo_pago" class="col-lg-offset-3 col-xs-offset-2" id="tipo_pago" class="select" maxlength="10" >
                              <option value="">SELECCIONE TIPO DE PAGO</option>
                              <option value="CHEQUE">PAGAR CON CHEQUE</option>
                              <option value="EFECTIVO">PAGAR CON EFECTIVO</option>
                              <option value="TRANSFERENCIA">PAGAR CON TRANSFERENCIA</option>
                            </select>-->
                      <!-- <i class="fas fa-cart-plus">  -->
                  </div>      
              </div>  

         

           
            <div class="row">
              <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">
                        <!-- <button class="btn btn-primary" id="add_button" onClick="limpiar()" data-toggle="modal" data-target="#usuarioModal"><i class="fa fa-plus" aria-hidde="true"></i> Nuevo Usuario</button></h1> -->
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro width="35%"-->
                    <div class="panel-body table-responsive">
                        <table id="detalles_ordenes" class="table table-striped nowrap mr-2" width="90%">
                          <thead>
                            <tr>
                              
                              <th class="all text-center">Concepto o Descripcion</th>
                              
                              <th class="min-desktop">Servicio</th>
                              
                              <!-- <th class="min-desktop">IVA 16%</th> -->
                              <th class="all">Empleado</th>
                              <th class="all">Precio</th>
                              <th class="min-desktop">Eliminar</th>
                            </tr>


                          </thead>
                          <tbody id="cuerpotabla">

                          </tbody>

                        </table>  
                    </div>
                    
                      <!--Fin centro -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div>
            <!-- /.row -->

            <!--TABLA SUBTOTAL - TOTAL -->

            <div class="row">
          
            <div class="col-lg-1">            
              </div>
              <div class="col-lg-3 pt-5 mt-5"> 

                  <input type="text" name="campo" id="campo" placeholder="000" class="form-control"></input>

              </div>
              <div class="col-lg-1">            
              </div> 
            
              <div class="col-lg-5">
                  <div class="box lg-6">
                    <div class="panel-body table-responsive">
                      
                        <table class="table table-striped nowrap" width="100%" id="sub">
                          <thead>
                            <tr class="bg-success">
                              <!-- <th class="col-lg-1">SUBTOTAL $</th> -->
                              <th class="col-lg-3">SUBTOTAL BsS</th>           
                              <!-- <th class="col-lg-2">DESCUENTO %</th> -->
                              <th class="col-lg-2">I.V.A 16%</th> 
                              <!-- <th class="col-lg-2">TOTAL $</th> -->
                              <th class="col-lg-2">TOTAL</th>     
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                      <div class="boton_registrar">
                      <button type="submit" class="btn btn-primary col-lg-offset-10 col-xs-offset-3 "  id="btn_enviar"><i class="" aria-hidden="true"></i>Registrar Orden</button>
                        <!-- <a class="btn btn-primary col-lg-offset-10 col-xs-offset-3" href="http://computenser.test/computenser/report/crearPdf2.php" target="_blank"  id="bt"><i class="fa fa-save" aria-hidden="true"></i></a> -->
                    <!--   <button type="button" onClick="borrar_temporal()" value="Add" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true">
                      </i>Cancelar</button> -->
                      <!-- <input type="hidden" name="idUser" id="idUser" value="" required pattern = "[0-9]{0,15}" class="form-control"><?php echo $_SESSION["idUsuario"]
                              ?></input>  -->
                    </div>
                  
                    </div> <!-- /.box-body -->
                </div> <!-- /.box -->            
              </div> <!-- /.col -->
              <div class="col-lg-1">            
            </div> 
          </div>
        </form>
      </section>
          <!--section formulario - pedido -->

    </section>
    <!-- /.content -->
  </div>
   


   

  <!--AJAX ordeneS-->
<script type="text/javascript" src="js/ordenes.js"></script>



