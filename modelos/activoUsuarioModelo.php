<?php
require_once "mainModel.php";

class activoUsuarioModelo extends mainModel{

    /*------------- Modelo para agregar -----------------*/
    protected static function agregar_activo_usuario_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO activo_usuario(activo_codigo, usuario_cedula, activo_usuario_concepto, activo_usuario_tipo, activo_usuario_fecha) VALUES (:Codigo, :Cedula, :Concepto, :Tipo, :Fecha)");
        //Agregar los marcadores
        $sql->bindParam(":Codigo", $datos['Codigo']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Concepto", $datos['Concepto']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->execute();

        return $sql;
    }
    /*Fin Modelo agregar*/
    
    /* Modelo para agregar un usuario un equipo */
    protected static function activo_usuario_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO activo_usuario_status(usuario_cedula, producto_codigo, estado) VALUES (:Cedula, :Codigo, :Tipo)");
        //Agregar los marcadores
        $sql->bindParam(":Codigo", $datos['Codigo']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->execute();

        return $sql;
    }
    /* Fin modelo */
    
     /* Modelo para agregar un usuario un equipo */
    protected static function actualizar_activo_usuario_modelo($datos){
      
        $sql= mainModel::conectar()->prepare("UPDATE activo_usuario_status SET estado=:Tipo WHERE usuario_cedula=:Cedula AND producto_codigo=:Codigo");

        $sql->bindParam(":Codigo", $datos['Codigo']);
        $sql->bindParam(":Cedula", $datos['Cedula']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->execute();

        $sql->execute();
        return $sql;
    }
    /* Fin modelo */

    /*------------- Modelo para eliminar -----------------*/
    protected static function eliminar_activo_usuario_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM activo_usuario_status WHERE activo_usuario_status_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar  */

    /**** Modelo para obtener los datos ********/
    protected static function datos_activo_usuario_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM activoUsuario WHERE activoUsuario_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT activoUsuario_id FROM activoUsuario");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM activoUsuario ORDER BY activoUsuario_nombre ASC");
        }elseif($tipo=="Reporte"){
            $sql= mainModel::conectar()->prepare("SELECT activoUsuario_id, activoUsuario_nombre FROM activoUsuario ORDER BY activoUsuario_nombre ASC");
        }


        $sql->execute();
        return $sql;
    } /* Fin modelo datos */


  
}
