
<?php

require_once("../modelos/Usuarios.php");
require_once("../modelos/compras.php");
require_once("../modelos/Empleadas.php");

$empleadas = new Empleadas();
$compra = new Compras();
//$ven= $compra->detalles_compra($_SESSION["idUsuario"]);

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
        <?php // require_once("modal/lista_productos_compras_modal.php");?>
        <section class="formulario-compra">
    
    <form action="http://computenser.test/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_compra">
    <!--  <form action="http://merilara.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_compra">    
      <form action="http://demos.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_compra">-->
        <div class="container"> <!--container-->
            <div class="row pb-1 pt-3">
              <div class="col-lg-6">
                <h1 class="col-lg-6 ml-3">Compra</h1>
              </div>
            </div>
            <div class="row"> 
              
              <div class="col-lg-2">
                <label>N° compra</label>
                 <h3 id="idCompras"></h3>       
              <!--   <input type="text" name="idCompras" id="idCompras"  disabled required pattern = "[0-9]{0,15}" class="form-control"></input>
                -->
                <br/>
              </div>
              
              <div class="col-lg-2"> 
                <label>Tasa del dia - DolarToday</label>
                <input type="text" name="tasa" id="tasa" placeholder="Tasa del dia" required pattern = "^[0-9]+([.][0-99]+)?$" class="form-control"></input>
                <br/>
              </div>
              <div class="col-lg-4">   
              <input type="hidden" name="idCompras" id="idCompras" required pattern = "[0-9]{0,15}" class="form-control"></input>
              <div class="col-lg-2">
              </div>
              </div>
              <div class="col-lg-2 pt-4">  
              <button type="button" class="btn btn-primary" id="listaCompras"><i class="" aria-hidden="true"></i> Ver Compras</button>      
              </div>

            </div><!-- /.row -->
                <hr>
                <!--FILA Proveedor pb-1 pt-3-->
            <h5><label for="" class="col-lg-1 control-label">Proveedor</label></h5>
            
            <div class="row"> 
                 <div class="col-lg-1 pt-2">
                    <label></label>
                    <select class="form-control font-weight-bold" id="comboCedula" name="comboCedula" required>
                        <option class="font-weight-bold" value="V-">V-</option>
                        <option class="font-weight-bold" value="J-">J-</option>
                        <option class="font-weight-bold" value="E-">E-</option>
                        <option class="font-weight-bold" value="C-">C-</option>
                        <option class="font-weight-bold" value="G-">G-</option>
                            
                      </select>
                  </div>

                  <div class="col-lg-2">
                    <label>Cedula / RIF</label>
                    <input type="text" name="cedula" id="listaC" placeholder="Cédula" required pattern = "[0-9]{0,15}" class="form-control"></input>
                  </div>
                  
                  <div class="col-lg-4">
                    <label>Nombres o Razón Social</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombres" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                  </div>

                  <!-- <div class="col-lg-3">
                    <label>Apellidos</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                  </div>    -->
                  <div class="col-lg-2">
                    <label>Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" class="form-control"></input>
                  </div>
              
                  <div class="col-lg-2 pt-4">  
                    <button type="button" class="btn btn-primary" id="newProveedor"><i class="" aria-hidden="true"></i>Ir a Proveedor</button>      
                  </div>
      
                  <br/>
                  
                    
              </div><!--fin row pb-1 pt-6-->
                <div class="row pt-2">
                  <div class="col-lg-11">          
                      <label>Direccion</label>
                      <textarea name="direccion" id="direccion" class="form-control" rows="1"></textarea>  
                  </div>
                
               
              	</div>  <!--fin row pb-1 pt-6-->
            

            
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

                <hr>
                <!--FILA- PRODUCTO-->
                <h5><label for="" class="col-lg-4 control-label">Agregar Productos</label></h5>
                <div class="row pt-4 pb-2">
                    <div class="col-lg-5">
                    <label>Productos</label> 
                        <select class="form-control font-weight-bold" id="idProducto" name="idProducto" required>
                            <option class="font-weight-bold" value="0">Seleccione el producto</option>
                            <?php
                          // $num=0;
                          for($i=0; $i<sizeof($prod);$i++){
                            // $num++;
                            ?>
                              <option value="<?php  echo $prod[$i]["idProducto"]?>">
                                <?php
                                  // echo $num;
                                    echo "• ";
                                    echo $prod[$i]["nombre"];
                                ?>
                              </option>
                        
                            <?php
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                    <label>Cantidad</label>          
                    <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" required pattern = "[0-9]*" class="form-control"></input>
                    
                    <input type="hidden" name="nombre_ser" id="nombre_ser" placeholder="nombre servicio" required pattern = "[0-9]" class="form-control"></input>
                    </div>
                    <div class="col-lg-2">
                      <label>Precio $</label>
                              
                          <input type="text" name="precio" id="precio" placeholder="Precio" required pattern = "[0-9]{0.99}" class="form-control"></input>
                    </div>               
                </div>      
                
                
                
             

             <div class="row pt-3 pb-3">

                    
                    <div class="col-lg-9">
                    <label>Descripcion</label>          
                    <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" required  class="form-control"></input>
                    
                    </div>
                    
                
                    <div class="col-lg-3">
                          <div class="btn-group text-center pt-4">
                            <button id="btnAgregar" type="button" onClick="agregar_detalles()" class="btn btn-primary " data-toggle="modal">Agregar detalle</i></button>
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

         

                <hr>
              </div>  <!--fin container--> 
            <div class="container">
              <div class="row">
                <div class="col-lg-3 pt-4">
                  <label>Seleccione modena:</label>      
                </div>   
                <div class="col-lg-2 pt-4">
                  <input type="radio" id="dol" name="moneda" value="1" checked>
                  <label for="dol">Reporte en $</label>
                </div>
                <div class="col-lg-2 pt-4">
                  <input type="radio" id="bs" name="moneda" value="0">
                  <label for="bs">Reporte en Bs.</label>
                </div>
              </div>
            </div>
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
                                  <table id="detalles_compras" class="table table-striped nowrap" width="100%">
                                    <thead>
                                      <tr>
                                        <th class="min-desktop">Eliminar</th>
                                        <th class="all text-center">Concepto o Descripcion</th>
                                        <th class="min-desktop">USD $</th>
                                        <th class="all">Precio compra Bs.</th>
                                        <!-- <th class="min-desktop">IVA 16%</th> -->
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
                      <button type="submit" class="btn btn-primary col-lg-offset-10 col-xs-offset-3 "  id="btn_enviar"><i class="" aria-hidden="true"></i>Registrar Compra</button>
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
   


   

  <!--AJAX compraS-->
<script type="text/javascript" src="js/compras.js"></script>


