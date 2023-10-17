<?php
include_once('../config/config.php');

class ClassProductos
{
    //funcion que obtenga todo los empleados implementando try catch para el manejo de excepciones
    public function get_productos()
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "SELECT * FROM productos where is_active = 1;";
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //obtener todos los empleados
            $empleados = $stmt->fetchAll(
                PDO::FETCH_ASSOC
            );

            if ($empleados) {
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] =  $empleados;
            }
            $dataReturn['status'] = true;
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    public function get_producto($id)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "SELECT * FROM productos where id = " . $id . " limit 1;";
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //obtener todos los producto
            $producto = $stmt->fetch(
                PDO::FETCH_ASSOC
            );

            if ($producto) {
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] =  $producto;
            }
            $dataReturn['status'] = true;
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    public function get_productos_filtro($coincidencia)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {


            $cnx = new Conexion();
            $con = $cnx->conectar();
            //validar si $coincidencia son puros numeros
            if (is_numeric($coincidencia)) {
                $sql = "SELECT * FROM productos where id = " . $coincidencia . " limit 7;";
            } else {
                $sql = "SELECT * FROM productos where LOWER(nombre) like  LOWER('%" . $coincidencia . "%') limit 7;";
            }
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //obtener todos los producto
            $producto = $stmt->fetchAll(
                PDO::FETCH_ASSOC
            );

            if ($producto) {
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] =  $producto;
            }
            $dataReturn['status'] = true;
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion para guardar un nuevo producto
    public function save_producto($nombre, $descripcion, $precio, $stock)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "No se pudo guardar el producto.";
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (:nombre, :descripcion, :precio, :stock);";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock);
            $stmt->execute();
            $dataReturn['status'] = true;
            $dataReturn['msg'] = "Producto guardado correctamente.";
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion para actualizar un producto
    public function update_producto($id, $nombre, $descripcion, $precio, $stock)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "No se pudo actualizar el producto.";
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock WHERE id = :id;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock);
            $stmt->execute();
            $dataReturn['status'] = true;
            $dataReturn['msg'] = "Producto actualizado correctamente.";
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion para eliminar un producto
    public function delete_producto($id)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "No se pudo eliminar el producto.";
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "UPDATE productos SET is_active = 0 WHERE id = :id;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();


            $dataReturn['status'] = true;
            $dataReturn['msg'] = "Producto eliminado correctamente.";
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }
}
