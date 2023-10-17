// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


})();

//funcion para obtener los tipo de empleados
function agregarTipoEmpleadosSelect(idSelect) {

    //se genera la peticion al controlador con la opcion 17 mediante ajax
    $.ajax({
        type: "POST",
        url: "../php/controlador.php",
        data: {
            opc: 16
        },
        success: function (response) {
            if (response.status == true) {
                //se obtiene el select por medio del id
                var select = document.getElementById(idSelect);
                //se recorre el arreglo de datos
                response.data.forEach(element => {
                    //se crea un option por cada elemento del arreglo
                    var option = document.createElement("option");
                    //se asigna el valor del id y el texto del nombre
                    option.value = element.id;
                    option.text = element.nombre;
                    //se agrega el option al select
                    select.add(option);
                });
            } else {
                console.log(response.msg);
            }
        }
    });

}