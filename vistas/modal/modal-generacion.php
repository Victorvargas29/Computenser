<!--Modal para CRUD-->
<div id="generacionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="generacion_form">   
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Generacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
             
                <div class="modal-body">
                  


                    <div class="form-group">
                      <!--  <input type="text" class="form-control" name="idModelo" id="idModelo">
                         <label class="col-form-label" id="name_modelo" name="name_modelo"></label> -->
                        <input type="text" class="form-control" name="nombreM" id="nombreM" >
                        <input type="text" class="form-control" name="Modelo" id="Modelo" >
                       
                    </div>
                    
                    <div class="form-group">
                        
                        <label for="" class="col-lg-1 control-label">Rango Generación</label>
                        <select class="form-control font-weight-bold" id="idInicio" name="idInicio">
                        </select>
                        <select class="form-control font-weight-bold" id="idFin" name="idFin">
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" aria-hidden="true" data-dismiss="modal" value="Add">Cancelar</button>
                    <button type="submit" name="action" id="btnG" value="Add" aria-hidden="true" class="btn btn-dark">Guardar</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>  
