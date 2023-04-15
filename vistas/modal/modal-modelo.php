<!--Modal para CRUD-->
<div id="modeloModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="modelo_form">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar modelo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                  

                    <div class="form-group">
                        <label for="" class="col-lg-1 control-label">Marca</label>
                        <select class="form-control font-weight-bold" id="idMarca" name="idMarca">
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Nombre del modelo:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre"  required minlength="5" maxlength="40">
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idModelo" id="idModelo"/>
                    <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                    <button type="submit" name="action" id="btnGuardar" value="Add" aria-hidden="true" class="btn btn-dark">Guardar</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>  
