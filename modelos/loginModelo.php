<?php
require_once "mainModel.php";

class loginModelo extends mainModel{
    /*------ Modelo para iniciar sesion -------*/
    protected static function iniciar_sesion_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_usuario=:Usuario AND usuario_clave=:Clave AND usuario_estado='Activa'");
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->execute();
        return $sql;
    }
    
    /*------ Modelo para iniciar sesion para los club -------*/
    protected static function iniciar_sesion_club_modelo($datos){
        $sql = mainModel::conectar()->prepare("SELECT * FROM club WHERE club_correo=:Usuario AND club_clave=:Clave AND club_estado='activo'");
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->execute();
        return $sql;
    }
    
    /* Registrar bitacora inicio de sesion del sistema */
     protected static function registrar_bitacora_modelo($datos){
       
        $sql = mainModel::conectar()->prepare("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES (:Fecha, :Accion, :Usuario)");
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":Accion", $datos['Accion']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        
        $sql->execute();
        return $sql;
    }
}