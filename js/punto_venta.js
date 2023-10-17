// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    //agregar class active a boton btnMenu
    const btnMenu = document.getElementById('btnPuntoVenta');
    btnMenu.classList.add('active');

    //ocultar containerTableCoincidencias 
    const containerTableCoincidencias = document.getElementById('containerTableCoincidencias');
    containerTableCoincidencias.classList.add('d-none');

    initValidacionesCampos();

    //evento subtim formFinVenta con query
    $('#formFinVenta').submit(function (e) {
        e.preventDefault();

        //generar identificador de la venta con la fecha y hora actual
        const fecha = new Date();
        let año = fecha.getFullYear();
        //quitar los primeros 2 digitos del año
        const idVenta = año.toString().substr(-2) + "" + (fecha.getMonth() + 1) + "" + fecha.getDate() + "" + fecha.getHours() + "" + fecha.getMinutes() + "" + fecha.getSeconds() + fecha.getMilliseconds();

        //se guarda en arreglo el contenido del tbodyCarrito
        const tbodyCarrito = document.getElementById('tbodyCarrito');

        //validar que se encuentren productos en el carrito de compra
        if (tbodyCarrito.children.length == 0) {
            Swal.fire({
                icon: 'info',
                title: 'Carrito de compra vacio',
                showConfirmButton: false,
                timer: 1500
            });
        } else {

            const detalleVenta = [];
            for (let i = 0; i < tbodyCarrito.children.length; i++) {

                //se obtiene la cantidad de productos de la fila en la que se encuentra el ciclo
                let cantidad = tbodyCarrito.children[i].children[4].children[0].children[0].value;

                //se obtiene el id del producto de la fila en la que se encuentra el ciclo
                let idProducto = tbodyCarrito.children[i].children[0].innerHTML;
                let precioProd = tbodyCarrito.children[i].children[3].innerHTML;

                //se valida que el subtotal no sea 0
                let subtotal = tbodyCarrito.children[i].children[5].innerHTML;
                subtotal = subtotal.replace('$', '');
                if (subtotal != 0) {

                    detalleVenta.push({
                        'idProducto': idProducto,
                        'cantidad': cantidad,
                        'precioProd': precioProd.replace('$', '').trim()
                    });
                }
            }

            //se valida que haya productos en el carrito de compra
            if (detalleVenta.length == 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Carrito de compra vacio',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                //se prepara ajax para guardar la venta datos de la venta: idVenta, idUsuario, cliente
                guardarVenta(idVenta, $('#txtCliente').val(), detalleVenta);

            }


        }
    });

    //evento click para cancelar la venta desde el boton btnCancelarVenta
    $('#btnCancelarVenta').click(function (e) {
        e.preventDefault();

        //pregunta si se desea cancelar la venta
        Swal.fire({
            title: '¿Estas seguro de cancelar la venta?',
            text: "Se perderan los datos de la venta actual",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Si, cancelar venta',
            cancelButtonText: 'No, continuar venta'
        }).then((result) => {
            if (result.isConfirmed) {

                iniciarVentaNueva();

            }
        });
    });

})();

//funcion que inicializa los datos de la venta nueva    
function iniciarVentaNueva() {
    //se limpia el txtFiltro
    const inputBusqueda = document.getElementById('inputBusqueda');
    inputBusqueda.value = "";

    //se limpia el tbodyCoincidencias
    const tableCoincidenciasProd = document.getElementById('tableBodyCoincidencias');
    tableCoincidenciasProd.innerHTML = '';
    //se oculta el contenedor de la tabla de coincidencias
    containerTableCoincidencias.classList.add('d-none');

    //se obtiene el tbodyCarrito
    const tbodyCarrito = document.getElementById('tbodyCarrito');
    tbodyCarrito.innerHTML = '';

    //se obtiene el total de productos que se agregan al carrito
    const totalProductos = document.getElementById('totalProductos');
    totalProductos.innerHTML = tbodyCarrito.children.length;

    //se obtiene el total de la compra
    const totalCompra = document.getElementById('totalCompra');
    totalCompra.innerHTML = "$0";

    //se obtiene el total de la compra
    const txtPagaCon = document.getElementById('txtPagaCon');
    txtPagaCon.value = "";

    //se obtiene el total de la compra
    const lblCambio = document.getElementById('lblCambio');
    lblCambio.innerHTML = "$0";
}

