<?php
require_once "mainModel.php";

class kategoriaModelo extends mainModel{
    /* Modelo para agregar kategoria */
    /*------------- Modelo para agregar kategoria -----------------*/
    protected static function agregar_kategoria_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO kategoria(kategoria_nombre, kategoria_ubicacion) VALUES (:Nombre, :Ubicacion)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Ubicacion", $datos['Ubicacion']);
        $sql->execute();
        
        return $sql;
    }
    /*Fin Modelo agregar kategoria*/
    
     /*------------- Modelo para eliminar kategoria -----------------*/
    protected static function eliminar_kategoria_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM kategoria WHERE kategoria_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }
    /*Fin Modelo eliminar kategoria*/
    
    /*--------------- Modelo para obtener los datos del kategoria -----------------*/
    protected static function datos_kategoria_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM kategoria WHERE kategoria_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT kategoria_id FROM kategoria");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM kategoria ORDER BY kategoria_nombre ASC");
        }
        
        $sql->execute();
        return $sql;
    } /* Fin modelo datos kategoria*/
    
    /******  Modelo para editar kategoria ******/
    protected static function actualizar_kategoria_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE kategoria SET kategoria_nombre=:nombre,kategoria_ubicacion=:ubicacion WHERE kategoria_id=:id");
    
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":ubicacion", $datos['ubicacion']);
        $sql->bindParam(":id", $datos['id']);
        
        $sql->execute();
        return $sql;
        
    }
}