<!--
<?php 

   // require_once("../config/conexion.php");

    //if(isset($_SESSION["email"])){

 ?>

-->

<html>


    
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                 <h4 class="page-title">Listado de Usuarios</h4>
                <div class="ml-auto text-right">
                   
                </div>
            </div>
        </div>
    </div>
   
    <div class="container-fluid">
                
               

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
      
        </div>
           
<?php 
//ventana modal usuario
    require_once("modal/modal-usuario.php");
 ?>


<script src="js/usuario.js" type="text/javascript"></script>
<html>
<!--
 <?php 
 
 
?>
-->