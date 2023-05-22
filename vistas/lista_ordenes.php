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
        <div class="row pt-2 pb-2">
            <div class="col-lg-3">
                <h4>Consultar Ordenes</h4>    
            </div>   
            <div class="col-lg-4">
            </div> 
        </div>   
    </div>
    <div id="content_grafic" class="shadow-lg p-3 mb-5 bg-white">

    </div>

        <br>  
        <div class="content-wrapper">        
            <!-- Main content -->
            <section class="content">
        
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="panel-body table-responsive">   
                               <!--  <form action="" target="" method="post" class="form-horizontal" id="form_orden">  -->    
                                    <table id="orden_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                                        <thead class="text-light" style="background-color: #0e9670;">
                                            <tr>
                                                <th width="10%">Nro Orden</th>
                                                <th width="10%">Placa</th>
                                                <th width="10%">Estado</th>
                                                <th width="10%">Ver Orden</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody >       
                                        </tbody>      
                                    </table>  
                              <!--       </form>  -->             
                                </div>
                            </div>
                        </div>
                    </div>  
                
            </section>
        </div>    
      
        <!--Modal para CRUD
        <div id="ConsultaReporteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" id="reporte_form">   
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Consulta de Factura</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Nro de Factura:</label>
                                <input type="text" class="form-control" name="NroFactura" id="NroFactura">
                            </div>         
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                            <button type="submit" name="action" id="ConsultaReporte" value="Add" aria-hidden="true" class="btn btn-dark">Consultar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>  -->
</div>  <!-- container-fluid-->
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <!-- <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <datatables JS 
    <script type="text/javascript" src="datatables/datatables.min.js"></script>     -->
         <script type="text/javascript" src="js/ordenes.js"></script> 
  
</html>