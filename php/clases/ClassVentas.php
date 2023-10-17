<?php
include_once('../config/config.php');

class ClassVentas
{
    //funcion que obtenga todo los ventas implementando try catch para el manejo de excepciones
    public function get_ventas()
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "SELECT ve.id,ve.id_empleado,ve.nom_cliente,ve.fecha_venta, em.nombre as empleado FROM ventas ve inner join empleados em ON em.id = ve.id_empleado order by fecha_venta desc;";
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //obtener todos los ventas
            $ventas = $stmt->fetchAll(
                PDO::FETCH_ASSOC
            );

            if ($ventas) {
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] =  $ventas;
            }
            $dataReturn['status'] = true;
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion para guardar una venta
    public function save_venta($idVenta, $cliente, $carrito, $usuario_session)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Ocurrio un error al guardar la venta.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $con->beginTransaction();
            $sql = "INSERT INTO ventas (id,id_empleado,nom_cliente) VALUES (:id,:id_empleado,:nom_cliente);";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $idVenta);
            $stmt->bindParam(':id_empleado', $usuario_session);
            $stmt->bindParam(':nom_cliente', $cliente);
            $stmt->execute();

            //guardar los productos de la venta
            foreach ($carrito as $producto) {
                $sql = "INSERT INTO detalle_venta (id_venta,id_producto,cantidad,precio_unit,subtotal) VALUES (:id_venta,:id_producto,:cantidad,:precio_unit,:subtotal);";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':id_venta', $idVenta);

                $stmt->bindParam(':id_producto', $producto->idProducto);
                $stmt->bindParam(':cantidad', $producto->cantidad);
                $stmt->bindParam(':precio_unit', $producto->precioProd);

                $subtotal = floatval($producto->cantidad) * floatval($producto->precioProd);
                $stmt->bindParam(':subtotal', $subtotal);
                $stmt->execute();

                //actualizar el stock del producto
                $sql = "UPDATE productos SET stock = stock - :cantidad WHERE id = :id_producto;";
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':cantidad', $producto->cantidad);
                $stmt->bindParam(':id_producto', $producto->idProducto);
                $stmt->execute();
            }

            $con->commit();
            $dataReturn['msg'] = "OK";
            $dataReturn['status'] = true;
        } catch (PDOException $e) {
            $con->rollBack();
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion que obtiene el detalle de la venta
    public function get_detalle_venta($idVenta)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "SELECT dv.id_producto,p.nombre,dv.cantidad,dv.precio_unit,dv.subtotal FROM detalle_venta dv INNER JOIN productos p ON dv.id_producto = p.id WHERE dv.id_venta = :id_venta;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_venta', $idVenta);
            $stmt->execute();

            //obtener todos los ventas
            $detalle_venta = $stmt->fetchAll(
                PDO::FETCH_ASSOC
            );

            if ($detalle_venta) {
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] =  $detalle_venta;
            }
            $dataReturn['status'] = true;
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }
}
