
<html>

<?php
    
   // require_once("../../config/conexion.php");
    
  //  require_once("../modelos/Categorias.php");

 /*   $categoria = new Categoria();

    $cat = $categoria->get_categoria();
       */
       
?>
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
      
    <div class="container">
        <h4>Servicios</h4>
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#servicioModal">Nueva Servicio</button>    
            </div>    
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
                        <table id="servicio_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                        <thead class=" text-light" style="background-color: #0e9670;">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                               
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
<div id="servicioModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="servicio_form">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Servicio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Nombre de Servicio:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"  required minlength="5" maxlength="40" >
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" id="precio" required>
                    </div> 

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idServicio" id="idServicio"/>
                    <button type="button" class="btn btn-light" onClick="limpiar()" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                    <button type="submit" name="action" id="btnGuardar" value="Add" aria-hidden="true" class="btn btn-dark">Guardar</button>
                    
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
         <script type="text/javascript" src="js/servicio.js"></script> 
  
</html>
