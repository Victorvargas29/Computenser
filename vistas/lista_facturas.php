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
            <h4>Consultar Facturas</h4>    
            </div>   
            <div class="col-lg-4">
<!--                 <h3>
                <?php

             /*        require_once("../modelos/ventas.php");
                    $venta = new Ventas();

                    $tipo = $venta->consulta_estado(); */
                        
                    ?>
                    <input type="button" id="estado" name="estado" onClick="cambiar_moneda('<?php //echo $tipo[0]["tipo"]?>')" label="Moneda">
               
                </h3> -->
            </div>
           
        </div>  
       
    <!--         <div class="container">
            <div class="row">
                <div class="col-lg-12">            
                <button id="btnReporte" type="button" onClick="" class="btn btn-success" data-toggle="modal" data-target="#ConsultaReporteModal">Buscar Factura</button>    
                </div>    
            </div>    
        </div>   -->  
        <br>  
        <div class="content-wrapper">        
            <!-- Main content -->
            <section class="content">
        
            
                <!--
                <div class="row pt-2 pb-2">
                    <div class="col-lg-3">
                        <label>Seleccione modena:</label>      
                    </div>   
                    <div class="col-lg-2">
                        <input type="radio" id="dol" name="moneda" value="dol" checked>
                        <label for="dol">Reporte en $</label>
                    </div>
                    <div class="col-lg-2">
                        <input type="radio" id="bs" name="moneda" value="bs">
                        <label for="bs">Reporte en Bs.</label>
                    </div>
                </div>   -->
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="panel-body table-responsive">   
                                <form action="" target="" method="post" class="form-horizontal" id="form_lista">     
                                    <table id="factura_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                                        <thead class="text-light" style="background-color: #0e9670;">
                                            <tr>
                                                <th width="10%">Nro Factura</th>
                                                <th>Cliente</th>
                                                <th width="20%">Cedula</th>
                                                <th width="10%">Tipo Moneda</th>
                                                <th width="10%">Ver Factura</th>
                                                <th width="10%">Anular</th>
                                            </tr>
                                        </thead>
                                        <tbody >       
                                        </tbody>      
                                    </table>  
                                    </form>              
                                </div>
                            </div>
                        </div>
                    </div>  
                
            </section>
        </div>    
      
        <!--Modal para CRUD-->
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
        </div>  
</div>  <!-- container-fluid-->
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <!-- <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <datatables JS 
    <script type="text/javascript" src="datatables/datatables.min.js"></script>     -->
         <script type="text/javascript" src="js/ventas.js"></script> 
  
</html>