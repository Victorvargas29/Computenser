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

                    <label>Apellidos</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required pattern = "^[a-zA-Z_áéíóúñ\s]{0,30}$" class="form-control"></input>
                    <br/>

                    <label>Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono" required pattern = "[0-9]{0,15}" class="form-control"></input>
                    <br/>
<!--
                    <label>Correo</label>
                    <input type="email" name="email" id="email" placeholder="Correo" required="required" class="form-control"></input>
                    <br/>
-->
                    <label>Direccion</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Direccion"  class="form-control"></input>
                    <br/>
<!--
                    <label>Dirección</label>
                    <textarea cols="66" rows="3" id="direccion" name="direccion" placeholder="Dirección..." required pattern = "^[a-zA-Z_áéíóúñ\s]{0,200}$"></textarea>
                    <br/>   -->

                     <div class="form-group">
                        <label for="" class="col-lg-1 control-label">Departamento</label>
                        <select class="form-control font-weight-bold" id="idDepartamento" name="idDepartamento">
                            <option class="font-weight-bold" value="0">Seleccione</option>

                            <?php
                           // $num=0;
                           for($i=0; $i<sizeof($dep);$i++){
                            // $num++;
                             ?>
                              <option value="<?php  echo $dep[$i]["idDepartamento"]?>">
                                <?php
                                   // echo $num;
                                    echo "• ";
                                    echo $dep[$i]["nombre"];
                                ?>
                              </option>
                        
                             <?php
                           }
                        ?>

                        </select>
                    </div>

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