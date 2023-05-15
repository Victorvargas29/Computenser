  <!--Formulario Ventana Modal-->
<div id="empleadaModal" class="modal fade"> <!--El id sera el mismo q colocamos en el data-target del boton q llama al modal-->
    <div class="modal-dialog">
        <form method="post" id="empleada_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Empleada</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-body">
                
                    <label>Cedula</label>
                    <input type="text" name="cedula" id="cedula" placeholder="Cédula" required pattern = "[0-9]{0,15}" class="form-control"></input>
                    <br/>

                    <label>Nombres</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombres" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>
                    <label>Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required pattern = "[0-9]{0,15}" class="form-control"></input>
                    <br/>

                    <label>Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion"  class="form-control"></input>
                    <br/>


                </div>
 
                <div class="modal-footer">
                   <input type="hidden" name="idEmpleada" id="idEmpleada"/>

                    <button type="submit" name="action" id="btnGuardar" value="Add" 
                    class="btn btn-success pull-left"><i class="fa fa-floppy-o" aria-hidden="true">
                    </i>Guardar</button>

                    <button type="button" onClick="limpiar()" value="Add" 
                    class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true">
                    </i>Cerrar</button>

                </div>

            </div>

        </form>

    </div>

  </div>