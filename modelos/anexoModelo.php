<?php
require_once "mainModel.php";

class anexoModelo extends mainModel{
    /*------------- Modelo para agregar anexo -----------------*/
    protected static function agregar_anexo_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO anexo(anexo_nombre, anexo_archivo, paso_id) VALUES (:Nombre, :Archivo, :Paso)");
        //Agregar los marcadores
        $sql->bindParam(":Paso", $datos['Paso']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Archivo", $datos['Archivo']);
        $sql->execute();

        return $sql;
    } /*Fin Modelo agregar anexo */

    /*------------- Modelo para eliminar anexo -----------------*/
    protected static function eliminar_anexo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM anexo WHERE anexo_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar anexo*/

    /**** Modelo para obtener los datos de la anexo ********/
    protected static function datos_anexo_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM anexo WHERE anexo_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT anexo_id FROM anexo");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM anexo ORDER BY anexo_id ASC");
        }

        $sql->execute();
        return $sql;
    } /* Fin modelo datos anexo*/

}
