<?php
require_once "mainModel.php";

class parroquiaModelo extends mainModel{
    /** Modelo para agregar parroquia **/
    protected static function agregar_parroquia_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO parroquia (parroquia_nombre, municipio_id) VALUES (:Nombre, :Municipio)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Municipio", $datos['Municipio']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar parroquia*/
    
   

    /** Modelo para eliminar parroquia **/
    protected static function eliminar_parroquia_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM parroquia WHERE parroquia_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar parroquia*/
    
     /** Modelo para eliminar usuario parroquia **/
    protected static function eliminar_usuario_parroquia_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM usuario_parroquia WHERE usuario_parroquia_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar parroquia*/
    
    

    /** Modelo para obtener los datos del parroquia **/
    protected static function datos_parroquia_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM parroquia WHERE parroquia_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT parroquia_id FROM parroquia");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM parroquia");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT parroquia.parroquia_id, parroquia.parroquia_nombre, municipio.municipio_nombre FROM parroquia INNER JOIN municipio ON parroquia.municipio_id=municipio.municipio_id");
        }elseif($tipo=="MunicipioParroquia"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM parroquia WHERE municipio_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="SectorParroquia"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM sector WHERE parroquia_id=:ID");
            $sql->bindParam(":ID", $id);
        }


        $sql->execute();
        return $sql;
    } /*Fin modelo datos parroquia*/


    /**  Modelo para editar parroquia **/
    protected static function actualizar_parroquia_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE parroquia SET parroquia_nombre=:Nombre, municipio_id=:Municipio WHERE parroquia_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Municipio", $datos['Municipio']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}
