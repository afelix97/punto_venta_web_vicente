// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    var htmlModal = document.getElementById("modalAdmin");
    var myModal = new bootstrap.Modal(htmlModal);
    const txtAdmin = document.getElementById('txtAdmin');

    htmlModal.addEventListener('shown.bs.modal', () => {
        txtAdmin.focus();
    });



    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            event.preventDefault();
            if (!form.checkValidity()) {
                event.stopPropagation();

            } else {
                myModal.show();
            }

            form.classList.add('was-validated')
        }, false)
    });

    //peticion ajax utilizando jquery   con los siguientes parametro opc,usuario,pass al archivo controlador.php
    $('#formLogin').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../php/controlador.php",
            data: {
                opc: 1,
                usuario: $('#txtUser').val(),
                pass: $('#txtPass').val()
            },
            success: function (response) {
                if (response.status == true) {
                    //codificar response.data.nombre en base64
                    var usr = btoa(response.data.nombre);
                    window.location.href = "./principal.php?login=true&usr=" + usr;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg,
                    })
                }
            }
        });
    });

    //evento click btnAprobar
    $('#btnAprobar').click(function () {
        validarUsuario();
    });

    //validar validationCustom05 solo numeros
    $('#validationCustom05').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    agregarTipoEmpleadosSelect("validationServer04");


})();

//funcion para registrar un empleado
function registrarEmpleado() {
    const datos = {
        "opc": 5,
        "nombre": $('#validationCustom01').val() + ' ' + $('#validationCustom02').val(),
        "mail": $('#validationCustomUsername').val(),
        "pass": $('#validationCustom03').val(),
        "telefono": $('#validationCustom05').val(),
        "direccion": $('#validationCustom06').val(),
        "tipoUser": $('#validationServer04').val()
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

                setTimeout(() => {
                    window.location.href = "../index.php";
                }, 1500);

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

//funcion para validar el usuario y contraseña al presionar el boton de btnAprobar
function validarUsuario() {

    var usuario = document.getElementById("txtAdmin").value;
    var pass = document.getElementById("txtAdminPass").value;

    //validar que esten llenos los campos
    if (usuario.trim() == "" || pass.trim() == "") {
        Swal.fire({
            icon: 'info',
            title: 'Favor de llenar todos los campos',
            showConfirmButton: false,
            timer: 1500
        });

        return;
    }

    $.ajax({
        type: "POST",
        url: "../php/controlador.php",
        data: {
            opc: 17,
            usuario: usuario,
            pass: pass
        },
        success: function (response) {
            if (response.status == true) {

                //limpiar campos
                document.getElementById("txtAdmin").value = "";
                document.getElementById("txtAdminPass").value = "";

                //ocultar modal
                $('#modalAdmin').modal('hide');

                registrarEmpleado();

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.msg,
                })
            }
        }
    });
}