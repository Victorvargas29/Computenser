
<?php

require_once("../modelos/Usuarios.php");

require_once("../modelos/Empleadas.php");

$empleadas = new Empleadas();

$emp = $empleadas->get_empleada();

require_once("../modelos/Clientes.php");

$clientes = new clientes();

$cli = $clientes->get_Cliente();


    require_once("../modelos/Servicios.php");

    $servicios = new Servicio();

    $ser = $servicios->get_servicio();
       
       

   // if(isset($_SESSION["idUsuario"])){

   // }
    
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
 
    <!-- Content Header (Page header) -->
    
      <div class="row pb-1 pt-3">
        <div class="col-lg-6">

          <h1 class="col-lg-6 ml-3">
          Facturación
        </h1>

        </div>
        <div class="col-lg-3">
          
          
          
        </div>
        <div class="col-lg-3">
            <label>Tasa del dia</label>
            <input type="text" name="tasa" id="tasa" placeholder="Tasa del dia" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
            <br/>
          
          
        </div>
      </div>
      
   

    <!-- Main content -->
    <section class="content">

    <div class="panel panel-default">
        
        
      </div>

       <!--VISTA MODAL PARA AGREGAR CLIENTE-->
    <?php // require_once("modal/lista_clientes_modal.php");?>
    <!--VISTA MODAL PARA AGREGAR CLIENTE-->
    
     <!--VISTA MODAL PARA AGREGAR PRODUCTO    <?php // require_once("modal/lista_productos_ventas_modal.php");?>
-->


    <section class="formulario-compra">

    <form class="form-horizontal" id="form_compra">
    
    <!--FILA CLIENTE - COMPROBANTE DE PAGO-->
     <div class="row pb-1 pt-3">
     

          
        <div class="col-lg-6">
        <h4><label for="" class="col-lg-1 control-label">Cliente</label></h4>
        
        <br>
        <label>Cedula</label>
                    <input type="text" name="cedula" id="listaC" placeholder="Cédula" required pattern = "[0-9]{0,15}" class="form-control"></input>
                    <label>Nombres</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombres" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    

                    <label>Apellidos</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>

          
        </div>
        <!--fin col-lg-6-->
       
      <div class="col-lg-6">   
                   
                   <br><br>
                   <label class="pt-3">Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion"  class="form-control"></input>  

                    <label>Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required class="form-control"></input>
                
                    <label>Correo</label>
                    <input type="text" name="correo" id="correo" placeholder="Correo" required class="form-control"></input>
                    <br/>

                   
        </div>
     </div>
     <!--fin row-->
     <!--FILA- PRODUCTO-->
     <div class="row pt-3 pb-3">
                  <div class="col-lg-4">
                  <label for="" class="col-lg-1 control-label">Servicio</label>
                        <select class="form-control font-weight-bold" id="idServicio" name="idServicio">
                            <option class="font-weight-bold" value="0">Seleccione</option>

                            <?php
                           // $num=0;
                           for($i=0; $i<sizeof($ser);$i++){
                            // $num++;
                             ?>
                              <option value="<?php  echo $ser[$i]["idServicio"]?>">
                                <?php
                                   // echo $num;
                                    echo "• ";
                                    echo $ser[$i]["nombre"];
                                ?>
                              </option>
                        
                             <?php
                           }
                        ?>

                        </select>
                  </div>

                  <div class="col-lg-4">
                    <label> Precio</label>
                             
                        <input type="text" name="precio" id="precio" placeholder="Precio" required pattern = "[0-9]{0,15}" class="form-control"></input>
                        </div>
                <div class="col-lg-4">
                    <div class="">
                    <div class="btn-group text-center">
                    <button id="btnAgregar" type="button" onClick="cargarlistaS()" class="btn btn-success" data-toggle="modal">Agregar</button>
                    </div>
                   <!--  <h4 class="text-center"><strong>Tipo de Pago</strong></h4>
                    <select name="tipo_pago" class="col-lg-offset-3 col-xs-offset-2" id="tipo_pago" class="select" maxlength="10" >
                            <option value="">SELECCIONE TIPO DE PAGO</option>
                            <option value="CHEQUE">PAGAR CON CHEQUE</option>
                            <option value="EFECTIVO">PAGAR CON EFECTIVO</option>
                            <option value="TRANSFERENCIA">PAGAR CON TRANSFERENCIA</option>
                          </select>-->
                    </div>
                  </div>
         
     </div>
     <!--fin row-->
      

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      </form>
      <!--formulario-pedido-->
      <div class="row">
        <div class="col-lg-12">
          
          <div class="table-responsive">
            <div class="box-header">
              <h3 class="box-title">Lista de Ventas a Clientes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="detalles" class="table table-striped table-condensed table-bordered nowrap">
                <thead>
                 <tr>
                  
                  <th class="all">Item</th>
                  <th class="all text-center" width="35%">Concepto o Descripcion</th>
                  <th class="all">Precio Venta bs</th>
                  <th class="min-desktop">Precio Venta USD</th>
                  <th class="min-desktop">IVA 16%</th>
                  <th class="all">Total Bs</th>
                  <th class="min-desktop">Acciones</th>

                  </tr>
                </thead>
                  
                  <div id="resultados_ventas_ajax"></div>
                 

                 <tbody id="listProdVentas">
                  
                </tbody>


                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!--TABLA SUBTOTAL - TOTAL -->

       <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
           
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                <tr class="bg-success">
                  
 
                    <th class="col-lg-4">SUBTOTAL</th>
                   
                    <th class="col-lg-4">I.V.A%</th>
               
                    <th class="col-lg-4">TOTAL</th>
                     

                    
                </tr>
                </thead>


                <tbody>
                <tr class="bg-gray">
                    <!--<td></td>
                  <td></td>
                  <td></td>-->
                  <td class="col-lg-4"><h4 id="subtotal"> 0.00</h4><input type="hidden" name="subtotal_compra" id="subtotal_compra"></td>

                  <td class="col-lg-4"><h4>16%</h4><input type="hidden"></td>
                   <!--<td></td>-->
            <!--IMPORTANTE: hay que poner el name=total en el h4 para que lo pueda enviar, NO se envia si lo pones en el input hidden-->
          <td class="col-lg-4"><h4 id="total" name="total"> 0.00</h4><input type="hidden" name="total_compra" id="total_compra"></td>
                   <!--<td></td>-->
                   
           
                 </tr>

                  <tr>
                 

                  <input type="hidden" name="grabar" value="si">
                  <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["nombre"];?>"/>

                    <input type="hidden" name="id_cliente" id="id_cliente"/>
                   

                 </tr>
            </tbody>
           

              </table>
              
              <div class="boton_registrar">
                <button type="button" onClick="" class="btn btn-primary col-lg-offset-10 col-xs-offset-3 " id="btn_enviar"><i class="fa fa-save" aria-hidden="true"></i>  Registrar Venta</button>
              </div>

      </section>
      <!--section formulario - pedido -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


   

  <!--AJAX VENTAS-->
<script type="text/javascript" src="js/ventas.js"></script>



