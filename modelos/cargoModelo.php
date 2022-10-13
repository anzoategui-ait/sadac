<?php
require_once "mainModel.php";

class cargoModelo extends mainModel{
    /** Modelo para agregar cargo **/
    protected static function agregar_cargo_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO cargo (cargo_nombre, direccion_id) VALUES (:Nombre, :Direccion)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar cargo*/
    
   

    /** Modelo para eliminar cargo **/
    protected static function eliminar_cargo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM cargo WHERE cargo_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar cargo*/
    
     /** Modelo para eliminar usuario cargo **/
    protected static function eliminar_usuario_cargo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM usuario_cargo WHERE usuario_cargo_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar cargo*/
    
    

    /** Modelo para obtener los datos del cargo **/
    protected static function datos_cargo_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM cargo WHERE cargo_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT cargo_id FROM cargo");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM cargo");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT cargo.cargo_id, cargo.cargo_nombre, direccion.direccion_nombre FROM cargo INNER JOIN direccion ON cargo.direccion_id=direccion.direccion_id");
        }


        $sql->execute();
        return $sql;
    } /*Fin modelo datos cargo*/


    /**  Modelo para editar cargo **/
    protected static function actualizar_cargo_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE cargo SET cargo_nombre=:Nombre, direccion_id=:Direccion WHERE cargo_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}
