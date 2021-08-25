
<!--Formulario Ventana Modal-->
<div id="usuarioModal" class="modal fade"> <!--El id sera el mismo q colocamos en el data-target del boton q llama al modal-->
    <div class="modal-dialog">
        <form method="post" id="usuario_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="btn btn-danger close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-body">
                

                    <label>Nombres</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>

                    <label>Apellidos</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>

                    <label>Cargo</label>
                    <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                        <option value="">-- Selecciona Cargo --</option>
                        <option value="1" selected>Administrador</option>
                        <option value="0">Empleado</option>
                    </select>
                    <br/>

                    <label>Password</label>
                    <input type="text" name="password1" id="password1" placeholder="Password" class="form-control" required></input>
                    <br/>

                    <label>Repita Password</label>
                    <input type="text" name="password2" id="password2" placeholder="Repita Password" class="form-control" required></input>
                    <br/>


                    <label>Correo</label>
                    <input type="email" name="email" id="email" placeholder="Correo" required="required" class="form-control"></input>
                    <br/>


                    <label>Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                      <option value="">-- Selecciona Estado --</option>
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                    <br/>

                    <label>Foto Perfil</label>
                    <input type="file" id="avatar" name="avatar">
                    <span id="producto_uploaded_image"></span>
                    <br/>

                </div> <!-- Fin modal body -->
 
                <div class="modal-footer">
                    <input type="hidden" name="idUsuario" id="idUsuario"/>

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
