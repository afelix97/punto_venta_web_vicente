<!-- Modal add-->
<div class="modal fade" id="modalEmpleadosAdd" tabindex="-1" aria-labelledby="modalEmpleadosAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1A5276; color: white;">
                <h1 class="modal-title fs-5" id="modalEmpleadosAddLabel">Agregar Empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddEmpleado">
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label for="txtAddNombre" class="form-label">Nombre(s)</label>
                        <input type="text" name="txtAddNombre" id="txtAddNombre" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtAddApellido" class="form-label">Apellido(s)</label>
                        <input type="text" name="txtAddApellido" id="txtAddApellido" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="txtAddMail" class="form-label">Correo</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" name="txtAddMail" id="txtAddMail" class="form-control form-control-sm" aria-describedby="inputGroupPrepend" placeholder="Escrbir aquí..." required>
                            <div class="invalid-feedback">
                                favor de introduce un correo valido.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtAddPass" class="form-label">Password</label>
                        <input type="password" name="txtAddPass" id="txtAddPass" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtAddTelefono" class="form-label">Telefono</label>
                        <input type="text" name="txtAddTelefono" id="txtAddTelefono" class="form-control form-control-sm" placeholder="Escrbir aquí..." maxlength="10" minlength="10" required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtAddDireccion" class="form-label">Direccion</label>
                        <input type="text" name="txtAddDireccion" id="txtAddDireccion" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slctAddTipoUser" class="form-label">Tipo Usuario</label>
                        <select class="form-select form-control-sm" name="slctAddTipoUser" id="slctAddTipoUser" aria-describedby="validationServer04Feedback" required>
                            <option selected disabled value="">Seleccionar aquí...</option>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal update-->
<div class="modal fade" id="modalEmpleadosUpdate" tabindex="-1" aria-labelledby="modalEmpleadosUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1A5276; color: white;">
                <h1 class="modal-title fs-5" id="modalEmpleadosUpdateLabel">Actualizar Empleado</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUpdateEmpleado">
                <input type="hidden" id="txtUpdateid" required>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label for="txtUpdateNombre" class="form-label">Nombre(s)</label>
                        <input type="text" id="txtUpdateNombre" name="txtUpdateNombre" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtUpdateTelefono" class="form-label">Telefono</label>
                        <input type="text" id="txtUpdateTelefono" name="txtUpdateTelefono" class="form-control form-control-sm" placeholder="Escrbir aquí..." maxlength="10" minlength="10" required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="txtUpdateMail" class="form-label">Correo</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" id="txtUpdateMail" name="txtUpdateMail" class="form-control form-control-sm" aria-describedby="inputGroupPrepend" placeholder="Escrbir aquí..." required>
                            <div class="invalid-feedback">
                                favor de introduce un correo valido.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="txtUpdatePass" class="form-label">Password</label>
                        <input type="password" id="txtUpdatePass" name="txtUpdatePass" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="txtUpdateDireccion" class="form-label">Direccion</label>
                        <input type="text" id="txtUpdateDireccion" name="txtUpdateDireccion" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="slctUpdateTipoUser" class="form-label">Tipo Usuario</label>
                        <select class="form-select form-control-sm" name="slctUpdateTipoUser" id="slctUpdateTipoUser" aria-describedby="validationServer04Feedback" required>
                            <option selected disabled value="">Seleccionar aquí...</option>
                        </select>
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal view-->
<div class="modal fade" id="modalEmpleadosView" tabindex="-1" aria-labelledby="modalEmpleadosViewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1A5276; color: white;">
                <h1 class="modal-title fs-5" id="modalEmpleadosViewLabel">Informacion del Empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label for="txtViewNombre" class="form-label">Nombre(s)</label>
                    <input id="txtViewNombre" type="text" readonly class="form-control-plaintext" placeholder="Sin capturar...">
                </div>

                <div class="col-md-6">
                    <label for="txtViewTelefono" class="form-label">Telefono</label>
                    <input id="txtViewTelefono" type="text" readonly class="form-control-plaintext" class="form-control form-control-sm" placeholder="Sin capturar...">
                </div>
                <div class="col-md-6">
                    <label for="txtViewDireccion" class="form-label">Direccion</label>
                    <input id="txtViewDireccion" type="text" readonly class="form-control-plaintext" class="form-control form-control-sm" placeholder="Sin capturar...">
                </div>
                <div class="col-md-6">
                    <label for="txtViewTipoUser" class="form-label">Tipo Usuario</label>
                    <input id="txtViewTipoUser" type="text" readonly class="form-control-plaintext" class="form-control form-control-sm" placeholder="Sin capturar...">
                </div>
                <div class="col-md-12">
                    <label for="txtViewMail" class="form-label">Correo</label>
                    <input id="txtViewMail" type="text" readonly class="form-control-plaintext" class="form-control form-control-sm" placeholder="Sin capturar...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>