<html>

<?php
    
  
    
    require_once("../modelos/Productos.php");
   /* require_once("../modelos/Inventario.php");
    $inventario = new Inventario();
    $inv=$inventario->get_inventarioDetalles($idInventario);*/
    $producto = new Producto();

    $pro = $producto->get_producto();
       
       
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
        <h2>INVENTARIO</h2>
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" onClick="limpiar()" class="btn btn-success" data-toggle="modal" data-target="#inventarioModal">Nuevo Inventario</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    
    <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">


          <!--  <div class="secciontogle" style="display: none;">   -->

            <?php require_once("modal/detalle_inventario.php");?>
       <!--          <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                            <div class="panel-body table-responsive">        
                                <table id="inventario_detalle" class="table table-striped table-condensed table-bordered" >
                                <thead class=" text-light" style="background-color: #0e9670;">
                                    <tr>
                                        <th>Id</th>
                                        <th>Inventario</th>
                                        <th>Fecha</th>
                                        
                                        <th>Cantidad antigua</th>
                                        
                                        <th>Estado del movimiento</th>
                                        <th>Movimiento</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody >
                                <tbody>
                                    <?php /*                           
                                    foreach($inv as $i) {                                                        
                                    ?>
                                    <tr>
                                        <td><?php echo $i['id'] ?></td>
                                        <td><?php echo $i['nombreP'].$i['cantidadP'] ?></td>
                                        <td><?php echo $i['fecha'] ?></td>
                                        <td><?php echo $i['cantidadantigua'] ?></td>   
                                        <td><?php echo $i['movimiento'] ?></td>  
                                        <td><?php echo $i['estado'] ?></td>  
                                        <td><?php echo $i['cantidadantigua'] ?></td>   
                                        <td></td>
                                    </tr>
                                    <?php
                                        }*/
                                    ?>                                
                        </tbody> 
                                    
                                </tbody>        
                            </table>                    
                            </div>
                        </div>
                        </div>
                </div> -->
            
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                        <div class="panel-body table-responsive">        
                            <table id="inventario_data" class="table table-striped table-condensed table-bordered nowrap" width="100%">
                            <thead class=" text-light" style="background-color: #0e9670;">
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Stock</th>
                                    
                                    <th width="10%">Estado</th>
                                    <th width="10%">Incluir</th>
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
      
<!--Modal para CRUD     -->
<div id="inventarioModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="inventario_form">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                  

                    <div class="form-group" id="formu">
                        <label for="" class="col-lg-1 control-label">Producto</label>
                        <select class="form-control font-weight-bold" id="idProducto" name="idProducto">
                            <option class="font-weight-bold" value="0">Seleccione</option>

                            <?php
                           // $num=0;
                           for($i=0; $i<sizeof($pro);$i++){
                           //  $num++;
                             ?>
                              <option value="<?php  echo $pro[$i]["idProducto"]?>">
                                <?php
                                  //  echo $num;
                                    echo "• ";
                                    echo $pro[$i]["nombre"];
                                ?>
                              </option>
                        
                             <?php
                          }
                        ?>

                        </select>
                        

                    
                    
                        <label class="col-form-label">Cantidad</label>
                        
                        <input type="text" class="form-control" name="cantidad" id="cantidad">
                     <br>
                     <div class="form-group" style="clear:both;"  id="formu">
                        <label class="invisible" id="la">Cantidad a ingresar</label>
                        <input type="hidden" class="form-control" name="cantidadN" id="cantidadN">
                        </div>
                     </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idInventario" id="idInventario"/>
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
         <script type="text/javascript" src="js/inventario2.js"></script> 
  
</html>