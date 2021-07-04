


   <div class="modal fade" id="Modal_detalle">
          <div class="modal-dialog">
           <!--tamanoModal antes tenia un class="modal-content" y lo cambié por bg-warning para que tuviera fondo blanco, deberia haber sido un color naranja claro pero me salió un color blanco de casualidad--> 
            <div class="modal-content tamanoModal">
              <div class="modal-header">
                
                <h4 class="modal-title"><i class="fa fa-user-circle" aria-hidden="true"></i> DETALLE DE INVENTARIO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">

                <div class="container box">
        
                <!--column-12 -->
                <div class="table-responsive">
                 
                     <div class="box-body">

               
                        <table id="detalle_inventario" class="table table-striped table-bordered table-condensed table-hover">

                          <thead style="background-color:#A9D0F5">
                            <tr>
                              <th>Id</th>
                              <th>Producto</th>
                              <th>Stock</th>
                          
                            </tr>
                          </thead>

                          <tbody>
                            
                            <td>
                              <h4 id="invent"></h4>
                              <input type="hidden" name="invent" id="invent">
                            </td>

                            <td>
                              <h4 id="nombreP"></h4>
                              <input type="hidden" name="nombreP" id="nombreP">
                            </td>

                            <td>
                              <h4 id="cantidad2"></h4>
                              <input type="hidden" name="cantidad2" id="cantidad2">
                            </td>
 
                         

                          </tbody>
                        </table>



                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    
                                    <th>Id</th> 
                                    <th>Fecha</th>   
                                    <th>Cantidad Antigua</th>
                                    <th>Estado</th>
                                    <th>Movimiento</th>
                                    <th>Total</th> 
                                </thead>
                              
                                           
                            </table>
                          </div>

                         
            </div>
            <!-- /.box-body -->

              <!--BOTON CERRAR DE LA VENTANA MODAL-->
             <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                
              </div>
              <!--modal-footer-->
          <!--</div>-->
          <!-- /.box -->

        </div>
        <!--/.col (12) -->
      </div>
      <!-- /.row -->
       
     
              </div>
              <!--modal body-->
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

     

    

        
  