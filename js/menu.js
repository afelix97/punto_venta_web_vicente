// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    //agregar class active a boton btnMenu
    const btnMenu = document.getElementById('btnMenu');
    btnMenu.classList.add('active');


    //obtener de la url la vairable login
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const login = urlParams.get('login');
    const user = urlParams.get('usr');
    // decodificar user en base64
    const usr = atob(user);

    //si login es true
    if (login == 'true' && usr != null) {

        Swal.fire(
            'Bienvenido!',
            usr,
            'success'
        );
    }

    //guardar en variable la url pero sin parametros
    const url = window.location.href.split('?')[0];
    //eliminar los parametros de la url
    window.history.replaceState({}, document.title, url);


})();