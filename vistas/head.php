<?php

$user = $_SESSION['usuario_name'];
?>
<style>
    .nav-link {
        color: white !important;
    }

    .active {
        color: #1A5276 !important;
        font-weight: bold !important;
    }

    .btn-cerrarsession:hover {
        transition-duration: 0.5s !important;
        color: white !important;
        background-color: #1A5276 !important;
    }

    .btn-cerrarsession {
        transition-duration: 0.5s !important;
    }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #1A5276 !important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="./principal.php" style="color:white !important; font-weight: bold !important;">TIENDA <small class="text-warning">NENI</small> <SMAll style="font-size: 10px;">V1.0</SMAll></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav nav-tabs me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" id="btnMenu" href="./principal.php"><i class="fa-solid fa-house"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btnPuntoVenta" href="./punto_venta.php"><i class="fa-solid fa-cart-shopping"></i> Punto de Venta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btnEmpleados" href="./empleados.php"><i class="fa-solid fa-users"></i> Empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btnProductos" href="./productos.php"><i class="fa-solid fa-bag-shopping"></i> Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btnVentas" href="./ventas.php"><i class="fa-solid fa-ticket"></i> Ventas</a>
                </li>
            </ul>
            <form class="d-flex">
                <div class="btn-group dropbottom">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #1A5276 !important;">
                        <i class="fa-solid fa-user"></i> <?php echo $user; ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-danger btn-cerrarsession" type="button" href="../php/cerrar_session.php">Cerrar Sesion</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</nav>