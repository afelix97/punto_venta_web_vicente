<?php
//validar que exista sesion si no redirigir al login
session_start();
if (!isset($_SESSION['usuario_name'])) {
    header('Location: ../index.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Punto de Venta</title>
    <link href="../librerias/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/punto_venta.css">

</head>

<body class="bg-info-subtle">
    <?php include_once 'head.php'; ?>

    <div class="container my-3">
        <div class="card shadow">
            <div class="card-header">
                Punto de Venta
            </div>
            <div class="card-body">
                <div class="container mt-1">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="row g-3 justify-content-center">
                                <div class="col-auto">
                                    <label for="txtCodigo"><b>Codigo o Nombre del producto a vender:</b></label>
                                </div>
                                <div class="col-8">
                                    <input class="form-control" list="datalistOptions" id="inputBusqueda" placeholder="Escribir aquí..." autocomplete="off">
                                    <datalist id="datalistOptions">
                                        <option value="Escribe aquí, para buscar coincidencias">
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="containerTableCoincidencias">

                            <h6><b>Coincidencias: </b></h6>
                            <div class="container mt-3 tabla-contenedor shadow">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-info-subtle">codigo</th>
                                            <th scope="col" class="bg-info-subtle">Nombre</th>
                                            <th scope="col" class="bg-info-subtle">Descripcion</th>
                                            <th scope="col" class="bg-info-subtle">Precio</th>
                                            <th scope="col" class="bg-info-subtle">Stock</th>
                                            <th scope="col" class="bg-info-subtle" style=" width: 20px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBodyCoincidencias">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12 col-md-8">
                            <h5> <b>Carrito de compra:</b> </h5>
                            <div class="container mt-3 tabla-contenedor2 shadow">
                                <table class="table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Codigo</th>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Producto</th>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Descripcion</th>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Precio</th>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Cantidad</th>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Subtotal</th>
                                            <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyCarrito">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary"><b>Productos</b></span>
                                <span class="badge bg-primary rounded-pill" id="totalProductos">0</span>
                            </h4>
                            <form id="formFinVenta">

                                <ul class="list-group mb-3 shadow">
                                    <li class="list-group-item ">
                                        <div>
                                            <h6 class="my-0"><b>Nombre del Cliente: </b></h6>
                                            <small class="text-body-secondary"><input type="text" id="txtCliente" class="form-control" placeholder="Escribir aquí..." required></small>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                            <h6 class="my-0"><b>Paga con:</b> </h6>
                                            <input type="text" class="form-control" id="txtPagaCon" placeholder="Escribir aquí...">
                                        </div>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                                        <div class="text-success">
                                            <h6 class="my-0" style="font-size: 30px !important;">Cambio: </h6>
                                        </div>
                                        <span class="text-success" id="lblCambio" style="font-size: 30px !important;"><b>$0</b></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between" style="font-size: 30px !important;">
                                        <span><b>Total venta:</b></span>
                                        <strong id="totalCompra">$0.00</strong>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-center bg-success-subtle">
                                        <div class="d-grid mx-1">
                                            <button class="btn btn-danger" id="btnCancelarVenta" type="button">CANCELAR VENTA</button>
                                        </div>
                                        <div class="d-grid mx-1">
                                            <button class="btn btn-success" type="submit">FINALIZAR VENTA</button>
                                        </div>
                                    </li>
                            </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script src="../js/punto_venta.js"></script>
</body>

</html>