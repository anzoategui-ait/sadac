<?php
require_once "mainModel.php";

class estudioModelo extends mainModel{
    /** Modelo para agregar estudio **/
    protected static function agregar_estudio_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO estudio (estudio_nombre_solicitante, estudio_tipo_documento, estudio_cedula_solicitante, 
        estudio_nacionalidad, estudio_estado_civil, estudio_telefono, estudio_lugar_nacimiento, estudio_estado_solicitante, estudio_fecha_nacimiento, 
        estudio_genero, estudio_direccion_permanente, estudio_municipio, estudio_parroquia, estudio_estado_direccion, estudio_fecha_solicitud, 
        estudio_grado_instruccion, estudio_trabaja, estudio_profesion, estudio_institucion_empresa, estudio_ocupacion, estudio_telefono_trabajo, 
        estudio_direccion_laboral, estudio_ingreso_familiar, estudio_observaciones, estudio_tipo_vivienda, estudio_tenencia_vivienda, 
        estudio_tipo_ayuda, estudio_sintesis, estudio_area_socioeconomica, estudio_conclusion, estudio_planilla_solicitud, estudio_copia_cedula, 
        estudio_informe_medico, estudio_rif, estudio_presupuesto, estudio_orden_medica, estudio_carta_gobernador, estudio_acta_nacimiento, 
        estudio_elaborado, estudio_nombre_elaborado, estudio_cedula_elaborado, estudio_supervisado, estudio_nombre_supervisado, estudio_cedula_supervisado, 
        estudio_aprobado, estudio_nombre_aprobado, estudio_cedula_aprobado) VALUES (:NombreSolicitante, :TipoDocumento, :CedulaSolicitante, 
        :Nacionalidad_solicitante, :Estado_civil, :Telefono_fax_celular, :Lugar_nacimiento_solicitante, :Estado_nacimiento, :Fecha_nacimiento, 
        :Genero, :Direccion_permanente, :Municipio, :Parroquia, :Estado, :FechaRegistro, :Grado_instruccion, :Trabaja, :Profesion, :Institucion, 
        :Ocupacion, :Telefono_trabajo, :Direccion_trabajo, :Ingreso_familiar, :Observaciones, :Tipo_vivienda, :Tenencia_vivienda, :Tipo_ayuda, 
        :Sintesis_caso, :Area_socioeconomica, :Conclusion, :Planilla_solicitud, :Copia_cedula, :Informe_medico, :Rif, :Presupuesto, :Orden_medica, :Carta, :Acta_nacimiento, 
        :Elaborado_por, :Nombre_apellido_elaborado, :Cedula_elaborado, :Supervisado_por, :Nombre_apellido_supervisado, :Cedula_supervisado, 
        :Aprobado_por, :Nombre_apellido_aprobado, :Cedula_aprobado)");
        //Agregar los marcadores
        //DATOS PERSONALES
        $sql->bindParam(":NombreSolicitante", $datos['NombreSolicitante']);
        $sql->bindParam(":TipoDocumento", $datos['TipoDocumento']);
        $sql->bindParam(":CedulaSolicitante", $datos['CedulaSolicitante']);
        $sql->bindParam(":Nacionalidad_solicitante", $datos['Nacionalidad_solicitante']);
        $sql->bindParam(":Estado_civil", $datos['Estado_civil']);
        $sql->bindParam(":Telefono_fax_celular", $datos['Telefono_fax_celular']);
        $sql->bindParam(":Lugar_nacimiento_solicitante", $datos['Lugar_nacimiento_solicitante']);
        $sql->bindParam(":Estado_nacimiento", $datos['Estado_nacimiento']);
        $sql->bindParam(":Fecha_nacimiento", $datos['Fecha_nacimiento']);
        $sql->bindParam(":Genero", $datos['Genero']);
        $sql->bindParam(":Direccion_permanente", $datos['Direccion_permanente']);
        $sql->bindParam(":Municipio", $datos['Municipio']);
        $sql->bindParam(":Parroquia", $datos['Parroquia']);
        $sql->bindParam(":Estado", $datos['Estado']);

