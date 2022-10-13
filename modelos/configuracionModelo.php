<?php

require_once "mainModel.php";

class configuracionModelo extends mainModel {

    /** Modelo para agregar configuracion * */
    protected static function agregar_configuracion_modelo($datos) {
        $sql = mainModel::conectar()->prepare("INSERT INTO configuracion(configuracion_descripcion,"
                . " configuracion_valor) VALUES(:Descripcion, :Valor)");
        //Agregar los marcadores
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Valor", $datos['Valor']);
        $sql->execute();

        return $sql;
    }

/* Fin Modelo agregar configuracion */

    /** Modelo para obtener los datos del configuracion * */
    protected static function datos_configuracion_modelo($id) {
        $sql = mainModel::conectar()->prepare("SELECT * FROM configuracion WHERE configuracion_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }

/* Fin modelo datos configuracion */

    /**  Modelo para editar configuracion * */
    protected static function actualizar_configuracion_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE configuracion SET configuracion_descripcion=:Descripcion, "
                . "configuracion_valor=:Valor WHERE configuracion_id=:ID");
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Valor", $datos['Valor']);
        $sql->bindParam(":ID", $datos['ID']);
         $sql->execute();
        return $sql;
    }
    
     /** Modelo para eliminar configuracion **/
    protected static function eliminar_configuracion_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM configuracion WHERE configuracion_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar configuracion*/

}
