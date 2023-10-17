ALTER TABLE empleados ADD FOREIGN KEY(id_tipousuario) REFERENCES tipo_usuarios(id);
ALTER TABLE detalle_venta ADD FOREIGN KEY(id_producto) REFERENCES productos(id);
ALTER TABLE detalle_venta ADD FOREIGN KEY(id_venta) REFERENCES ventas(id);
ALTER TABLE ventas ADD FOREIGN KEY(id_empleado) REFERENCES empleados(id);