function guardarVenta(idVenta, cliente, carrito) {
    //se guarda la venta en la base de datos
    $.ajax({
        type: "POST",
        url: '../php/controlador.php',
        data: {
            "opc": "14",//guardar venta
            "idVenta": idVenta,
            "cliente": cliente,
            "carrito": JSON.stringify(carrito)
        },
        async: false,
        success: function (response) {
            if (response.status) {
                //venta guardada correctamente
                Swal.fire({
                    icon: 'success',
                    title: 'Venta guardada correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
                iniciarVentaNueva();

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ocurrio un error al guardar la venta',
                });
            }
        }
    });

}


//funcion que inicializa el evento del boton agregar al carrito
function initEventAgregarCarrito() {
    //agregar al carrito de compra tbodyCarrito al dar click en el boton de la tabla de coincidencias btnAddCarrito
    const btnAddCarrito = document.querySelectorAll('.btnAddCarrito');
    btnAddCarrito.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            //se obtienen los datos del producto que se agrega al carrito del data datos del boton btnAddCarrito
            const datos = JSON.parse(btn.dataset.datos);

            //validar si el id a agregar ya existe en el carrito de compra
            const tbodyCarrito = document.getElementById('tbodyCarrito');
            let existe = false;
            for (let i = 0; i < tbodyCarrito.children.length; i++) {
                let idProd = tbodyCarrito.children[i].children[0].innerHTML;
                if (idProd == datos.id) {
                    existe = true;
                    break;
                }
            }

            if (existe) {
                Swal.fire({
                    icon: 'info',
                    title: 'El producto ya se encuentra en el carrito de compra',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            //se crea el tr que se agregara al tbodyCarrito
            const tr = document.createElement('tr');
            tr.innerHTML = `
         <td>${datos.id}</td>
         <td>${datos.nombre}</td>
         <td>${datos.descripcion}</td>
         <td class="tbPrecio"> $${datos.precio}</td>
         <td class="text-center">
             <div class="btn-group" role="group" aria-label=" button group">
                 <input class="form-control form-control-sm txtCantidad" type="text" min="1" value="1" aria-label=".form-control-sm example" style="width: 55px;" maxlength="${datos.stock}" minlength="1">
             </div>
         </td>
         <td class="tdSubtotal">$${datos.precio}</td>
         <td class="text-center">
             <div class="btn-group" role="group" aria-label=" button group">
                 <button type="button" class="btn btn-danger btnDeleteCarrito" title="Eliminar del carrito de compra"><i class="fa-solid fa-cart-arrow-down"></i></button>
             </div>
         </td>
         `;
            //se agrega el tr al tbodyCarrito
            tbodyCarrito.appendChild(tr);

            //se elimina el producto del carrito de compra con jquery
            $('.btnDeleteCarrito').click(function (e) {
                //eliminar el tr del tbodyCarrito
                $(this).closest('tr').remove();
                actualizarTotales();//se actualiza el total de productos y el total de la compra

            });

            actualizarTotales();//se actualiza el total de productos y el total de la compra


            //se actualiza el td tdSubtotal al cambiar el valor del input 
            $('.txtCantidad').keyup(function (e) {
                e.preventDefault();

                const txtCantidad = document.querySelectorAll('.txtCantidad');
                const tdSubtotal = document.querySelectorAll('.tdSubtotal');
                const tbPrecio = document.querySelectorAll('.tbPrecio');

                for (let i = 0; i < txtCantidad.length; i++) {

                    //obtener el valor del maxlength del input
                    const maxlength = parseInt(txtCantidad[i].getAttribute('maxlength'));

                    //validar que el valor del input no sea mayor al maxlength
                    if (parseFloat(txtCantidad[i].value != "" ? txtCantidad[i].value : "0") > maxlength) {
                        txtCantidad[i].value = maxlength;
                    }

                    let subtotal = parseFloat(txtCantidad[i].value != "" ? txtCantidad[i].value : "0") * parseFloat(tbPrecio[i].innerHTML.replace('$', ''));
                    tdSubtotal[i].innerHTML = "$" + subtotal;
                    actualizarTotales();//se actualiza el total de productos y el total de la compra
                }

            });
        });
    });
}

