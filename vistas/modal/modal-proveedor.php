<!--Modal para CRUD-->
<div id="clienteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="cliente_form">   
            <div class="modal-content">
               
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Proveedor</h5>
                    <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                    <label class="col-form-label">RIF:</label>
              <div class="row">
                  
                  <div class="col-lg-2">
                    
                    <select class="form-control font-weight-bold" id="comboRif" name="comboRif" required>
                        <option class="font-weight-bold" value="V-">V-</option>
                        <option class="font-weight-bold" value="J-">J-</option>
                        <option class="font-weight-bold" value="E-">E-</option>
                        <option class="font-weight-bold" value="C-">C-</option>
                        <option class="font-weight-bold" value="G-">G-</option>   
                    </select>
                  </div>

                  
                        
                    <div class="col-lg-10">
                    <input type="text" class="form-control" name="rifS" id="rifS">
                    </div>
                </div> <!-- fin row -->

                    
                    <input type="hidden" class="form-control" name="rif" id="rif">
                  
               
      
          

                    
                    <label class="col-form-label">Razon Social:</label>
                    <input type="text" class="form-control" name="nombreP" id="nombreP">
                    
                    <label class="col-form-label">Direcccion:</label>
                    <textarea class="form-control" name="direccion" id="direccion" rows="2"></textarea>

                    <label class="col-form-label">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono">

                    <label class="col-form-label">Correo:</label>
                    <input type="text" class="form-control" name="correo" id="correo">
        
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                    <button type="submit" name="action" id="btnGuardar" value="Add" aria-hidden="true" class="btn btn-dark" >Guardar</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>  <!-- end modal-->
