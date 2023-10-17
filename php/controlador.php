<?php

session_start();

include_once("./clases/ClassProductos.php");
include_once("./clases/ClassEmpleados.php");
include_once("./clases/ClassVentas.php");

//header para json
header('Content-Type: application/json');

//obtiene por post una variables opc y validar que tenga un valor
$opc = isset($_POST['opc']) ? $_POST['opc'] : null;

if (!$opc) {
    $opc = isset($_GET['opc']) ? $_GET['opc'] : null;
}

//validar que las variables usuario y pass tengan un valor
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
$pass = isset($_POST['pass']) ? $_POST['pass'] : null;

//obtener los datos de los empleados nombre,apellido,mail,pass,telefono,direccion,tipoUser
$idEmpleado = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$mail = isset($_POST['mail']) ? $_POST['mail'] : null;
$pass = isset($_POST['pass']) ? $_POST['pass'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
$tipoUser = isset($_POST['tipoUser']) ? $_POST['tipoUser'] : null;

//obtener los datos de las ventas
$id_venta = isset($_POST['idVenta']) ? $_POST['idVenta'] : null;
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : null;

//obtener arreglo de productos
$carrito = isset($_POST['carrito']) ? $_POST['carrito'] : null;


//obtener los datos de los productos
$id = isset($_POST['idProducto']) ? $_POST['idProducto'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$precio = isset($_POST['precio']) ? $_POST['precio'] : null;
$stock = isset($_POST['stock']) ? $_POST['stock'] : null;

//obtener coincidencia de productos
$coincidencia = isset($_GET['coincidencia']) ? $_GET['coincidencia'] : null;


//instancias de las clases
$classProductosService = new ClassProductos();
$classEmpleadosService = new ClassEmpleados();
$classVentasService = new ClassVentas();

$dataReturn = array();
$dataReturn['status'] = false;
$dataReturn['msg'] = "Ocurrio un error al procesar la solicitud";
$dataReturn['data'] = array();


switch ($opc) {
    case 1:
        $dataReturn = $classEmpleadosService->validar_usuario($usuario, $pass);

        if ($dataReturn['status']) {
            $empleado = $dataReturn['data'];

            $_SESSION['usuario_id'] = $empleado['id'];
            $_SESSION['usuario_name'] = $empleado['nombre'];
        }

        break;
    case 2:
        $dataReturn = $classEmpleadosService->get_empleados();
        break;
    case 3:
        $dataReturn = $classProductosService->get_productos();
        break;
    case 4:
        $dataReturn = $classVentasService->get_ventas();
        break;
    case 5:
        $dataReturn = $classEmpleadosService->save_empleado($nombre, $mail, $pass, $telefono, $direccion, $tipoUser);
        break;

    case 6: //opcion 6 eliminar empleado
        $dataReturn = $classEmpleadosService->delete_empleado($idEmpleado);
        break;
    case 7:
        $dataReturn = $classEmpleadosService->get_empleado($idEmpleado);
        break;
    case 8:
        $dataReturn = $classEmpleadosService->update_empleado($idEmpleado, $nombre, $mail, $pass, $telefono, $direccion, $tipoUser);
        break;
    case 9:
        $dataReturn = $classProductosService->get_producto($id);
        break;
    case 10:
        $dataReturn = $classProductosService->save_producto($nombre, $descripcion, $precio, $stock);
        break;
    case 11:
        $dataReturn = $classProductosService->update_producto($id, $nombre, $descripcion, $precio, $stock);
        break;
    case 12:
        $dataReturn = $classProductosService->delete_producto($id);
        break;
    case 13:
        $dataReturn = $classProductosService->get_productos_filtro($coincidencia);
        break;

    case 14:
        $usuario_session = $_SESSION['usuario_id'];

        //convertir string a json
        $carrito = json_decode($carrito);

        $dataReturn = $classVentasService->save_venta($id_venta, $cliente, $carrito, $usuario_session);
        break;
    case 15:
        $dataReturn = $classVentasService->get_detalle_venta($id_venta);
        break;
    case 16:
        $dataReturn = $classEmpleadosService->get_tipo_empleados();
        break;
    case 17:
        $dataReturn = $classEmpleadosService->validar_admin_registro($usuario, $pass);
        break;
    default:


        break;
}
echo json_encode($dataReturn);
