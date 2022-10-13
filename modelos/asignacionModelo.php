<?php
require_once "mainModel.php";

class asignacionModelo extends mainModel{
    /** Modelo para agregar asignacion **/
    protected static function agregar_asignacion_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO asignacion (solicitud_actividad, asignado_a, asignado_por, asignacion_fecha, asignacion_observacion) VALUES (:Solicitud, :Operador, :Asignado, :Fecha, :Observacion)");
        //Agregar los marcadores
        $sql->bindParam(":Solicitud", $datos['Solicitud']);
        $sql->bindParam(":Operador", $datos['Operador']);
        $sql->bindParam(":Asignado", $datos['Asignado']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":Observacion", $datos['Observacion']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar asignacion*/

    /** Modelo para eliminar asignacion **/
    protected static function eliminar_asignacion_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM asignacion WHERE asignacion_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar asignacion*/

    /** Modelo para obtener los datos del asignacion **/
    protected static function datos_asignacion_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM asignacion WHERE asignacion_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT asignacion_id FROM asignacion");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM asignacion");
        }elseif($tipo=="Procesar"){
            $sql= mainModel::conectar()->prepare("SELECT asignacion.asignacion_id, solicitud_actividad.sol_act_id, solicitud_actividad.solicitud_id, solicitud_actividad.actividad_id, actividad.actividad_nombre,
             asignacion.asignacion_fecha FROM asignacion INNER JOIN solicitud_actividad
             ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON
             solicitud_actividad.actividad_id=actividad.actividad_id WHERE asignacion_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="SolicitudUsuario"){
            $sql= mainModel::conectar()->prepare("SELECT solicitud.solicitud_descripcion, usuario.usuario_nombre, usuario.usuario_telefono, usuario.usuario_email, usuario.usuario_direccion, parroquia.parroquia_nombre, municipio.municipio_nombre FROM solicitud INNER JOIN usuario ON solicitud.usuario_id=usuario.usuario_id INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE solicitud.solicitud_id=:ID");
            $sql->bindParam(":ID", $id);
        }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos asignacion*/


    /**  Modelo para editar asignacion **/
    protected static function actualizar_asignacion_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE asignacion SET asignacion_observacion=:Observacion WHERE asignacion_id=:ID");

        $sql->bindParam(":Observacion", $datos['Observacion']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }
    
      /*------------- Modelo para eliminar anexo -----------------*/
    protected static function eliminar_anexo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM pdf WHERE pdf_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar anexo*/

}
