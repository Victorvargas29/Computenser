
<html>

<?php
    
   // require_once("../../config/conexion.php");
    
/*    require_once("../modelos/Departamentos.php");

    $departamento = new Departamentos();

    $dep = $departamento->get_departamento();*/
       
       
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
        <h4>Modelos</h4>
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#modeloModal">Nuevo Modelo</button>    
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
                        <table id="modelo_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                        <thead class=" text-light" style="background-color: #0e9670;">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th width="10%">Generacion</th>
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

    <?php 
    //ventana modal modelo
    require_once("modal/modal-modelo.php");
    //ventana modal generacion vehiculo
    require_once("modal/modal-generacion.php");
    ?>      

</div>  <!-- container-fluid-->

<script type="text/javascript" src="js/modelo.js"></script> 
  
</html>
