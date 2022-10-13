<?php
require_once "mainModel.php";

class bitacoraModelo extends mainModel{
    /** Modelo para agregar bitacora **/
    protected static function agregar_bitacora_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO bitacora (bitacora_fecha, bitacora_accion, usuario_id) VALUES (:Fecha, :Accion, :Usuario)");
        //Agregar los marcadores
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":Accion", $datos['Accion']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar bitacora*/

}

