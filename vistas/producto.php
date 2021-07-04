<html>

<?php
    
   // require_once("../../config/conexion.php");
    
    require_once("../modelos/Departamentos.php");
    require_once("../modelos/PresentacionP.php");
    $prese= new PresentacionP();
    $p=$prese->get_presentacionP();


    $departamento = new Departamentos();

    $dep = $departamento->get_departamento();
       
       
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
        <h4>Productos</h4>
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#productoModal">Nuevo producto</button>    
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
                        <table id="producto_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                        <thead class=" text-light" style="background-color: #0e9670;">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>cantidad</th>
                                

                                
                                <th>Departamento</th>
                     
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
<div id="productoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="producto_form">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                  

                    <div class="form-group">

                        <input type="date" name="">

                        <label class="col-form-label">Nombre del Producto:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        
                        <label for="" class="col-lg-1 control-label">Departamento</label>
                        <select class="form-control font-weight-bold" id="idDepartamento" name="idDepartamento">
                            
                            <option class="font-weight-bold" value="0">Seleccione</option>

                            <?php
                           
                                for($i=0; $i<sizeof($dep);$i++){
                           
                             ?>
                                <option value="<?php  echo $dep[$i]["idDepartamento"]?>">
                                <?php
                                   
                                    echo "• ";
                                    echo $dep[$i]["nombre"];
                                ?>
                              </option>
                        
                             <?php
                           }
                        ?>
                        </select>

                        <label class="col-form-label">Cantidad:</label>
                        <input type="text" class="form-control" name="cantidadP" id="cantidadP" style="width:50%">

                        <select class="form-control font-weight-bold" id="idPresentacionP" name="idPresentacionP" style="width:40%">
                        <option class="font-weight-bold" value="0">Seleccione</option>

                            <?php
                           // $num=0;
                           for($i=0; $i<sizeof($p);$i++){
                            // $num++;
                             ?>
                              <option value="<?php  echo $p[$i]["idPresentacionP"]?>">
                                <?php
                                   // echo $num;
                                    echo "• ";
                                    echo $p[$i]["nombre"];
                                ?>
                              </option>
                        
                             <?php
                           }
                        ?>

                        </select>

                    </div>

                    

                </div>
                
                <div class="modal-footer">
                    <input type="hidden" name="idProducto" id="idProducto"/>
                    <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
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
         <script type="text/javascript" src="js/producto.js"></script> 
  
</html>
