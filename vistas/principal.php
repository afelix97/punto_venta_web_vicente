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
    <title>Principal</title>
    <link href="../librerias/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">

</head>

<body class="bg-info-subtle">
    <?php include_once 'head.php'; ?>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/carousel/photo1.jpeg" class="d-block w-100" alt="photo1" style="max-height: 550px !important;">
            </div>
            <div class="carousel-item">
                <img src="../images/carousel/photo2.jpeg" class="d-block w-100" alt="photo2" style="max-height: 550px !important;">
            </div>
            <div class="carousel-item">
                <img src="../images/carousel/photo3.jpeg" class="d-block w-100" alt="photo3" style="max-height: 550px !important;">
            </div>
            <div class="carousel-item">
                <img src="../images/carousel/photo4.jpeg" class="d-block w-100" alt="photo4" style="max-height: 550px !important;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-10 card shadow my-2">
                <h1 class="card-title" style="font-size: 30px;">
                    Bienvenido a tu tienda personal donde se ubican los productos necesarios para una vivienda
                </h1>
            </div>
        </div>

    </div>
    <?php include_once 'footer.php'; ?>
    <script src="../js/menu.js"></script>
</body>

</html>