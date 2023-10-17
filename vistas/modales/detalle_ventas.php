<style>
    /* tfoot estatico */
    tfoot {
        position: sticky;
        bottom: 0;
        background-color: #f5f5f5;
        z-index: 999;
        /* Estilo de fondo del pie de página */
        /* Otras reglas de estilo para el pie de página de la tabla, como colores, bordes, etc. */
    }
</style>
<!-- Modal add-->
<div class="modal fade" id="modalDetalleVenta" tabindex="-1" aria-labelledby="modalDetalleVentaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1A5276; color: white;">
                <h1 class="modal-title fs-5" id="modalDetalleVentaLabel">Detalle de la venta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container mt-3 tabla-contenedor shadow">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">#</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Codigo|Producto</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Cantidad</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Precio/c.u</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyVentaDetalle">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" style="text-align: right;">Total de la venta:</th>
                                <th id="tdTotalVenta">$0</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>