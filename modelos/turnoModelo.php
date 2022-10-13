<?php
require_once "mainModel.php";

class turnoModelo extends mainModel{

    /*------------- Modelo para agregar -----------------*/
    protected static function agregar_turno_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO turno(turno_nombre, turno_descripcion, turno_cedula, turno_fecha, turno_fecha_login, turno_estado) VALUES (:Nombre, :Descripcion, :Cedula, :Fecha, :FechaLogin, :Estado)");
        //Agregar los marcadores
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":FechaLogin", $datos['FechaLogin']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->execute();

        return $sql;
    }
    /*Fin Modelo agregar*/

    /*------------- Modelo para eliminar -----------------*/
    protected static function eliminar_turno_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM turno WHERE turno_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

     /*------------- Modelo para eliminar -----------------*/
     protected static function atender_turno_modelo($id){
        $sql= mainModel::conectar()->prepare("UPDATE turno SET turno_estado='finalizar' WHERE turno_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

    protected static function finalizar_turno_modelo($id){
        $sql= mainModel::conectar()->prepare("UPDATE turno SET turno_estado='finalizado' WHERE turno_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

    protected static function registrar_turno_usuario_modelo($turno, $usuario, $mostrar){
        $sql= mainModel::conectar()->prepare("INSERT INTO turno_usuario(turno_id, usuario_id, turno_usuario_mostrar) VALUES (:Turno, :Usuario, :Mostrar) ");
        $sql->bindParam(":Turno", $turno);
        $sql->bindParam(":Usuario", $usuario);
        $sql->bindParam(":Mostrar", $mostrar);
        $sql->execute();
        return $sql;
    }

    /**** Modelo para obtener los datos ********/
    protected static function datos_turno_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM turno WHERE turno_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT turno_id FROM turno");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM turno ORDER BY turno_nombre ASC");
        }elseif($tipo=="Reporte"){
            $sql= mainModel::conectar()->prepare("SELECT turno_id, turno_nombre FROM turno ORDER BY turno_nombre ASC");
        }


        $sql->execute();
        return $sql;
    } /* Fin modelo datos */


    /******  Modelo para editar ******/
    protected static function actualizar_turno_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE turno SET "
            . "turno_nombre=:Nombre, turno_descripcion=:Descripcion, turno_cedula=:Cedula, turno_fecha=:Fecha, turno_estado=:Estado WHERE turno_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;

    }
}
