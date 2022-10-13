<?php
require_once "mainModel.php";

class direccionModelo extends mainModel{

    /*------------- Modelo para agregar -----------------*/
    protected static function agregar_direccion_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO direccion(direccion_nombre, direccion_imagen, gabinete_id) VALUES (:Nombre, :Imagen, :Gabinete)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Gabinete", $datos['Gabinete']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->execute();

        return $sql;
    }
    /*Fin Modelo agregar*/

    /*------------- Modelo para eliminar -----------------*/
    protected static function eliminar_direccion_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM direccion WHERE direccion_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

    /**** Modelo para obtener los datos ********/
    protected static function datos_direccion_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM direccion WHERE direccion_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT direccion_id FROM direccion");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM direccion ORDER BY direccion_nombre ASC");
        }elseif($tipo=="GabineteDireccion"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM direccion WHERE gabinete_id=:ID");
            $sql->bindParam(":ID", $id);
        }

        $sql->execute();
        return $sql;
    } /* Fin modelo datos */


    /******  Modelo para editar ******/
    protected static function actualizar_direccion_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE direccion SET "
            . "direccion_nombre=:Nombre, direccion_imagen=:Imagen, gabinete_id=:Gabinete WHERE direccion_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Gabinete", $datos['Gabinete']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;

    }
}
