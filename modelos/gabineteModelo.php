<?php
require_once "mainModel.php";

class gabineteModelo extends mainModel{
    /** Modelo para agregar gabinete **/
    protected static function agregar_gabinete_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO gabinete (gabinete_nombre) VALUES (:Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar gabinete*/

    /** Modelo para eliminar gabinete **/
    protected static function eliminar_gabinete_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM gabinete WHERE gabinete_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar gabinete*/

    /** Modelo para obtener los datos del gabinete **/
    protected static function datos_gabinete_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM gabinete WHERE gabinete_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT gabinete_id FROM gabinete");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM gabinete");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM gabinete ORDER BY gabinete_nombre ASC");
        }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos gabinete*/


    /**  Modelo para editar gabinete **/
    protected static function actualizar_gabinete_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE gabinete SET gabinete_nombre=:Nombre WHERE gabinete_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}
