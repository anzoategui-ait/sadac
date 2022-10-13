<?php
require_once "mainModel.php";

class categoriaModelo extends mainModel{
    /** Modelo para agregar categoria **/
    protected static function agregar_categoria_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO categoria (categoria_nombre, categoria_descripcion) VALUES (:Nombre, :Descripcion)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar categoria*/
    
    /** Modelo para eliminar categoria **/
    protected static function eliminar_categoria_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM categoria WHERE categoria_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar categoria*/
    
    /** Modelo para obtener los datos del categoria **/
    protected static function datos_categoria_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM categoria WHERE categoria_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT categoria_id FROM categoria");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM categoria");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM categoria ORDER BY categoria_nombre ASC");
        }
        
        $sql->execute();
        return $sql;
    } /*Fin modelo datos categoria*/
    

    /**  Modelo para editar categoria **/
    protected static function actualizar_categoria_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE categoria SET categoria_nombre=:Nombre, categoria_descripcion=:Descripcion WHERE categoria_id=:ID");
        
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":ID", $datos['ID']);
        
        $sql->execute();
        return $sql;
    }

}
