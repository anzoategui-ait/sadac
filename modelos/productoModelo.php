<?php
require_once "mainModel.php";

class productoModelo extends mainModel{
    /* Modelo para agregar producto */
    /*------------- Modelo para agregar producto -----------------*/
    protected static function agregar_producto_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO producto(producto_codigo,producto_nombre, producto_unidad, producto_precio,producto_stock,producto_foto,kategoria_id,usuario_id) VALUES (:codigo,:nombre,:unidad,:precio,:stock,:foto,:categoria,:usuario)");
        //Agregar los marcadores
        $sql->bindParam(":codigo", $datos['codigo']);
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":unidad", $datos['unidad']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":stock", $datos['stock']);
        $sql->bindParam(":foto", $datos['foto']);
        $sql->bindParam(":categoria", $datos['categoria']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->execute();
        
        return $sql;
    }
    /*Fin Modelo agregar producto*/
    
     /*------------- Modelo para eliminar producto -----------------*/
    protected static function eliminar_producto_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM producto WHERE producto_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }
    /*Fin Modelo eliminar producto*/
    
    /*--------------- Modelo para obtener los datos del producto -----------------*/
    protected static function datos_producto_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM producto WHERE producto_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT producto_id FROM producto");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM producto ORDER BY producto_nombre ASC");
        }elseif($tipo=="TodosCantidad"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM producto ORDER BY producto_stock DESC");
        }
        
        $sql->execute();
        return $sql;
    } /* Fin modelo datos producto*/
    
    /******  Modelo para editar producto ******/
    protected static function actualizar_producto_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE producto SET producto_codigo=:codigo,producto_nombre=:nombre,producto_unidad=:unidad,producto_precio=:precio,producto_stock=:stock,kategoria_id=:categoria WHERE producto_id=:id");  
        $sql->bindParam(":codigo", $datos['codigo']);
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":unidad", $datos['unidad']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":stock", $datos['stock']);
        $sql->bindParam(":categoria", $datos['categoria']);
        $sql->bindParam(":id", $datos['id']);
        
        $sql->execute();
        return $sql;
        
    }
    
    protected static function actualizar_imagen_producto_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE producto SET producto_foto=:foto WHERE producto_id=:id");  
        $sql->bindParam(":foto", $datos['foto']);
        $sql->bindParam(":id", $datos['id']);
        
        $sql->execute();
        return $sql;
    }
}