<?php
require_once "mainModel.php";

class actividadModelo extends mainModel{

    /*------------- Modelo para agregar -----------------*/
    protected static function agregar_actividad_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO actividad(actividad_nombre, actividad_descripcion, actividad_imagen, categoria_id, indicador_id) VALUES (:Nombre, :Descripcion, :Imagen, :Categoria, :Indicador)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":Categoria", $datos['Categoria']);
        $sql->bindParam(":Indicador", $datos['Indicador']);
        $sql->execute();

        return $sql;
    }
    /*Fin Modelo agregar*/

    /*------------- Modelo para eliminar -----------------*/
    protected static function eliminar_actividad_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM actividad WHERE actividad_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

    /**** Modelo para obtener los datos ********/
    protected static function datos_actividad_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM actividad WHERE actividad_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT actividad_id FROM actividad");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM actividad ORDER BY actividad_nombre ASC");
        }elseif($tipo=="Reporte"){
            $sql= mainModel::conectar()->prepare("SELECT actividad_id, actividad_nombre FROM actividad ORDER BY actividad_nombre ASC");
        }elseif($tipo=="TodosReporte"){
            $sql= mainModel::conectar()->prepare("SELECT actividad.actividad_id, actividad.actividad_nombre, actividad.actividad_descripcion, indicador.indicador_nombre FROM actividad INNER JOIN indicador ON actividad.indicador_id = indicador.indicador_id ORDER BY actividad.actividad_nombre ASC");
        }


        $sql->execute();
        return $sql;
    } /* Fin modelo datos */


    /******  Modelo para editar ******/
    protected static function actualizar_actividad_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE actividad SET "
            . "actividad_nombre=:Nombre, actividad_descripcion=:Descripcion, actividad_imagen=:Imagen, categoria_id=:Categoria, indicador_id=:Indicador WHERE actividad_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":Categoria", $datos['Categoria']);
        $sql->bindParam(":Indicador", $datos['Indicador']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;

    }
}
