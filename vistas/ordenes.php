
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
      

 
    
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    
    <section class="formulario-orden">
    
          <!-- <form method="post" id="form_orden">
          <form action="http://merilara.computenser.com/report/facturaPdf.php" target="_blank" method="post" class="form-horizontal" id="form_orden">  -->
        <form action="http://teg.test/report/ordenPdf.php" target="_blank" method="post" class="form-horizontal" id="form_orden" onsubmit="registrar(event, this)">
          <div class="container"> <!--container-->  
          
            <div class="row pb-1 pt-3">
              <div class="col-lg-6">
                <h1 class="ml-3">Orden</h1>
              </div>
              <div class="col-lg-3">

              </div>
              <div class="col-lg-3">  
                  <h4 class="ml-1" id="ordenH3" name="ordenH3"></h4>
                  <input type="hidden" name="numDoc" id="numDoc" class="form-control"></input>

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
                      <select class="form-control font-weight-bold" title="Seleccione el cliente" placeholder="Descripcion" data-width="26rem" required data-live-search="true" data-tokens id="cedula" name="cedula">                        
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
                      <select class="form-control font-weight-bold"  data-width="26rem" title="Ingrese la placa" required data-live-search="true" data-tokens id="idVehiculo" name="idVehiculo">
                        <option value=""  selected disabled>Ingrese la placa </option>
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
                        <select class="form-control font-weight-bold" data-width="61rem" title="Seleccione el Servicio" id="idServicio" name="idServicio">
                          <option selected disabled value="">Seleccione el Servicio</option>

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
                          <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" class="form-control ml-3"></input>
                        </div>
                      </div>
                    </div>
                    
                
                    <div class="col-lg-2">
                          <div class="btn-group text-center">
                            <button id="btnAgregar" type="button" onClick="agregar_detalles()" class="btn btn-primary "  style="width:7.5rem" data-toggle="modal">Agregar </i></button>
                            <input type="hidden" name="iddetallesFT" id="iddetallesFT"/>
                          </div>
                      
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
                                  <th class="all">Precio</th>
                                  <th class="all">Empleado</th>
                                  <th class="min-desktop">Eliminar</th>
                                </tr>


                              </thead>
                              <tbody id="cuerpotabla">

                              </tbody>

                            </table>  
                            <div class="boton_registrar">
                              <button type="button" onClick="cancelarOrden()" class="btn btn-light m-2">Cancelar</button>

                              <button type="submit" class="btn btn-primary col-lg-offset-10 col-xs-offset-3 m-2"  id="btn_enviar"><i class="" aria-hidden="true"></i>Registrar Orden</button>
                            </div>
                        </div>
                        
                          <!--Fin centro -->
                    </div><!-- /.box -->
                  </div><!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
          </div>  <!--container--> 
        </form> 
        

         
          
           


        <div id="empleadaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <form method="post" id="emleado_form">   
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Agregar empleado al servicio</h5>
                          <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  
                      <div  class="modal-body">
                          <div class="form-group">
                          <div class="row">
                            <div class="col-10">
                              <select class="form-control font-weight-bold border" title="Seleccione el Empleado" id="idEmpleada" name="idEmpleada" required>
                                <option selected disabled value="0">Seleccione el Empleado</option>
                              </select>
                              <input type="hidden" name="idser" id="idser"/>
                            </div>
                            
                            <div class="col-2 pr-0">
                              <button type="button" id="btnGuardar" onClick="agregar_empleadas()" value="Add" aria-hidden="true" class="btn btn-dark pr-2">Agregar</button>

                            </div>
                          </div>
                            
                          </div>       

                          <div class="panel-body table-responsive">
                            <table id="detalles_ordenes" class="table table-striped nowrap mr-2" width="90%">
                              <thead>
                                <tr>
    
                                  <th class="min-desktop">Cedula</th>
                                  <th class="all">Nombre</th>
                                  <th class="all">Eliminar</th>
                                  
                                </tr>


                              </thead>
                              <tbody id="cuerpotablaE">

                              </tbody>

                            </table>  
                          </div>  
                        </div>
                      <div class="modal-footer">
                          
                          <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cerrar</button>
                          
                          
                      </div>
                    </div>
                </form>
          </div>
        </div> 

     
    </section>
          <!--section formulario - pedido -->

  </section>
    <!-- /.content -->
</div>
   


   

  <!--AJAX ordeneS-->
<script type="text/javascript" src="js/ordenes.js"></script>



