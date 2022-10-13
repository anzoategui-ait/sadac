<?php
require_once "mainModel.php";

class indicadorModelo extends mainModel{
    /** Modelo para agregar indicador **/
    protected static function agregar_indicador_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO indicador (indicador_nombre) VALUES (:Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar indicador*/

    /** Modelo para eliminar indicador **/
    protected static function eliminar_indicador_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM indicador WHERE indicador_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar indicador*/

    /** Modelo para obtener los datos del indicador **/
    protected static function datos_indicador_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM indicador WHERE indicador_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT indicador_id FROM indicador");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM indicador");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM indicador ORDER BY indicador_nombre ASC");
        }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos indicador*/


    /**  Modelo para editar indicador **/
    protected static function actualizar_indicador_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE indicador SET indicador_nombre=:Nombre WHERE indicador_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}