        //GRADO INSTRUCCION
        $sql->bindParam(":Grado_instruccion", $datos['Grado_instruccion']);

        //ESTUDIO SOCIOECONOMICO
       $sql->bindParam(":Trabaja", $datos['Trabaja']);
       $sql->bindParam(":Profesion", $datos['Profesion']);
       $sql->bindParam(":Institucion", $datos['Institucion']);
       $sql->bindParam(":Ocupacion", $datos['Ocupacion']);
       $sql->bindParam(":Telefono_trabajo", $datos['Telefono_trabajo']);
       $sql->bindParam(":Direccion_trabajo", $datos['Direccion_trabajo']);
       $sql->bindParam(":Ingreso_familiar", $datos['Ingreso_familiar']);
       $sql->bindParam(":Observaciones", $datos['Observaciones']);

       //TIPO DE VIVIENDA Y TENECIA
       $sql->bindParam(":Tipo_vivienda", $datos['Tipo_vivienda']);
       $sql->bindParam(":Tenencia_vivienda", $datos['Tenencia_vivienda']);

       //ESTUDIO SOCIAL
       $sql->bindParam(":Tipo_ayuda", $datos['Tipo_ayuda']);
       $sql->bindParam(":Sintesis_caso", $datos['Sintesis_caso']);
       $sql->bindParam(":Area_socioeconomica", $datos['Area_socioeconomica']);
       $sql->bindParam(":Conclusion", $datos['Conclusion']);

       
       $sql->bindParam(":FechaRegistro", $datos['FechaRegistro']);
        
       //DOCUMENTOS ANEXOS
        $sql->bindParam(":Planilla_solicitud", $datos['Planilla_solicitud']);
        $sql->bindParam(":Copia_cedula", $datos['Copia_cedula']);
        $sql->bindParam(":Informe_medico", $datos['Informe_medico']);
        $sql->bindParam(":Rif", $datos['Rif']);
        $sql->bindParam(":Presupuesto", $datos['Presupuesto']);
        $sql->bindParam(":Orden_medica", $datos['Orden_medica']);
        $sql->bindParam(":Carta", $datos['Carta']);
        $sql->bindParam(":Acta_nacimiento", $datos['Acta_nacimiento']);

        //FIRMAS ESTUDIO SOCIAL
        $sql->bindParam(":Elaborado_por", $datos['Elaborado_por']);
        $sql->bindParam(":Nombre_apellido_elaborado", $datos['Nombre_apellido_elaborado']);
        $sql->bindParam(":Cedula_elaborado", $datos['Cedula_elaborado']);
        $sql->bindParam(":Supervisado_por", $datos['Supervisado_por']);
        $sql->bindParam(":Nombre_apellido_supervisado", $datos['Nombre_apellido_supervisado']);
        $sql->bindParam(":Cedula_supervisado", $datos['Cedula_supervisado']);
        $sql->bindParam(":Aprobado_por", $datos['Aprobado_por']);
        $sql->bindParam(":Nombre_apellido_aprobado", $datos['Nombre_apellido_aprobado']);
        $sql->bindParam(":Cedula_aprobado", $datos['Cedula_aprobado']);

        
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar estudio*/

     /** Modelo para agregar familiar **/
     protected static function agregar_familiar_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO familiar (familiar_nombre, familiar_cedula, estudio_cedula_solicitante, 
        familiar_lugar_nacimiento, familiar_fecha_nacimiento, familiar_genero, familiar_ocupacion, familiar_filiacion) VALUES 
        (:NombreFamiliar, :CedulaFamiliar, :CedulaSolicitante, :LugarNacimiento, :FechaNacimiento, :Genero, :Ocupacion, :Filiacion)");
        //Agregar los marcadores
        $sql->bindParam(":NombreFamiliar", $datos['NombreFamiliar']);
        $sql->bindParam(":CedulaFamiliar", $datos['CedulaFamiliar']);
        $sql->bindParam(":CedulaSolicitante", $datos['CedulaSolicitante']);

