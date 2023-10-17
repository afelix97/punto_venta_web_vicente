// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    //agregar class active a boton btnMenu
    const btnMenu = document.getElementById('btnVentas');
    btnMenu.classList.add('active');


    obtenerVentas();

    //filtrar contenido de la tabla desde el input #txtFiltro
    $('#txtFiltro').keyup(function (e) {
        e.preventDefault();
        const value = $(this).val().toLowerCase();
        $("#tbodyVentas tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
})();


function obtenerVentas() {
    //peticion ajax mediante jquery que ejecute el php de controlador al cual se le mande por post la opc 2
    $.ajax({
        url: '../php/controlador.php',
        type: 'POST',
        data: { opc: 4 },
        success: function (response) {
            //validar que la respuesta sea true
            if (response.status == true) {
                //obtener el tbody de la tabla
                const tbody = document.getElementById('tbodyVentas');
                //limpiar el tbody
                tbody.innerHTML = '';

                if (response.data.length == 0) {
                    tbody.innerHTML = response.msg;
                }

                //recorrer el arreglo de datos
                response.data.forEach(element => {
                    //crear un elemento tr
                    const tr = document.createElement('tr');
                    //agregarle un id al tr
                    tr.setAttribute('id', element.id);
                    //agregarle el contenido al tr

                    tr.innerHTML = `
                    <td>${element.id}</td>
                    <td>${element.nom_cliente}</td>
                    <td>${element.id_empleado}|${element.empleado}</td>
                    <td>${element.fecha_venta}</td>
                    <td >
                        <div class="btn-group" role="group" aria-label=" button group">
                            <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalDetalleVenta" data-id="${element.id}"><i class="fa-solid fa-expand"></i></button>
                        </div>
                    </td>
                    `;
                    //agregar el tr al tbody
                    tbody.appendChild(tr);
                });
            }
        }
    });
}
