<html>

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
      <div class="row pb-1 pt-3">
        <div class="col-lg-8">
          <h1 class="col-lg-8">Historial de fallas</h1>
        </div>
      </div>
      <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#fallaModal">Nueva Falla</button>    
            </div>    
        </div>    
      </div>  
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
                  <table id="fallas_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                    <thead class=" text-light" style="background-color: #0e9670;">
                      <tr>
                        <th class="all text-center">Placa</th>                          
                        <th class="all text-center">Descripcion</th>                          
                        <th class="all">Feccha y Hora</th>
                        <th class="all">Estado</th>
                        <th class="all">Vehiculo</th>
                        <th class="min-desktop">Editar</th>
                      </tr>
                    </thead>
                    <tbody >

                    </tbody>

                  </table>  
                </div>
              
                
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>

              
                  
      </div>

    </section>


    <div id="fallaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" class="form-horizontal" id="falla_form">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Falla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        
            <div class="modal-body">
              <h5><label for="" class="col-lg-1 control-label">Vehiculo</label></h5>
              
              <div class="row"> 
                <div class="col-lg-6">
                  <label>Placa</label>
                  <select class="form-control font-weight-bold" data-live-search="true" data-tokens id="idVehiculo" name="idVehiculo">
                  </select>
                </div>
              
                <div class="col-lg-6">          
                    <label>modelo</label>
                    <input name="modelo1" id="modelo1" class="form-control" placeholder="Modelo" readonly></input>  
                </div>
              </div>
              <div class="row"> 
                <div class="col-lg-6">          
                    <label>Color</label>
                    <input type="text" name="color1" id="color1" class="form-control" placeholder="Color" readonly ></input>  
                </div>
              
                <div class="col-lg-6">          
                    <label>cliente</label>
                    <input type="text" name="cliente" id="cliente" class="form-control" placeholder="Cliente" readonly></input>  
                </div>
              </div>
                
                
               <!--fin row pb-1 pt-6-->
              <div class="row"> 
                    
                <div class="col-lg-12">
                  <label>Descripcion</label>          
                  <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" required  class="form-control"></input>
                </div>        
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idFalla" id="idFalla"/>
                <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                <button type="submit" name="action" id="btnGuardar" value="Add" aria-hidden="true" class="btn btn-dark">Guardar</button>
                
            </div>
          </div>
        </form>
          </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="js/fallas.js"></script>
</html>