        $sql->bindParam(":Filiacion", $datos['Filiacion']);
        $sql->bindParam(":Ocupacion", $datos['Ocupacion']);
        $sql->bindParam(":LugarNacimiento", $datos['LugarNacimiento']);
        $sql->bindParam(":FechaNacimiento", $datos['FechaNacimiento']);
        $sql->bindParam(":Genero", $datos['Genero']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar estudio*/

    /** Modelo para eliminar estudio **/
    protected static function eliminar_estudio_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM estudio WHERE estudio_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar estudio*/

    /** Modelo para eliminar familiar **/
    protected static function eliminar_familiar_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM familiar WHERE familiar_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar familiar */

    /** Modelo para obtener los datos del estudio **/
    protected static function datos_estudio_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM estudio WHERE estudio_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT estudio_id FROM estudio");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM estudio");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM estudio ORDER BY estudio_nombre ASC");
        }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos estudio*/


    /**  Modelo para editar estudio **/
    protected static function actualizar_estudio_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE estudio SET estudio_nombre_solicitante=:NombreSolicitante, estudio_tipo_documento=:TipoDocumento, estudio_cedula_solicitante=:CedulaSolicitante, 
        estudio_nacionalidad=:Nacionalidad_solicitante, estudio_estado_civil=:Estado_civil, estudio_telefono=:Telefono_fax_celular, estudio_lugar_nacimiento=:Lugar_nacimiento_solicitante, estudio_estado_solicitante=:Estado_nacimiento, estudio_fecha_nacimiento=:Fecha_nacimiento, 
        estudio_genero=:Genero, estudio_direccion_permanente=:Direccion_permanente, estudio_municipio=:Municipio, estudio_parroquia=:Parroquia, estudio_estado_direccion=:Estado, 
        estudio_grado_instruccion=:Grado_instruccion, estudio_trabaja=:Trabaja, estudio_profesion=:Profesion, estudio_institucion_empresa=:Institucion, estudio_ocupacion=:Ocupacion, estudio_telefono_trabajo=:Telefono_trabajo, 
        estudio_direccion_laboral=:Direccion_trabajo, estudio_ingreso_familiar=:Ingreso_familiar, estudio_observaciones=:Observaciones, estudio_tipo_vivienda=:Tipo_vivienda, estudio_tenencia_vivienda=:Tenencia_vivienda, 
        estudio_tipo_ayuda=:Tipo_ayuda, estudio_sintesis=:Sintesis_caso, estudio_area_socioeconomica=:Area_socioeconomica, estudio_conclusion=:Conclusion, estudio_planilla_solicitud=:Planilla_solicitud, estudio_copia_cedula=:Copia_cedula, 
        estudio_informe_medico=:Informe_medico, estudio_rif=:Rif, estudio_presupuesto=:Presupuesto, estudio_orden_medica=:Orden_medica, estudio_carta_gobernador=:Carta, estudio_acta_nacimiento=:Acta_nacimiento, 
        estudio_elaborado=:Elaborado_por, estudio_nombre_elaborado=:Nombre_apellido_elaborado, estudio_cedula_elaborado=:Cedula_elaborado, estudio_supervisado=:Supervisado_por, estudio_nombre_supervisado=:Nombre_apellido_supervisado, estudio_cedula_supervisado=:Cedula_supervisado, 
        estudio_aprobado=:Aprobado_por, estudio_nombre_aprobado=:Nombre_apellido_aprobado, estudio_cedula_aprobado=:Cedula_aprobado WHERE estudio_id=:ID");

         //DATOS PERSONALES
         $sql->bindParam(":NombreSolicitante", $datos['NombreSolicitante']);
         $sql->bindParam(":TipoDocumento", $datos['TipoDocumento']);
         $sql->bindParam(":CedulaSolicitante", $datos['CedulaSolicitante']);
         $sql->bindParam(":Nacionalidad_solicitante", $datos['Nacionalidad_solicitante']);
         $sql->bindParam(":Estado_civil", $datos['Estado_civil']);
         $sql->bindParam(":Telefono_fax_celular", $datos['Telefono_fax_celular']);
         $sql->bindParam(":Lugar_nacimiento_solicitante", $datos['Lugar_nacimiento_solicitante']);
         $sql->bindParam(":Estado_nacimiento", $datos['Estado_nacimiento']);
         $sql->bindParam(":Fecha_nacimiento", $datos['Fecha_nacimiento']);
         $sql->bindParam(":Genero", $datos['Genero']);
         $sql->bindParam(":Direccion_permanente", $datos['Direccion_permanente']);
         $sql->bindParam(":Municipio", $datos['Municipio']);
         $sql->bindParam(":Parroquia", $datos['Parroquia']);
         $sql->bindParam(":Estado", $datos['Estado']);
 
         //GRADO INSTRUCCION
         $sql->bindParam(":Grado_instruccion", $datos['Grado_instruccion']);
 
         //ESTUDIO SOCIOECONOMICO
        $sql->bindParam(":Trabaja", $datos['Trabaja']);
        $sql->bindParam(":Profesion", $datos['Profesion']);
        $sql->bindParam(":Institucion", $datos['Institucion']);
        $sql->bindParam(":Ocupacion", $datos['Ocupacion']);
        $sql->bindParam(":Telefono_trabajo", $datos['Telefono_trabajo']);
        $sql->bindParam(":Direccion_trabajo", $datos['Direccion_trabajo']);
        $sql->bindParam(":Ingreso_familiar", $datos['Ingreso_familiar']);
        $sql->bindParam(":Observaciones", $datos['Observaciones']);
 
        //TIPO DE VIVIENDA Y TENECIA
        $sql->bindParam(":Tipo_vivienda", $datos['Tipo_vivienda']);
        $sql->bindParam(":Tenencia_vivienda", $datos['Tenencia_vivienda']);
 
        //ESTUDIO SOCIAL
        $sql->bindParam(":Tipo_ayuda", $datos['Tipo_ayuda']);
        $sql->bindParam(":Sintesis_caso", $datos['Sintesis_caso']);
        $sql->bindParam(":Area_socioeconomica", $datos['Area_socioeconomica']);
        $sql->bindParam(":Conclusion", $datos['Conclusion']);
 
        
        
         
        //DOCUMENTOS ANEXOS
         $sql->bindParam(":Planilla_solicitud", $datos['Planilla_solicitud']);
         $sql->bindParam(":Copia_cedula", $datos['Copia_cedula']);
         $sql->bindParam(":Informe_medico", $datos['Informe_medico']);
         $sql->bindParam(":Rif", $datos['Rif']);
         $sql->bindParam(":Presupuesto", $datos['Presupuesto']);
         $sql->bindParam(":Orden_medica", $datos['Orden_medica']);
         $sql->bindParam(":Carta", $datos['Carta']);
         $sql->bindParam(":Acta_nacimiento", $datos['Acta_nacimiento']);
 
         //FIRMAS ESTUDIO SOCIAL
         $sql->bindParam(":Elaborado_por", $datos['Elaborado_por']);
         $sql->bindParam(":Nombre_apellido_elaborado", $datos['Nombre_apellido_elaborado']);
         $sql->bindParam(":Cedula_elaborado", $datos['Cedula_elaborado']);
         $sql->bindParam(":Supervisado_por", $datos['Supervisado_por']);
         $sql->bindParam(":Nombre_apellido_supervisado", $datos['Nombre_apellido_supervisado']);
         $sql->bindParam(":Cedula_supervisado", $datos['Cedula_supervisado']);
         $sql->bindParam(":Aprobado_por", $datos['Aprobado_por']);
         $sql->bindParam(":Nombre_apellido_aprobado", $datos['Nombre_apellido_aprobado']);
         $sql->bindParam(":Cedula_aprobado", $datos['Cedula_aprobado']);

        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

}