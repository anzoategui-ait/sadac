<?php
require_once "mainModel.php";

class municipioModelo extends mainModel{
    /*------------- Modelo para agregar municipio -----------------*/
    protected static function agregar_municipio_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO municipio(municipio_nombre) VALUES(:Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        
        return $sql;
    } /*Fin Modelo agregar municipio */
    
    /*------------- Modelo para eliminar municipio -----------------*/
    protected static function eliminar_municipio_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM municipio WHERE municipio_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar municipio*/
    
    /**** Modelo para obtener los datos de la municipio ********/
    protected static function datos_municipio_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM municipio WHERE municipio_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT municipio_id FROM municipio");
        }elseif($tipo=="Reporte"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM municipio");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM municipio");
        }
        
        $sql->execute();
        return $sql;
    } /* Fin modelo datos municipio*/
    
    /******  Modelo para editar municipio ******/
    protected static function actualizar_municipio_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE municipio SET municipio_nombre=:Nombre WHERE municipio_id=:ID");
    
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":ID", $datos['ID']);
        
        $sql->execute();
        return $sql;
    }
    
}