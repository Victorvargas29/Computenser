
<?php

require_once("../modelos/Usuarios.php");
require_once("../modelos/ventas.php");
require_once("../modelos/Empleadas.php");

$empleadas = new Empleadas();
$venta = new Ventas();
$ven= $venta->detalles_venta();

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
  <!-- Main content -->
  <section class="content">
    <div class="panel panel-default"> 
    </div>

        <!--VISTA MODAL PARA AGREGAR CLIENTE-->
        <?php // require_once("modal/lista_clientes_modal.php");?>
        <!--VISTA MODAL PARA AGREGAR CLIENTE-->
        <!--VISTA MODAL PARA AGREGAR PRODUCTO -->    
        <?php // require_once("modal/lista_productos_ventas_modal.php");?>
    <section class="formulario-compra">
      <form method="post" class="form-horizontal" id="form_compra">
        <div class="container"> <!--container-->
            <div class="row pb-1 pt-3">
              <div class="col-lg-6">
                <h1 class="col-lg-6 ml-3">Facturación</h1>
              </div>
            </div>
            <div class="row"> 
              
              <div class="col-lg-2">
                <label>N° Control</label>
              
                        
                <input type="text" name="idFacturas" id="idFacturas"  disabled required pattern = "[0-9]{0,15}" class="form-control"></input>
                <br/>
              </div>
              
          
              <div class="col-lg-2"> 
                <label>Tasa del dia - DolarToday</label>
                <input type="text" name="tasa" id="tasa" placeholder="Tasa del dia" required pattern = "[0-9]{0,15}" class="form-control"></input>
                <br/>
              </div>
              <div class="col-lg-4">   
              <input type="hidden" name="idFactura" id="idFactura" required pattern = "[0-9]{0,15}" class="form-control"></input>
      
              </div>
              <div class="col-lg-4">        
              </div>

            </div><!-- /.row -->
                
                <!--FILA CLIENTE - COMPROBANTE DE PAGO pb-1 pt-3-->
            <h4><label for="" class="col-lg-1 control-label">Cliente</label></h4>
            
            <div class="row"> 
                  <div class="col-lg-3">
                    <label>Cedula</label>
                    <input type="text" name="cedula" id="listaC" placeholder="Cédula" required pattern = "[0-9]{0,15}" class="form-control"></input>
                  </div>
                  
                  <div class="col-lg-3">
                    <label>Nombres y Apellidos</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombres" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                  </div>

                  <!-- <div class="col-lg-3">
                    <label>Apellidos</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                  </div>
                  <div class="col-lg-3">
                    <label>Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required class="form-control"></input>
                  </div> -->
      
                </div>  <!--fin row pb-1 pt-6-->
                <br/>
            <!--   <div class="row">   
                  <div class="col-lg-6">          
                    <label>Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion"  class="form-control"></input>  
                  </div>
                  <div class="col-lg-6">
                    <label>Correo</label>
                    <input type="text" name="correo" id="correo" placeholder="Correo" required class="form-control"></input>
                  </div>    
                </div>  fin row 2 -->
                <br/>
                <!--FILA- PRODUCTO-->
                <div class="row pt-3 pb-3">
                    <div class="col-lg-5">
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
                    <div class="col-lg-2">
                    <label>Cantidad</label>          
                    <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" required pattern = "[0-9]" class="form-control"></input>
                    
                    <input type="hidden" name="nombre_ser" id="nombre_ser" placeholder="Cantidad" required pattern = "[0-9]" class="form-control"></input>
                    </div>
                    <div class="col-lg-2">
                      <label>Precio</label>
                              
                          <input type="text" name="precio" id="precio" placeholder="Precio" required pattern = "[0-9]{0,15}" class="form-control"></input>
                    </div>
                
                    <div class="col-lg-3">
                          <div class="btn-group text-center pt-4">
                            <button id="btnAgregar" type="button" onClick="cargarlistaS()" class="btn btn-primary " data-toggle="modal">Agregar</button>
                            <input type="hidden" name="iddetallesFT" id="iddetallesFT"/>
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
            </div>  <!--fin container--> 
          
            <!--formulario-pedido-->
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
                                  <table id="detalles_ventas" class="table table-striped nowrap" width="100%">
                                    <thead>
                                      <tr>
                                        <th class="min-desktop">Eliminar</th>
                                        <th class="all text-center">Concepto o Descripcion</th>
                                        <th class="min-desktop">USD $</th>
                                        <th class="all">Precio Venta Bs.</th>
                                        <th class="min-desktop">IVA 16%</th>
                                        <th class="all">Cantidad</th>
                                        <th class="all">Total Bs</th>
                                        <th class="all">Total $</th>
                                      </tr>


                                    </thead>
                                    <tbody>

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
          
            <div class="col-lg-4">            
            </div>
            <div class="col-lg-4">            
            </div> 
            
            <div class="col-lg-4">
                <div class="box ml-5">
                  <div class="box-body">
                    <table class="table table-striped">
                      <thead>
                        <tr class="bg-success">
                        <th class="col-lg-3">Monedas</th>
                          <th class="col-lg-3">SUBTOTAL</th>           
                          <th class="col-lg-3">I.V.A%</th>
                          <th class="col-lg-3">TOTAL</th>     
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          $total1=0;
                          $totalBs=0;
                          $iva=0;
                          $ivaBs=0;
                          $pagototal;
                          $pagototalBS;
                          for($i=0; $i<sizeof($ven);$i++){
                            // $num++;
                            ?>
                            <?php
                              $total1= $total1 + ($ven[$i]["precioTemp"]*$ven[$i]["cantidad"]);
                              $totalBs= $totalBs + (($ven[$i]["precioTemp"]*$ven[$i]["cantidad"])*$ven[$i]["cantidad"]);
                                  
                                ?>
                              </option>
                        
                            <?php
                          }
                          $iva= $total1*0.16;
                          $ivaBs=$totalBs*0.16;
                          $pagototalBs=$ivaBs+$totalBs;
                          $pagototal=$iva+$total1;
                        ?>
                        <tr class="bg-gray">
                          <!--<td></td>
                          <td></td>
                          <td></td>-->
                          <td class="col-lg-4"><h4 id="subtotal">Dolares $$</h4><input type="hidden" name="subtotal_compra" id="subtotal_compra"></td>
                          <td class="col-lg-4"><h4 id="subtotal"><?php echo $total1;?>$</h4><input type="hidden" name="subtotal_compra" id="subtotal_compra"></td>
                          <td class="col-lg-4"><h4><?php echo $iva;?>$</h4><input type="hidden"></td>
                          <!--<td></td>-->
                          <!--IMPORTANTE: hay que poner el name=total en el h4 para que lo pueda enviar, NO se envia si lo pones en el input hidden-->
                          <td class="col-lg-4"><h4 id="total" name="total"> <?php echo $pagototal;?>$</h4><input type="hidden" name="total_compra" id="total_compra"></td>
                          <!--<td></td>-->
                        </tr>
                        <tr class="bg-gray">
                          <!--<td></td>
                          <td></td>
                          <td></td>-->
                          <td class="col-lg-4"><h4 id="subtotal">Bolivares BsS</h4><input type="hidden" name="subtotal_compra" id="subtotal_compra"></td>
                          <td class="col-lg-4"><h4 id="subtotal"><?php echo $totalBs;?>BsS</h4><input type="hidden" name="subtotal_compra" id="subtotal_compra"></td>
                          <td class="col-lg-4"><h4><?php echo $ivaBs;?>BsS</h4><input type="hidden"></td>
                          <!--<td></td>-->
                          <!--IMPORTANTE: hay que poner el name=total en el h4 para que lo pueda enviar, NO se envia si lo pones en el input hidden-->
                          <td class="col-lg-4"><h4 id="total" name="total"> <?php echo $pagototalBs;?>BsS</h4><input type="hidden" name="total_compra" id="total_compra"></td>
                          <!--<td></td>-->
                        </tr>
                        <tr>
                        </tr>
                      </tbody>
                    </table>
                    <div class="boton_registrar">
                      <button type="button" class="btn btn-primary col-lg-offset-10 col-xs-offset-3 " onClick="registrar()"  id="btn_enviar"><i class="fa fa-save" aria-hidden="true"></i>  Registrar Venta</button>
                    </div>
                  </div> <!-- /.box-body -->
                </div> <!-- /.box -->            
              </div> <!-- /.col -->
          </div>
        </form>
      </section>
          <!--section formulario - pedido -->

    </section>
    <!-- /.content -->
  </div>
   


   

  <!--AJAX VENTAS-->
<script type="text/javascript" src="js/ventas.js"></script>



