<html>

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <!--
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                    -->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <h4>Vehiculos</h4>

        <div class="row">
            <div class="col-lg-12">            
                <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#vehiculoModal">Nuevo Vehiculo</button>    
            </div>    
        </div>    
       
    <br>  
    <div class="content-wrapper">        
        <!-- Main content -->
            <section class="content">
   
        <div class="row">
                <div class="col-md-12">
                    <div class="box">
                    <div class="panel-body table-responsive">        
                        <table id="vehiculo_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                        <thead class=" text-light" style="background-color: #0e9670;">
                            <tr>
                                <th>Cliente</th>
                                <th>Vehiculo</th>
                     			<th>Placa</th>
                                <th>Color</th>
                                <th>Año</th>
                                <th width="10%">Editar</th>
                                <th width="10%">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody >
                              
                        </tbody>        
                       </table>                    
                    </div>
                </div>
                </div>
        </div>  
    </section>
    </div>    
      
<!--Modal para CRUD-->
<div id="vehiculoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="vehiculo_form">   
            <div class="modal-content">
               
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Vehiculo</h5>
                    <button type="button" onClick="limpiar()" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                    <label class="col-form-label">Cedula:</label>
              <div class="row">           
                        
                    <div class="col-lg-12">
                        <select class="form-control font-weight-bold" data-live-search="true" data-tokens id="cedula" name="cedula">
                        </select>
                    </div>
                </div> <!-- fin row -->
                
                                   
                    <label class="col-form-label">Placa:</label>
                    <input type="text" class="form-control" name="placa" id="placa" required>
                  
                    <div class="form-group">
                        <label for="" class="col-lg-1 control-label">Marca</label>
                        <select class="form-control font-weight-bold" id="idMarca" name="idMarca" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-lg-1 control-label">Modelo</label>
                        <select class="form-control font-weight-bold" id="idModelo" name="idModelo" required>
                        </select>
                    </div>
                                        
                    <label class="col-form-label">Año:</label>
                    <input type="text" class="form-control" name="año" id="año" required>
                    
                    <div class="form-group"> 
                        <label for="" class="col-lg-1 control-label">Color</label>
                        <select class="form-control font-weight-bold" id="idColor" name="idColor" required>
                        </select>
                    </div>

                   
                    
                    
        
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" onClick="limpiar()" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                    <button type="submit" name="action" id="btnGuardar" value="Add" aria-hidden="true" class="btn btn-dark" >Guardar</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>  
</div>  <!-- container-fluid-->
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <!-- <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <datatables JS 
    <script type="text/javascript" src="datatables/datatables.min.js"></script>     -->
         <script type="text/javascript" src="js/vehiculo.js"></script> 
  
</html>