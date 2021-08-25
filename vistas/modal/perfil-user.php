
<!--Formulario Ventana Modal-->
<div id="perfilModal" class="modal fade"> <!--El id sera el mismo q colocamos en el data-target del boton q llama al modal-->
    <div class="modal-dialog">
        <form method="post" id="perfil_form">
            <div class="modal-content tamanoModal-perfil">
                <div class="modal-header">
                    <h4 class="modal-title">Perfil de Usuario</h4>
                    <button type="button" class="btn btn-danger close" data-dismiss="modal">&times;</button>
                   
                </div>
                <div class="modal-body">
                
                    <div class="text-center">
                        <label class="">Foto Perfil</label> <br/>
                      <!--   <input type="file" id="avatar_perfil" name="avatar_perfil">
     -->
                        <span id="producto_uploaded_perfil"></span>
                        <br/>
                    </div>

                    <div class="text-right">
                        <button type="button" id="perfil_editar" onClick="habilitar_campos()" title="Editar datos básicos"
                        class="btn btn-primary bg-cyan"><i class="fa fa-edit" aria-hidden="true">
                        </i></button>
                    </div>

                    <label>Nombres</label>
                    <input type="text" name="nombre_perfil" id="nombre_perfil" placeholder="Nombre" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>

                    <label>Apellidos</label>
                    <input type="text" name="apellido_perfil" id="apellido_perfil" placeholder="Apellido" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>

                    <label>Cargo</label>
                    <select class="form-control" id="tipo_usuario_perfil" name="tipo_usuario_perfil" required>
                        <option value="">-- Selecciona Cargo --</option>
                        <option value="1" selected>Administrador</option>
                        <option value="0">Empleado</option>
                    </select>
                    <br/>

                    <label>Correo</label>
                    <input type="email" name="email_perfil" id="email_perfil" placeholder="Correo" required="required" class="form-control"></input>
                    <br/>

                    <label>Estado</label>
                    <select class="form-control" id="estado_perfil" name="estado_perfil" required>
                      <option value="">-- Selecciona Estado --</option>
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                    <br/>

                </div> <!-- Fin modal body -->
 
                <div class="modal-footer">
                    <input type="hidden" name="idUsuario_perfil" id="idUsuario_perfil"/>

                    <!--  -->
                    <button type="submit" name="action" id="perfilGuardar" value="Add" 
                    class="btn btn-success pull-left hidden-xs-up"><i class="fa fa-floppy-o" aria-hidden="true">
                    </i>Guardar</button>

                    <button type="button" value="Add" 
                    class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true">
                    </i>Cerrar</button>

                </div>

            </div>

        </form>

    </div>

  </div>
