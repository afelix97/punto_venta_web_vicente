<?php
if (!isset($isLogin)) {
?>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,500,300,700);

        * {
            font-family: Open Sans;
        }

        section {
            width: 100%;
            display: inline-block;
            background: #1A5276;
            height: 50vh;
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            text-decoration: underline;
        }

        .footer-distributed {
            background: #1A5276;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.12);
            box-sizing: border-box;
            width: 100%;
            text-align: left;
            font: bold 16px sans-serif;
            padding: 55px 50px;
        }

        .footer-distributed .footer-left,
        .footer-distributed .footer-center,
        .footer-distributed .footer-right {
            display: inline-block;
            vertical-align: top;
        }

        /* Footer left */

        .footer-distributed .footer-left {
            width: 40%;
        }

        /* The company logo */

        .footer-distributed h3 {
            color: #ffffff;
            font: normal 36px 'Open Sans', cursive;
            margin: 0;
        }

        .footer-distributed h3 span {
            color: lightseagreen;
        }

        /* Footer links */

        .footer-distributed .footer-links {
            color: #ffffff;
            margin: 20px 0 12px;
            padding: 0;
        }

        .footer-distributed .footer-links a {
            display: inline-block;
            line-height: 1.8;
            font-weight: 400;
            text-decoration: none;
            color: inherit;
        }

        .footer-distributed .footer-company-name {
            color: #222;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
        }

        /* Footer Center */

        .footer-distributed .footer-center {
            width: 35%;
        }

        .footer-distributed .footer-center i {
            background-color: #33383b;
            color: #ffffff;
            font-size: 25px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-align: center;
            line-height: 42px;
            margin: 10px 15px;
            vertical-align: middle;
        }

        .footer-distributed .footer-center i.fa-envelope {
            font-size: 17px;
            line-height: 38px;
        }

        .footer-distributed .footer-center p {
            display: inline-block;
            color: #ffffff;
            font-weight: 400;
            vertical-align: middle;
            margin: 0;
        }

        .footer-distributed .footer-center p span {
            display: block;
            font-weight: normal;
            font-size: 14px;
            line-height: 2;
        }

        .footer-distributed .footer-center p a {
            color: lightseagreen;
            text-decoration: none;
            ;
        }

        .footer-distributed .footer-links a:before {
            content: "|";
            font-weight: 300;
            font-size: 20px;
            left: 0;
            color: #fff;
            display: inline-block;
            padding-right: 5px;
        }

        .footer-distributed .footer-links .link-1:before {
            content: none;
        }

        /* Footer Right */

        .footer-distributed .footer-right {
            width: 20%;
        }

        .footer-distributed .footer-company-about {
            line-height: 20px;
            color: #92999f;
            font-size: 13px;
            font-weight: normal;
            margin: 0;
        }

        .footer-distributed .footer-company-about span {
            display: block;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }


        /* If you don't want the footer to be responsive, remove these media queries */

        @media (max-width: 880px) {

            .footer-distributed {
                font: bold 14px sans-serif;
            }

            .footer-distributed .footer-left,
            .footer-distributed .footer-center,
            .footer-distributed .footer-right {
                display: block;
                width: 100%;
                margin-bottom: 40px;
                text-align: center;
            }

            .footer-distributed .footer-center i {
                margin-left: 0;
            }

        }
    </style>
    <footer class="footer-distributed">

        <div class="footer-left">

            <h3><img src="../images/logo.jpg" class="border border-4 rounded" alt="lgo" width="200px"></h3>

            <p class="footer-links">
                <a href="./principal.php" class="link-1">Principal</a>

                <a href="./punto_venta.php">Punto de Venta</a>

                <a href="./empleados.php">Empleados</a>

                <a href="./ventas.php">Ventas</a>

                <a href="./productos.php">Productos</a>

            </p>

            <p class="footer-company-name">TIENDA NENI © 2023</p>
        </div>

        <div class="footer-center">
            <span class="text-white">Contacto</span>
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>81650 Costa Azul</span> Angostura, Sinaloa</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+52 697 112 9786</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:Dparramagdalena@gmail.com">Dparramagdalena@gmail.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>Ubicacion:</span>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1221.3151483197876!2d-108.13637668570415!3d25.10314770744764!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1692665355024!5m2!1ses-419!2smx" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </p>

        </div>

    </footer>
<?php
}
?>
<script src="../librerias/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="../librerias/popper.min.js" crossorigin="anonymous"></script>
<script src="../librerias/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../librerias/FontAwesome.js" crossorigin="anonymous"></script>
<script src="../librerias/sweetalert2.js"></script>
<script src="../js/general.js"></script>