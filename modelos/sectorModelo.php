<?php
require_once "mainModel.php";

class sectorModelo extends mainModel{
    /** Modelo para agregar sector **/
    protected static function agregar_sector_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO sector (sector_nombre, parroquia_id) VALUES (:Nombre, :Parroquia)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Parroquia", $datos['Parroquia']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar sector*/
    
   

    /** Modelo para eliminar sector **/
    protected static function eliminar_sector_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM sector WHERE sector_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar sector*/
    
     /** Modelo para eliminar usuario sector **/
    protected static function eliminar_usuario_sector_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM usuario_sector WHERE usuario_sector_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar sector*/
    
    

    /** Modelo para obtener los datos del sector **/
    protected static function datos_sector_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM sector WHERE sector_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT sector_id FROM sector");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM sector");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT sector.sector_id, sector.sector_nombre, parroquia.parroquia_nombre FROM sector INNER JOIN parroquia ON sector.parroquia_id=parroquia.parroquia_id");
        }elseif($tipo=="SectorParroquia"){
            $sql= mainModel::conectar()->prepare("SELECT sector.sector_id, sector.sector_nombre, parroquia.parroquia_nombre FROM sector INNER JOIN parroquia ON sector.parroquia_id=parroquia.parroquia_id WHERE parroquia.parroquia_id=:ID");
            $sql->bindParam(":ID", $id);
        }


        $sql->execute();
        return $sql;
    } /*Fin modelo datos sector*/


    /**  Modelo para editar sector **/
    protected static function actualizar_sector_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE sector SET sector_nombre=:Nombre, parroquia_id=:Parroquia WHERE sector_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Parroquia", $datos['Parroquia']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}