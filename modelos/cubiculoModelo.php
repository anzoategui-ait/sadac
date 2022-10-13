<?php
require_once "mainModel.php";

class cubiculoModelo extends mainModel{
    /** Modelo para agregar cubiculo **/
    protected static function agregar_cubiculo_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO cubiculo (cubiculo_nombre, usuario_id) VALUES (:Nombre, :usuario)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar cubiculo*/
    
   

    /** Modelo para eliminar cubiculo **/
    protected static function eliminar_cubiculo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM cubiculo WHERE cubiculo_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar cubiculo*/
    
     /** Modelo para eliminar usuario cubiculo **/
    protected static function eliminar_usuario_cubiculo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM usuario_cubiculo WHERE usuario_cubiculo_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar cubiculo*/
    
    

    /** Modelo para obtener los datos del cubiculo **/
    protected static function datos_cubiculo_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM cubiculo WHERE cubiculo_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT cubiculo_id FROM cubiculo");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM cubiculo");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT cubiculo.cubiculo_id, cubiculo.cubiculo_nombre, usuario.usuario_nombre FROM cubiculo INNER JOIN usuario ON cubiculo.usuario_id=usuario.usuario_id");
        }


        $sql->execute();
        return $sql;
    } /*Fin modelo datos cubiculo*/


    /**  Modelo para editar cubiculo **/
    protected static function actualizar_cubiculo_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE cubiculo SET cubiculo_nombre=:Nombre, usuario_id=:usuario WHERE cubiculo_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":usuario", $datos['usuario']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}
