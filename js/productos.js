// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    //agregar class active a boton btnMenu
    const btnMenu = document.getElementById('btnProductos');
    btnMenu.classList.add('active');

    obtenerProductos();

    $('#formAddProductos').submit(function (e) {
        e.preventDefault();
        //obtener todos los datos del formulario   
        const datos = {
            "opc": 10,
            "nombre": $('#txtAddNombre').val(),
            "descripcion": $('#txtAddDescripcion').val(),
            "precio": $('#txtAddPrecio').val(),
            "stock": $('#txtAddStock').val()
        };

        $.ajax({
            type: "POST",
            url: "../php/controlador.php",
            data: datos,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto agregado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#formAddProductos').trigger('reset');
                    $('#modalProductosAdd').modal('hide');

                    obtenerProductos();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg,
                    });
                }
            }
        });
    });
})();

function obtenerProductos() {
    //peticion ajax mediante jquery que ejecute el php de controlador al cual se le mande por post la opc 2
    $.ajax({
        url: '../php/controlador.php',
        type: 'POST',
        data: { opc: 3 },
        success: function (response) {
            //validar que la respuesta sea true
            if (response.status == true) {
                //obtener el tbody de la tabla
                const tbody = document.getElementById('tbodyProductos');
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
                    <td>${element.nombre}</td>
                    <td>${element.descripcion}</td>
                    <td>${element.precio}</td>
                    <td>${element.stock}</td>
                    <td>${element.fecha_alta}</td>
                    <td class="text-center">
                            <div class="btn-group" role="group" aria-label=" button group">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalProductosUpdate" data-id="${element.id}"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Actualizar informacion del Producto"  class="fa-solid fa-pen"></i></button>
                            <button type="button" class="btn btn-outline-danger btnEliminar" data-id="${element.id}" data-name="${element.nombre}"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar Producto"  class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </td>
                    `;
                    //agregar el tr al tbody
                    tbody.appendChild(tr);
                });
            }

            initTooltipTriggerList();
            initEventBtnEliminar();
            initEventUpdateModal();

        }
    });

    //filtrar contenido de la tabla desde el input #txtFiltro
    $('#txtFiltro').keyup(function (e) {
        e.preventDefault();
        const value = $(this).val().toLowerCase();
        $("#tbodyProductos tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
}

//funcion para que se pueda mostrar el tooltip en los botones que se agregan dinamicamente
function initTooltipTriggerList() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

}


function initEventBtnEliminar() {
    //evento click con query en boton con clase btnEliminar
    $('.btnEliminar').click(function (e) {
        e.preventDefault();

        //obtener data-id del boton
        const id = $(this).data('id');
        const nombre = $(this).data('name');

        Swal.fire({
            title: '¿Estas seguro de eliminar el producto ' + nombre + '?',
            text: "No podras revertir esta accion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                //peticion ajax mediante jquery que ejecute el php de controlador al cual se le mande por post la opc 3
                $.ajax({
                    url: '../php/controlador.php',
                    type: 'POST',
                    data: { opc: 12, idProducto: id },
                    success: function (response) {
                        //validar que la respuesta sea true
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto eliminado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            obtenerProductos();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.msg,
                            });
                        }
                    }
                });
            }
        });
    });
}

function initEventUpdateModal() {
    //funcion que carge en modal los datos del Producto que esta en el data-datos del boton ver
    $('#modalProductosUpdate').on('show.bs.modal', function (event) {
        //obtener el boton que ejecuta el modal
        const button = $(event.relatedTarget);
        //obtener los datos del data-datos del boton
        const id = button.data('id');

        //obtener los datos del Producto mediante el id que se obtuvo del boton
        $.ajax({
            url: '../php/controlador.php',
            type: 'POST',
            async: false,
            data: { opc: 9, idProducto: id },
            success: function (response) {
                //validar que la respuesta sea true
                if (response.status == true) {

                    //cargar los datos en el modal
                    $('#modalProductosUpdateLabel').text('Actualizar Producto: ' + response.data.nombre);

                    $('#txtUpdateid').val(response.data.id);
                    $('#txtUpdateNombre').val(response.data.nombre);
                    $('#txtUpdateDescripcion').val(response.data.descripcion);
                    $('#txtUpdatePrecio').val(response.data.precio);
                    $('#txtUpdateStock').val(response.data.stock);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg,
                    });
                }
            }
        });
        initEventFormUpdateProducto();
    });
}


function initEventFormUpdateProducto() {
    $('#formUpdateProducto').submit(function (e) {
        e.preventDefault();
        //obtener todos los datos del formulario   
        const datos = {
            "opc": 11,
            "idProducto": $('#txtUpdateid').val(),
            "nombre": $('#txtUpdateNombre').val(),
            "descripcion": $('#txtUpdateDescripcion').val(),
            "precio": $('#txtUpdatePrecio').val(),
            "stock": $('#txtUpdateStock').val()
        };

        $.ajax({
            type: "POST",
            url: "../php/controlador.php",
            data: datos,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto actualizado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#formUpdateProducto').trigger('reset');
                    $('#modalProductosUpdate').modal('hide');

                    obtenerProductos();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg,
                    });
                }
            }
        });
    });

}