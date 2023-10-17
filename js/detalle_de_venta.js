// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    //evento cuando se muestre el modal
    $('#modalDetalleVenta').on('show.bs.modal', function (event) {
        //obtener el id de la venta
        const idVenta = $(event.relatedTarget).data('id');
        //obtener el titulo del modal
        const modalTitle = document.getElementById('modalDetalleVentaLabel');
        //agregarle el id de la venta al modalTitle
        modalTitle.innerHTML = `Detalle de venta #${idVenta}`;
        //obtener el detalle de la venta
        obtenerDetalleVenta(idVenta);
    });


})();

//funcion para obtener el detalle de la venta
function obtenerDetalleVenta(id) {
    //peticion ajax mediante jquery que ejecute el php de controlador al cual se le mande por post la opc 2
    $.ajax({
        url: '../php/controlador.php',
        type: 'POST',
        async: false,
        data: { 'opc': 15, 'idVenta': id },
        success: function (response) {
            const tdTotalVenta = document.getElementById('tdTotalVenta');
            tdTotalVenta.innerHTML = "$0"
            //validar que la respuesta sea true
            if (response.status == true) {
                //obtener el tbody de la tabla
                const tbody = document.getElementById('tbodyVentaDetalle');
                //limpiar el tbody
                tbody.innerHTML = '';

                if (response.data.length == 0) {
                    tbody.innerHTML = response.msg;
                }

                var total = 0;
                //recorrer el arreglo de datos
                response.data.forEach(element => {

                    //obtener indice del elemento
                    const index = response.data.indexOf(element);

                    //crear un elemento tr
                    const tr = document.createElement('tr');
                    //agregarle un id al tr
                    tr.setAttribute('id', element.id);
                    //agregarle el contenido al tr

                    tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${element.id_producto} | ${element.nombre}</td>
                    <td>${element.cantidad}</td>
                    <td>${element.precio_unit}</td>
                    <td>${element.subtotal}</td>
                    `;

                    total += element.subtotal;

                    //agregar el tr al tbody
                    tbody.appendChild(tr);

                    //actualizar tdTotalVenta
                    tdTotalVenta.innerHTML = total;

                });
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
}
