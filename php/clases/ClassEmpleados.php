<?php
include_once('../config/config.php');

class ClassEmpleados
{
    //funcion que valide que el usuario y contraseña existan en la base de datos mysql
    public function validar_usuario($usuario, $password)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Usuario incorrecto";
        $dataReturn['data'] = array();

        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "SELECT * FROM empleados WHERE correo = :usuario AND pass = :password limit 1;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($empleado) {
                $dataReturn['status'] = true;
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] = $empleado;
            } else {
                $dataReturn['status'] = false;
            }
        } catch (PDOException $e) {
            $dataReturn['msg'] =  "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion que valide que el usuario sea un administrador
    public function validar_admin_registro($usuario, $password)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "este usuario es incorrecto o no tiene permisos de administrador";
        $dataReturn['data'] = array();

        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $subSql = "(select id from tipo_usuarios where nombre  = 'administrador')";
            $sql = "SELECT * FROM empleados WHERE correo = :usuario AND pass = :password AND id_tipousuario = " . $subSql . " limit 1;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($empleado) {
                $dataReturn['status'] = true;
                $dataReturn['msg'] = "OK";
                $dataReturn['data'] = $empleado;
            } else {
                $dataReturn['status'] = false;
            }
        } catch (PDOException $e) {
            $dataReturn['msg'] =  "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }


    //funcion que obtenga todo los empleados implementando try catch para el manejo de excepciones
    public function get_empleados()
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $subSql = "(select id from tipo_usuarios where nombre  = 'administrador')";
            $sql = "SELECT * FROM empleados where is_active = true && id_tipousuario !=" . $subSql . " && id != " . $_SESSION['usuario_id'] . ";";
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

    //funcion que obtenga todo los empleados implementando try catch para el manejo de excepciones
    public function get_empleado($id)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();

            $sql = "SELECT * FROM empleados where id = " . $id . " limit 1;";
            $stmt = $con->prepare($sql);
            $stmt->execute();

            //obtener todos los empleados
            $empleados = $stmt->fetch(
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

    //funcion para guardar un empleado
    public function save_empleado($nombre, $correo, $pass, $telefono, $direccion, $id_tipousuario)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Ocurrio un error al guardar el empleado.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "INSERT INTO empleados (nombre, correo, pass, telefono, direccion, id_tipousuario) VALUES (:nombre, :correo, :pass, :telefono, :direccion, :id_tipousuario);";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':id_tipousuario', $id_tipousuario);
            $stmt->execute();
            $dataReturn['status'] = true;
            $dataReturn['msg'] = "Empleado guardado correctamente.";
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }
    //funcion para eliminar empleado
    public function delete_empleado($id)
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Ocurrio un error al eliminar el empleado.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "UPDATE empleados SET is_active = false WHERE id = :id;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $dataReturn['status'] = true;
            $dataReturn['msg'] = "Empleado eliminado correctamente.";
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion para actualizar empleado
    public function update_empleado($idEmpleado, $nombre, $correo, $pass, $telefono, $direccion, $id_tipousuario)
    {
        //actualizar datos del empleado
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Ocurrio un error al actualizar el empleado.";
        $dataReturn['data'] = array();

        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "UPDATE empleados SET nombre = :nombre, correo = :correo, pass = :pass, telefono = :telefono, direccion = :direccion, id_tipousuario = :id_tipousuario WHERE id = :id;";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':id_tipousuario', $id_tipousuario);
            $stmt->bindParam(':id', $idEmpleado);
            $stmt->execute();

            $dataReturn['status'] = true;
            $dataReturn['msg'] = "Empleado actualizado correctamente.";
        } catch (PDOException $e) {
            $dataReturn['msg'] = "Error: " . $e->getMessage();
        }
        return $dataReturn;
    }

    //funcion para obtener los tipos de empleados
    function get_tipo_empleados()
    {
        $dataReturn = array();
        $dataReturn['status'] = false;
        $dataReturn['msg'] = "Sin informacion para mostrar.";
        $dataReturn['data'] = array();
        try {
            $cnx = new Conexion();
            $con = $cnx->conectar();
            $sql = "SELECT * FROM tipo_usuarios;";
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
}
