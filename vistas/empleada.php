<html>

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
            <h4>Listado de Empleados</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li> -->
                        </ol>
                    </nav>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
    
        
            <div class="row">
                <div class="col-lg-12">
            <button class="btn btn-primary" id="add_button" onClick="limpiar()" data-toggle="modal" data-target="#empleadaModal"><i class="fa fa-plus" aria-hidde="true"></i> Nueva Empleada</button>
            </div>
            </div>
  
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">        
        <!-- Main content -->
            <section class="content">
            <!-- resultado 
                <div id="resultados_ajax">
                </div>-->
                

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                         
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive">
                                <table id="empleada_data" class="table table-bordered table-striped nowrap" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Cédula</th>
                                      <th>Nombres</th>
                                      <th>Telefono</th>
                                      <th>Dirección</th>
                                      <th width="10%">Editar</th>
                                      <th width="10%">Eliminar</th>

                                    </tr>


                                  </thead>
                                  <tbody>

                                  </tbody>

                                </table>  
                            </div>
                      
                        <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
        </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->

<?php   require_once("modal/modal-empleada.php");    ?>

<script src="js/empleada.js" type="text/javascript"></script>

</html>

