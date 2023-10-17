<?php
session_start();
$isLogin = true;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="../librerias/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon">

</head>

<body class="bg-info-subtle">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="margin-top: 10%;">
            <div class="col-3 px-0">
                <img src="../images/logo.jpg" alt="Logo" class="shadow rounded-start" style="width: 100%; height: auto;">
            </div>
            <div class="col-5 px-0">
                <div class="accordion accordion-flush shadow" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                LOGIN
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="container">
                                    <form id="formLogin" method="post">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="txtUser" placeholder="usuario@dominio.com" required>
                                            <label for="txtUser">Usuario</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="txtPass" placeholder="Password" required>
                                            <label for="txtPass">Contraseña</label>
                                        </div>
                                        <div class="d-grid">
                                            <button class="btn btn-success" type="submit">Iniciar Sesión</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Registrarse
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form class="row g-3 needs-validation" id="formRegistrarEmpleado" novalidate>
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Nombre(s)</label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom01" placeholder="Escrbir aquí..." required>
                                        <div class="invalid-feedback">
                                            Campo requerido.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Apellido(s)</label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom02" placeholder="Escrbir aquí..." required>
                                        <div class="invalid-feedback">
                                            Campo requerido.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustomUsername" class="form-label">Correo</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" class="form-control form-control-sm" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="Escrbir aquí..." required>
                                            <div class="invalid-feedback">
                                                favor de introduce un correo valido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control form-control-sm" id="validationCustom03" placeholder="Escrbir aquí..." required>
                                        <div class="invalid-feedback">
                                            Campos requerido.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Telefono</label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom05" placeholder="Escrbir aquí..." maxlength="10" minlength="10" required>
                                        <div class="invalid-feedback">
                                            Campos requerido.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom06" class="form-label">Direccion</label>
                                        <input type="text" class="form-control form-control-sm" id="validationCustom06" placeholder="Escrbir aquí..." required>
                                        <div class="invalid-feedback">
                                            Campos requerido.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationServer04" class="form-label">Tipo Usuario</label>
                                        <select class="form-select form-control-sm" id="validationServer04" aria-describedby="validationServer04Feedback" required>
                                            <option selected disabled value="">Seleccionar aquí...</option>
                                        </select>
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            Campo requerido.
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-outline-success" type="submit">Registrarse</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VENTANAS EMERGENTES -->
    <div class="modal fade" id="modalAdmin" tabindex="-1" aria-labelledby="modalAdminLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAdminLabel">Es necesaria la aprobacion de un usuario ADMINISTRADOR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container d-flex justify-content-center">
                        <div class="col-10">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="txtAdmin" placeholder="usuario@ejemplo.com">
                                <label for="txtAdmin">Usuario</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="txtAdminPass" placeholder="Password">
                                <label for="txtAdminPass">Contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnAprobar">Aprobar</button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
    <script src="../js/login.js"></script>
</body>

</html>