



<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <section class="formulario-ventas">
    
          <form method="post" class="form-horizontal" id="form_ventas">
            <!--  <form action="http://merilara.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_compra">    
            <form action="http://demos.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_compra">-->
              <div class="container"> <!--container-->
                  <div class="row pb-1 pt-3">
                    <div class="col-lg-6">
                      <h1 class="col-lg-6 ml-3">Facturación</h1>
                    </div>
                  </div>
                  <div class="row"> 
                  <div class="row"> 
                    
                    <div class="row">               
                      <div class="col">
                        <div class="row">               
                            <div class="col-lg-2 ">
                              <label class="col-form-label ml-4">Cedula:</label>
                            </div>
                            <div class="col-lg-10">

                              <select class="form-control font-weight-bold" placeholder="Descripcion" data-width="26rem" required data-live-search="true" data-tokens id="cedula" name="cedula">
                              
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
                              <select class="form-control font-weight-bold"  data-width="26rem" required data-live-search="true" data-tokens id="idVehiculo" name="idVehiculo">
                              <option value=""  selected disabled>Ingrese la placa </option>
                            </select>
                          </div>
                        </div>
                      </div>
                  </div>  
                </div>
              
                <div class="container">

                      <div class="row pb-1 pt-3">
                        <h3 class="col-lg-6">ORDENES</h3>
                      </div>
                  

                    <div class="row pt-4 pb-2">
                        <div class="col-lg-1 ">
                          <label class="col-form-label">Ordenes:</label>
                        </div>
                        <div class="col-lg-11">
                          <select class="form-control font-weight-bold" data-width="61rem"  id="idOrden" name="idOrden" required>
                            <option selected disabled value="">Seleccione la ORDEN</option>

                          </select>
                          <input type="hidden" name="orden" id="orden"   class="form-control"></input>
                        </div>   
                    </div>   
                </div><!-- /.container -->



              
                <div class="container"><!-- /.container -->
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
                                      <th class="all text-center">Concepto o Descripcion</th>
                                      <th class="min-desktop">USD $</th>
                                      <th class="all">Precio Bs.</th>
                                      <!-- <th class="min-desktop">IVA 16%</th> -->
                                      
                                
                                    </tr>


                                  </thead>
                                  <tbody id="cuerpotabla">

                                  </tbody>

                                </table>  
                            </div>
                      
                        <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.container --> 

                  <!--TABLA SUBTOTAL - TOTAL -->
                <div class="container"><!-- /.container -->
                  <div class="row">
                
                    
                    <div class="col-lg-3 pt-5 mt-5"> 
                        <label class="col-form-label ml-3">Tasa del Día:</label>
                        <input type="text" name="tasa" id="tasa" placeholder="Tasa" class="form-control"></input>

                    </div>
                    <div class="col-lg-1">  
                    <input type="text" name="idFactura" id="idFactura" placeholder="idFactura" class="form-control"></input>

                    </div> 
                  
                    <div class="col-lg-8">
                      <div class="box lg-6">
                          <div class="panel-body table-responsive">
                            
                              <table  id="ta" class="table table-striped nowrap" width="100%" id="sub">
                                <thead>
                                  <tr class="bg-success">
                                    <!-- <th class="col-lg-1">SUBTOTAL $</th> -->
                                    <th class="col-lg-3">SUBTOTAL $$</th> 
                                    <th class="col-lg-3">TOTAL $$</th> 

                                    <th class="col-lg-3">SUBTOTAL Bs</th>           
                                    <!-- <th class="col-lg-2">DESCUENTO %</th> -->
                                    <th class="col-lg-2">I.V.A 16%</th> 
                                    <!-- <th class="col-lg-2">TOTAL $</th> -->
                                    <th class="col-lg-2">TOTAL</th>     
                                  </tr>
                                </thead>
                                <tbody id="subTotales">
                                
                                  
                                </tbody>
                              </table>
                            <div class="boton_registrar">

                              <button type="submit" class="btn btn-primary col-lg-offset-10 col-xs-offset-3 "  id="btn_enviar"><i class="" aria-hidden="true"></i>Registrar Factura</button>
                          
                            </div>
                      
                          </div> <!-- /.box-body -->
                        </div> <!-- /.box -->            
                    </div> <!-- /col-lg-8 -->
                  </div><!-- /.container -->
              </div><!-- /container-lg-5 -->
          </form>
            
    </section>           <!--section formulario ventas-->

  </section><!-- /. section content -->
    
</div><!-- /.content-wrapper -->
   


   

  <!--AJAX VENTAS-->
<script type="text/javascript" src="js/ventas.js"></script>