//funcion que actualiza la cantidad de productos agregados y el total
function actualizarTotales() {
    //se obtiene el total de productos que se agregan al carrito
    const totalProductos = document.getElementById('totalProductos');


    //se obtiene el total de la compra
    const totalCompra = document.getElementById('totalCompra');
    let total = 0;
    let cantidadProd = 0;
    for (let i = 0; i < tbodyCarrito.children.length; i++) {
        let precio = tbodyCarrito.children[i].children[5].innerHTML;
        precio = precio.replace('$', '');

        //obtener cantidad total de productos
        let cantidad = tbodyCarrito.children[i].children[4].children[0].children[0].value;


        //castear a entero
        cantidadProd += tieneDecimales(parseFloat(cantidad)) ? 1 : parseFloat(cantidad);


        total += parseFloat(precio);
    }
    totalProductos.innerHTML = cantidadProd;
    totalCompra.innerHTML = "$" + total;

    //actualizar lblCambio al agregar un producto al carrito
    const txtPagaCon = document.getElementById('txtPagaCon');
    if (txtPagaCon.value.length > 0) {

        const lblCambio = document.getElementById('lblCambio');
        let cambio = 0;
        if (txtPagaCon.value.length > 0) {
            cambio = parseFloat(txtPagaCon.value) - parseFloat(totalCompra.innerHTML.replace('$', ''));
            lblCambio.innerHTML = "$" + cambio;
        } else {
            lblCambio.innerHTML = "$" + cambio;
        }
    }

}

function initValidacionesCampos() {
    //filtrar contenido de la tabla desde el input #txtFiltro
    $('#inputBusqueda').keyup(function (e) {
        e.preventDefault();

        const tableCoincidenciasProd = document.getElementById('tableBodyCoincidencias');
        //cargar datalist de productos al input de busqueda
        const inputBusqueda = document.getElementById('inputBusqueda');
        const datalistProductos = document.getElementById('datalistOptions');
        const url = '../php/controlador.php?opc=13&coincidencia=' + inputBusqueda.value;
        if ($('#inputBusqueda').val().length > 0) {

            fetch(url)
                .then(response => response.json())
                .then(datos => {
                    tableCoincidenciasProd.innerHTML = '';// vacia la tabla cada vez que se realiza una busqueda
                    datalistProductos.innerHTML = '';

                    if (datos.status) {
                        let coincidencias = datos.data;

                        if (coincidencias.length > 0) {

                            //muestra el contenedor de la tabla si hay coincidencias
                            containerTableCoincidencias.classList.remove('d-none');

                            coincidencias.forEach(producto => {
                                let option = document.createElement('option');
                                option.value = producto.nombre;
                                datalistProductos.appendChild(option);
                            });

                            //se carga en tabla tableCoincidenciasProd los productos que coinciden con la busqueda
                            coincidencias.forEach(producto => {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td>${producto.descripcion}</td>
                                <td>${producto.precio}</td>
                                <td>${producto.stock}</td>
                                <td class="text-center">
                                <div class="btn-group" role="group" aria-label=" button group">
                                    <button type="button" class="btn btn-success btnAddCarrito" data-datos='${JSON.stringify(producto)}' title="Agregar al carrito de compra"><i class="fa-solid fa-cart-plus"></i></button>
                                </div>
                            </td>
                            `;

                                tableCoincidenciasProd.appendChild(tr);
                            });
                        }

                        if (coincidencias.length == 0) {
                            datalistProductos.innerHTML = '';
                            containerTableCoincidencias.classList.add('d-none');
                            tableCoincidenciasProd.innerHTML = '';// vacia la tabla cada vez que se realiza una busqueda

                            let option = document.createElement('option');
                            option.value = 'No se encontraron coincidencias con: "' + inputBusqueda.value + '"';
                            datalistProductos.appendChild(option);

                        }
                    }
                    initEventAgregarCarrito();

                });
        } else {
            containerTableCoincidencias.classList.add('d-none');
            tableCoincidenciasProd.innerHTML = '';// vacia la tabla cada vez que se realiza una busqueda

            datalistProductos.innerHTML = '';
            const option = document.createElement('option');
            option.value = 'Escribe aquí, para buscar coincidencias';
            datalistProductos.appendChild(option);
        }
    });

    //validar que el campo #txtPagaCon solo acepte numeros
    $('#txtPagaCon').keypress(function (e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    });

    //actualizar lblCambio al cambiar el valor del input #txtPagaCon
    $('#txtPagaCon').keyup(function (e) {
        e.preventDefault();

        const txtPagaCon = document.getElementById('txtPagaCon');
        const lblCambio = document.getElementById('lblCambio');
        const totalCompra = document.getElementById('totalCompra');
        let cambio = 0;
        if (txtPagaCon.value.length > 0) {
            cambio = parseFloat(txtPagaCon.value) - parseFloat(totalCompra.innerHTML.replace('$', ''));
            lblCambio.innerHTML = "$" + cambio;
        } else {
            lblCambio.innerHTML = "$" + cambio;
        }

    });

    $('.txtCantidad').keypress(function (e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    });
}

//validar si un numero float tiene decimales   
function tieneDecimales(numero) {
    return numero % 1 != 0;
}