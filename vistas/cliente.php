<html>

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4>Clientes</h4>
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
        <div class="row">
            <div class="col-lg-12">            
                <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#clienteModal">Nuevo Cliente</button>    
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
                        <table id="cliente_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                        <thead class=" text-light" style="background-color: #0e9670;">
                            <tr>
                                <th>Cedula</th>
                                <th>Nombre</th>
                     			<th>Apellido</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Correo</th>
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
<div id="clienteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="cliente_form">   
            <div class="modal-content">
               
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Cliente</h5>
                    <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                    <label class="col-form-label">Cedula:</label>
              <div class="row">
                  
                  <div class="col-lg-2">
                    
                    <select class="form-control font-weight-bold" id="comboCedula" name="comboCedula" required>
                        <option class="font-weight-bold" value="V-">V-</option>
                        <option class="font-weight-bold" value="J-">J-</option>
                        <option class="font-weight-bold" value="E-">E-</option>
                        <option class="font-weight-bold" value="C-">C-</option>
                        <option class="font-weight-bold" value="G-">G-</option>   
                    </select>
                  </div>

                  
                        
                    <div class="col-lg-10">
                    <input type="number" class="form-control" name="cedulaS" id="cedulaS"  required minlength="5" maxlength="8">
                    </div>
                </div> <!-- fin row -->

                    
                    <input type="hidden" class="form-control" name="cedula" id="cedula">
                  
               
      
          

                    
                    <label class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"  required minlength="5" maxlength="40">
                    
                    <label class="col-form-label">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido"  required minlength="5" maxlength="40">
                    
                    <label class="col-form-label">Direcccion:</label>
                    <textarea class="form-control" name="direccion" id="direccion" rows="2"></textarea>

                    <label class="col-form-label">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">

                    <label class="col-form-label">Correo:</label>
                    <input type="email" class="form-control" name="correo" id="correo"  required minlength="2" maxlength="40">
        
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
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
         <script type="text/javascript" src="js/cliente.js"></script> 
  
</html>