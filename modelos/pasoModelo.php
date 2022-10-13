<?php
require_once "mainModel.php";

class pasoModelo extends mainModel{

    /*------------- Modelo para agregar -----------------*/
    protected static function agregar_paso_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO paso(paso_nombre, paso_duracion, actividad_id) VALUES (:Nombre, :Duracion, :Actividad)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Duracion", $datos['Duracion']);
        $sql->bindParam(":Actividad", $datos['Actividad']);
        $sql->execute();

        return $sql;
    }
    /*Fin Modelo agregar*/

    /*------------- Modelo para eliminar -----------------*/
    protected static function eliminar_paso_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM paso WHERE paso_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

    /**** Modelo para obtener los datos ********/
    protected static function datos_paso_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM paso WHERE paso_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT paso_id FROM paso");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM paso ORDER BY paso_id ASC");
        }elseif($tipo=="Procesar-Pasos"){
            $sql= mainModel::conectar()->prepare("SELECT paso_id, paso_nombre FROM paso WHERE actividad_id=:ID");
            $sql->bindParam(":ID", $id);
        }

        $sql->execute();
        return $sql;
    } /* Fin modelo datos */


    /******  Modelo para editar ******/
    protected static function actualizar_paso_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE paso SET "
            . "paso_nombre=:Nombre, paso_duracion=:Duracion, actividad_id=:Actividad WHERE paso_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Duracion", $datos['Duracion']);
        $sql->bindParam(":Actividad", $datos['Actividad']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;

    }
}
