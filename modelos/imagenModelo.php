<?php
require_once "mainModel.php";

class imagenModelo extends mainModel{
    /*------------- Modelo para agregar imagen -----------------*/
    protected static function agregar_imagen_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO imagen(asignacion_id, imagen_nombre) VALUES(:Asignacion, :Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Asignacion", $datos['Asignacion']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        
        return $sql;
    } /*Fin Modelo agregar imagen */
    
    /*------------- Modelo para eliminar imagen -----------------*/
    protected static function eliminar_imagen_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM imagen WHERE imagen_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar imagen*/
    
    /**** Modelo para obtener los datos de la imagen ********/
    protected static function datos_imagen_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM imagen WHERE imagen_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT imagen_id FROM imagen");
        }elseif($tipo=="Reporte"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM imagen");
        }
        
        $sql->execute();
        return $sql;
    } /* Fin modelo datos imagen*/
    
    
}