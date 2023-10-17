// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    //agregar class active a boton btnMenu
    const btnMenu = document.getElementById('btnEmpleados');
    btnMenu.classList.add('active');

    obtenerEmpleados();

    agregarTipoEmpleadosSelect("slctAddTipoUser");
    agregarTipoEmpleadosSelect("slctUpdateTipoUser");


    $('#formAddEmpleado').submit(function (e) {
        e.preventDefault();
        //obtener todos los datos del formulario   
        const datos = {
            "opc": 5,
            "nombre": $('#txtAddNombre').val() + ' ' + $('#txtAddApellido').val(),
            "mail": $('#txtAddMail').val(),
            "pass": $('#txtAddPass').val(),
            "telefono": $('#txtAddTelefono').val(),
            "direccion": $('#txtAddDireccion').val(),
            "tipoUser": $('#slctAddTipoUser').val()
        };

        $.ajax({
            type: "POST",
            url: "../php/controlador.php",
            data: datos,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Empleado agregado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#formAddEmpleado').trigger('reset');
                    $('#modalEmpleadosAdd').modal('hide');

                    obtenerEmpleados();
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

    //filtrar contenido de la tabla desde el input #txtFiltro
    $('#txtFiltro').keyup(function (e) {
        e.preventDefault();
        const value = $(this).val().toLowerCase();
        $("#tbodyEmpleados tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

})();

function obtenerEmpleados() {
    //peticion ajax mediante jquery que ejecute el php de controlador al cual se le mande por post la opc 2
    $.ajax({
        url: '../php/controlador.php',
        type: 'POST',
        data: { opc: 2 },
        async: false,
        success: function (response) {

            //validar que la respuesta sea true
            if (response.status == true) {
                //obtener el tbody de la tabla
                const tbody = document.getElementById('tbodyEmpleados');
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
                    <td>${element.correo}</td>
                    <td>${element.telefono}</td>
                    <td>${element.direccion}</td>
                    <td>${element.fecha_alta}</td>
                    <td class="text-center">
                            <div class="btn-group" role="group" aria-label=" button group">
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalEmpleadosView" data-datos="${element.nombre}|${element.telefono}|${element.direccion}|${element.id_tipousuario}|${element.correo}"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver informacion del empleado"  class="fa-solid fa-eye"></i></button>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEmpleadosUpdate" data-id="${element.id}"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Actualizar informacion del empleado"  class="fa-solid fa-pen"></i></button>
                                <button type="button" class="btn btn-outline-danger btnEliminar" data-id="${element.id}" data-name="${element.nombre}"><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Eliminar Empleado"  class="fa-solid fa-trash-can"></i></button>
                            </div>
                    </td>
                    `;
                    //agregar el tr al tbody
                    tbody.appendChild(tr);
                });
                initTooltipTriggerList();
                initEventBtnEliminar();
                initEventViewModal();
                initEventUpdateModal();

            }

        }
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
            title: '¿Estas seguro de eliminar el empleado ' + nombre + '?',
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
                    data: { opc: 6, idEmpleado: id },
                    success: function (response) {
                        //validar que la respuesta sea true
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Empleado eliminado correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            obtenerEmpleados();
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
function initEventViewModal() {
    //funcion que carge en modal los datos del empleado que esta en el data-datos del boton ver
    $('#modalEmpleadosView').on('show.bs.modal', function (event) {
        //obtener el boton que ejecuta el modal
        const button = $(event.relatedTarget);
        //obtener los datos del data-datos del boton
        const datos = button.data('datos').split('|');
        //obtener el modal
        const modal = $(this);
        //cargar los datos en el modal
        modal.find('.modal-title').text('Informacion del Empleado: ' + datos[0]);
        modal.find('.modal-body #txtViewNombre').val(datos[0]);
        modal.find('.modal-body #txtViewTelefono').val(datos[1]);
        modal.find('.modal-body #txtViewDireccion').val(datos[2]);
        modal.find('.modal-body #txtViewTipoUser').val(datos[3]);
        modal.find('.modal-body #txtViewMail').val(datos[4]);

    });
}

function initEventUpdateModal() {
    //funcion que carge en modal los datos del empleado que esta en el data-datos del boton ver
    $('#modalEmpleadosUpdate').on('show.bs.modal', function (event) {
        //obtener el boton que ejecuta el modal
        const button = $(event.relatedTarget);
        //obtener los datos del data-datos del boton
        const id = button.data('id');

        //obtener los datos del empleado mediante el id que se obtuvo del boton
        $.ajax({
            url: '../php/controlador.php',
            type: 'POST',
            async: false,
            data: { opc: 7, idEmpleado: id },
            success: function (response) {

                //validar que la respuesta sea true
                if (response.status == true) {

                    //cargar los datos en el modal
                    $('#modalEmpleadosUpdateLabel').text('Actualizar Empleado: ' + response.data.nombre);

                    $('#txtUpdateid').val(response.data.id);
                    $('#txtUpdateNombre').val(response.data.nombre);
                    $('#txtUpdatePass').val(response.data.pass);
                    $('#txtUpdateTelefono').val(response.data.telefono);
                    $('#txtUpdateDireccion').val(response.data.direccion);
                    $('#slctUpdateTipoUser').val(response.data.id_tipousuario);
                    $('#txtUpdateMail').val(response.data.correo);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg,
                    });
                }
            }
        });
        initEventFormUpdateEmpleado();
    });
}

function initEventFormUpdateEmpleado() {
    $('#formUpdateEmpleado').submit(function (e) {
        e.preventDefault();
        //obtener todos los datos del formulario   
        const datos = {
            "opc": 8,
            "idEmpleado": $('#txtUpdateid').val(),
            "nombre": $('#txtUpdateNombre').val(),
            "mail": $('#txtUpdateMail').val(),
            "pass": $('#txtUpdatePass').val(),
            "telefono": $('#txtUpdateTelefono').val(),
            "direccion": $('#txtUpdateDireccion').val(),
            "tipoUser": $('#slctUpdateTipoUser').val()
        };

        $.ajax({
            type: "POST",
            url: "../php/controlador.php",
            data: datos,
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Empleado actualizado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#formUpdateEmpleado').trigger('reset');
                    $('#modalEmpleadosUpdate').modal('hide');

                    obtenerEmpleados();
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