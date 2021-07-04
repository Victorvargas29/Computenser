<!--
<?php 

   // require_once("../config/conexion.php");

    //if(isset($_SESSION["email"])){

 ?>

-->

<html>


    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                 <h4 class="page-title">Listado de Usuarios</h4>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
      <!--  <div class="content-wrapper">        
         Main content 
            <section class="content">    -->

            <!-- resultados 
                <div id="resultados_ajax">
                </div>     -->
               

                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">
                                <button class="btn btn-primary" id="add_button" onClick="limpiar()" data-toggle="modal" data-target="#usuarioModal"><i class="fa fa-plus" aria-hidde="true"></i> Nuevo Usuario</button></h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive">
                                <table id="usuario_data" class="table table-striped nowrap" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Id</th>
                                      <th>Nombres</th>
                                      <th>Apellidos</th>

                                      <th>Cargo</th>
                    
                                      <th>Correo</th>
   
                                      <th>Estado</th>
                                      <th width="10%">Editar</th>
                                      <th width="10%">Eliminar</th>
                                      <th>Avatar</th>

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
        <!--    </section> /.content -->

     <!--   </div> /.content-wrapper -->
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
<?php 
//ventana modal usuario
    require_once("modal/modal-usuario.php");
 ?>


<script src="js/usuario.js" type="text/javascript"></script>
<html>
<!--
 <?php 
 
  //  }//fin de la condicion de sesion
  //  else{
   //     header("Location:".Conexion::ruta()."vistas/index.php");
    //    exit();
 //   }

?>
-->