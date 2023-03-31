<html>

<?php
    
   // require_once("../../config/conexion.php");
    
    require_once("../modelos/Modelo.php");
    require_once("../modelos/Productos.php");
    

    $lineas= new producto();
    $linea = $lineas->get_lineas();

    $modelos = new Modelos();
    $modelo = $modelos->get_filas_modelo();
       
       
?>
  
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                   
                </div>
            </div>
        </div>
    </div>
  
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
                        <label class="col-form-label">Nombre del Producto:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        <label class="col-form-label">Precio del Producto:</label>
                        <input type="text" class="form-control" name="precio" id="precio">
                        <label class="col-form-label">Cantidad:</label>
                        <input type="text" class="form-control mb-2" name="cantidadP" id="cantidadP">
                        <div class="container border mt-3">
                        <label class="mt-1">Vehiculo:</label>
                                <select class="form-control font-weight-bold mt-2" id="idModelo" name="idModelo">
                                    
                                    <option class="font-weight-bold" value="0">Seleccione el Modelo</option>

                                    <?php
                                    
                                        for($i=0; $i<sizeof($modelo);$i++){
                                    
                                        ?>
                                        <option value="<?php  echo $modelo[$i]["idModelo"]?>">
                                        <?php
                                            
                                            echo "• ";
                                            echo $modelo[$i]["nombre"];
                                        ?>
                                        </option>
                                
                                        <?php
                                    }
                                ?>
                                </select>

                                
                                <select class="form-control font-weight-bold mt-2" id="idGeneracion" name="idGeneracion">
                                <option class="font-weight-bold" value="0">Seleccione generacion</option>
                                </select>
                               
                                <select class="form-control font-weight-bold mt-2 mb-3" id="idLinea" name="idLinea">
                                <option class="font-weight-bold" value="0">Seleccione la linea del Repuesto</option>

                                    <?php
                                    // $num=0;
                                    for($i=0; $i<sizeof($linea);$i++){
                                    // $num++;
                                        ?>
                                        <option value="<?php  echo $linea[$i]["id"]?>">
                                        <?php
                                            // echo $num;
                                            echo "• ";
                                            echo $linea[$i]["nombre"];
                                        ?>
                                        </option>
                                
                                        <?php
                                    }
                                ?>

                            </select>
                        </div>
                            

                       

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
      
  
         <script type="text/javascript" src="js/producto.js"></script> 
  
</html>
