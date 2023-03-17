
<?php

require_once("../modelos/Usuarios.php");
require_once("../modelos/Fallas.php");

$fallas = new Fallas();

$falla = $fallas->get_fallas();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="panel panel-default"> 
    </div>

     
        <
        <section class="formulario-compra">
    
    <form method="post" class="form-horizontal" id="form_compra">
        <div class="container"> <!--container-->
            <div class="row pb-1 pt-3">
              <div class="col-lg-8">
                <h1 class="col-lg-8">Historial de fallas</h1>
              </div>
            </div>
           
                <hr>
                <!--FILA CLIENTE - COMPROBANTE DE PAGO pb-1 pt-3-->
            <h5><label for="" class="col-lg-1 control-label">Vehiculo</label></h5>
            
          <div class="row"> 
                

            <div class="col-lg-3">
              <label>Placa</label>
              <input type="text" name="placa" id="listaC" placeholder="placa" required pattern = "[0-9]{0,15}" class="form-control"></input>
            </div>
            <div class="col-lg-3">          
                <label>modelo</label>
                <textarea name="direccion" id="direccion" class="form-control" rows="1"></textarea>  
            </div>
            <div class="col-lg-3">          
                <label>Color</label>
                <input type="text" name="placa" id="placa" class="form-control" placeholder="Placa" ></input>  
            </div>
            
            <div class="col-lg-3">          
                <label>cliente</label>
                <input type="text" name="oentrega" id="oentrega" class="form-control" placeholder="O/E"></input>  
            </div>
            
             
          </div>  <!--fin row pb-1 pt-6-->
          <div class="row"> 
                
            <div class="col-lg-9">
              <label>Descripcion</label>          
              <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" required  class="form-control"></input>
            </div>
           
            <div class="col-lg-2 pl-5">
              <div class="btn-group text-center pt-4">
                <button id="btnAgregar" type="button" onClick="agregar_detalles(data=0)" class="btn btn-primary " with="200px" data-toggle="modal">Agregar detalle</i></button>
                <input type="hidden" name="iddetallesFT" id="iddetallesFT"/>
              </div>
            </div>
            
          </div>  
        </div>  <!--fin container--> 
           
              
            <!--formulario-pedido-->
          <div class="container"> <!--container-->
            <div class="row">
            

              <div class="col-md-11">
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
                    <table id="fallas" class="table table-striped nowrap" width="100%">
                      <thead>
                        <tr>
                          <th class="all text-center">Descripcion</th>                          
                          <th class="all">Feccha y Hora</th>
                          <th class="all">Estado</th>
                          <th class="min-desktop">Eliminar</th>
                        </tr>


                      </thead>
                      <tbody id="cuerpotabla">

                      </tbody>

                    </table>  
                  </div>
                
                  
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div>

              
                  
          </div>        
        </form>
      </section>
          <!--section formulario - pedido -->

    </section>
    <!-- /.content -->
  </div>
   


   

<script type="text/javascript" src="js/fallas.js"></script>



