<!-- Modal add-->
<div class="modal fade" id="modalProductosAdd" tabindex="-1" aria-labelledby="modalProductosAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1A5276; color: white;">
                <h1 class="modal-title fs-5" id="modalProductosAddLabel">Agregar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAddProductos">
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label for="txtAddNombre" class="form-label">Nombre</label>
                        <input type="text" name="txtAddNombre" id="txtAddNombre" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtAddDescripcion" class="form-label">Descripcion</label>
                        <input type="text" name="txtAddDescripcion" id="txtAddDescripcion" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="txtAddPrecio" class="form-label">Precio</label>
                        <input type="text" name="txtAddPrecio" id="txtAddPrecio" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="txtAddStock" class="form-label">Stock</label>
                        <input type="text" name="txtAddStock" id="txtAddStock" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
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
<div class="modal fade" id="modalProductosUpdate" tabindex="-1" aria-labelledby="modalProductosUpdateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1A5276; color: white;">
                <h1 class="modal-title fs-5" id="modalProductosUpdateLabel">Actualizar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUpdateProducto">
                <input type="hidden" id="txtUpdateid" required>
                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label for="txtUpdateNombre" class="form-label">Nombre</label>
                        <input type="text" name="txtUpdateNombre" id="txtUpdateNombre" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="txtUpdateDescripcion" class="form-label">Descripcion</label>
                        <input type="text" name="txtUpdateDescripcion" id="txtUpdateDescripcion" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campo requerido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="txtUpdatePrecio" class="form-label">Precio</label>
                        <input type="text" name="txtUpdatePrecio" id="txtUpdatePrecio" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="txtUpdateStock" class="form-label">Stock</label>
                        <input type="text" name="txtUpdateStock" id="txtUpdateStock" class="form-control form-control-sm" placeholder="Escrbir aquí..." required>
                        <div class="invalid-feedback">
                            Campos requerido.
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