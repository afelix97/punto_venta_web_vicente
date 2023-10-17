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
    <title>Productos</title>
    <link href="../librerias/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/general.css">

    <style>
        .card-header {
            /* letra negrita */
            font-weight: bold;
            font-size: 24px;
            color: #1A5276 !important;
        }
    </style>
    <style>
        .tabla-contenedor {
            /* Ancho deseado para el contenedor */
            height: 300px;
            /* Altura deseada para el contenedor */
            overflow: auto;
            /* Esto agregará barras de desplazamiento si es necesario */
        }

        table {
            width: 100%;
            /* Asegúrate de que la tabla ocupe todo el ancho del contenedor */
            border-collapse: collapse;
            /* Estilo de borde */
        }

        thead {
            position: sticky;
            top: 0;
            background-color: #f5f5f5;
            z-index: 999;
            /* Estilo de fondo de la cabecera */
            /* Otras reglas de estilo para la cabecera de la tabla, como colores, bordes, etc. */
        }
    </style>

</head>

<body class="bg-info-subtle">
    <?php include_once 'head.php'; ?>
    <?php include_once './modales/productos.php'; ?>

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header">
                Listado de Productos

                <button class="btn btn-outline-success" style="float: right;" data-bs-toggle="modal" data-bs-target="#modalProductosAdd">Agregar</button>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <label for="txtFiltro" class="col-form-label">Buscar: </label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="txtFiltro" class="form-control" aria-describedby="filtro de tabla">
                    </div>

                </div>
                <div class="container mt-3 tabla-contenedor shadow">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">#</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Nombre</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Descripcion</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Precio</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Stock</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Fecha Alta</th>
                                <th scope="col" style="background-color: #1A5276 !important; color:aliceblue">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyProductos">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php'; ?>
    <script src="../js/productos.js"></script>
</body>

</html>