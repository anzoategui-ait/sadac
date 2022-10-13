<?php
require_once "mainModel.php";

class solicitudModelo extends mainModel{
    
    /**  Modelo para actualizar la tabla solicitud estado * */
    protected static function actualizar_solicitud_estado_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE solicitud SET solicitud_estado=:Estado WHERE solicitud_id=:ID");

        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }
    
    protected static function agregar_solicitud_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO solicitud (usuario_id, solicitud_inicio, solicitud_estado, solicitud_descripcion) VALUES (:Usuario, :Inicio, :Estado, :Descripcion)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->execute();
        return $sql;
    }
    
    /** Modelo para agregar solicitud **/
    protected static function agregar_evaluacion_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO feedback (usuario_id, solicitud_id, feedback_descripcion, feedback_tiempo_respuesta, feedback_tipo_solucion, feedback_fecha) VALUES (:Usuario, :Solicitud, :Descripcion, :Tiempo, :Tipo, :Fecha)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Solicitud", $datos['Solicitud']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":Tiempo", $datos['Tiempo']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar solicitud*/
    
       /** Modelo para agregar solicitud - actividad **/
    protected static function agregar_solicitud_actividad_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO solicitud_actividad (solicitud_id, actividad_id, solicitud_estado, solicitud_fin) VALUES (:Solicitud, :Actividad, :Estado, :Fin)");
        //Agregar los marcadores
        $sql->bindParam(":Solicitud", $datos['Solicitud']);
        $sql->bindParam(":Actividad", $datos['Actividad']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Fin", $datos['Fin']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar solicitud - actividad*/

    /** Modelo para eliminar solicitud **/
    protected static function eliminar_solicitud_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM solicitud WHERE solicitud_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar solicitud*/
    
     /** Modelo para eliminar solicitud **/
    protected static function eliminar_solicitud_actividad_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM solicitud_actividad WHERE solicitud_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar solicitud*/
    
     protected static function eliminar_evaluacion_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM feedback WHERE feedback_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }
    

    /** Modelo para obtener los datos del solicitud **/
    protected static function datos_solicitud_modelo($tipo, $id)
    {
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM solicitud WHERE solicitud_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT solicitud_id FROM solicitud");
        }elseif($tipo=="Lista"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM solicitud");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM solicitud ORDER BY solicitud_descripcion ASC");
        }elseif($tipo=="Solicitud_Actividad"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM solicitud_actividad WHERE solicitud_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Solicitud"){
            $sql= mainModel::conectar()->prepare("SELECT solicitud.solicitud_id, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono FROM solicitud INNER JOIN usuario ON solicitud.usuario_id=usuario.usuario_id WHERE solicitud_estado='sin asignar' ORDER BY solicitud_inicio ASC");
            }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos solicitud*/
    
    
    /* Obtener solicitudes creadas en la base de datos */
      protected static function datos_solicitud_ciudadano_modelo($tipo, $datos)
    {
      if($tipo == "solicitudes-ciudadano-maximas") {
          $sql = mainModel::conectar()->prepare("SELECT solicitud_id FROM solicitud WHERE usuario_id=:Usuario AND solicitud_inicio>=:Inicio AND solicitud_inicio<:Fin");
          $sql->bindParam(":Inicio", $datos['Inicio']);
          $sql->bindParam(":Fin", $datos['Fin']);
          $sql->bindParam(":Usuario", $datos['Usuario']);
          }elseif($tipo == "solicitudes-maximas") {
          $sql = mainModel::conectar()->prepare("SELECT solicitud_id FROM solicitud WHERE solicitud_inicio>=:Inicio AND solicitud_inicio<:Fin");
          $sql->bindParam(":Inicio", $datos['Inicio']);
          $sql->bindParam(":Fin", $datos['Fin']);
          }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos solicitud*/


    /**  Modelo para editar solicitud **/
    protected static function actualizar_solicitud_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE solicitud SET usuario_id=:Usuario, solicitud_inicio=:Inicio, solicitud_estado=:Estado, solicitud_descripcion=:Descripcion WHERE solicitud_id=:ID");

        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_solicitud_ciudadano_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE solicitud SET usuario_id=:Usuario, solicitud_inicio=:Inicio, solicitud_estado=:Estado WHERE solicitud_id=:ID");

        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_solicitud_estado_script($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE solicitud SET solicitud_estado=:Estado WHERE solicitud_id=:ID");

        //Agregar los marcadores
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }
    
    /*------------- Modelo para agregar usuario -----------------*/
    protected static function agregar_usuario_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario(usuario_dni, usuario_nombre,"
                . " usuario_apellido, usuario_telefono, usuario_direccion, usuario_email, "
                . "usuario_usuario, usuario_clave, usuario_estado, usuario_privilegio, usuario_imagen, usuario_tipo, usuario_genero, usuario_fecha_nacimiento) VALUES(:DNI, :Nombre, :Apellido, :Telefono, "
                . ":Direccion, :Email, :Usuario, :Clave, :Estado, :Privilegio, :Imagen, :Tipo, :Genero, :Fecha)");
        //Agregar los marcadores
        $sql->bindParam(":DNI", $datos['DNI']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Privilegio", $datos['Privilegio']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":Genero", $datos['Genero']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->execute();
        
        return $sql;
    }
    /*Fin Modelo agregar usuario*/
    
       /** Modelo para agregar relacion usuario parroquia **/
    protected static function agregar_usuario_parroquia_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario_parroquia(usuario_id, parroquia_id) VALUES (:Usuario, :Parroquia)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Parroquia", $datos['Parroquia']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar parroquia*/
    
       /** Modelo para agregar relacion usuario sector **/
    protected static function agregar_usuario_sector_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario_sector(usuario_id, sector_id) VALUES (:Usuario, :Sector)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Sector", $datos['Sector']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar sector*/
    
       /** Modelo para agregar relacion usuario sector **/
    protected static function agregar_solicitud_gabinete_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO solicitud_gabinete(solicitud_id, gabinete_id) VALUES (:Solicitud, :Gabinete)");
        //Agregar los marcadores
        $sql->bindParam(":Solicitud", $datos['Solicitud']);
        $sql->bindParam(":Gabinete", $datos['Gabinete']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar sector*/
    
    
     protected static function agregar_solicitud_direccion_modelo($datos)
     {
        $sql=mainModel::conectar()->prepare("INSERT INTO solicitud_direccion(solicitud_id, direccion_id) VALUES (:Solicitud, :Direccion)");
        //Agregar los marcadores
        $sql->bindParam(":Solicitud", $datos['Solicitud']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->execute();
        return $sql;
    }

        protected static function agregar_asignacion_modelo($datos)
        {
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
    
    protected static function actualizar_mapa_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE mapa SET mapa_cantidad=:Cantidad WHERE mapa_id=:ID");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        //$sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

    //Actualizar el mapa del modelo solo el porcentaje
    protected static function actualizar_mapa_porcentaje_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE mapa SET mapa_porcentaje=:Porcentaje WHERE mapa_id=:Indicador");

        //Agregar los marcadores
        //$sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Indicador", $datos['Indicador']);

        $sql->execute();
        return $sql;
    }
    
    protected static function agregar_mapa_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO mapa (municipio_id, municipio_nombre, mapa_cantidad, mapa_porcentaje, mapa_year) VALUES (:MunicipioID, :Nombre, :Cantidad, :Porcentaje, :Year)");
        //Agregar los marcadores
        $sql->bindParam(":MunicipioID", $datos['MunicipioID']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar asignacion*/
    
    //Modelo para agregar datos a la tabla grafica solicitud
    protected static function agregar_grafica_solicitud_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO grafica_solicitud (grafica_solicitud_year, grafica_solicitud_mes_id, grafica_solicitud_solicitadas, grafica_solicitud_finalizadas) VALUES (:Year, :Mes, :Solicitadas, :Finalizadas)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Mes", $datos['Mes']);
        $sql->bindParam(":Solicitadas", $datos['Solicitadas']);
        $sql->bindParam(":Finalizadas", $datos['Finalizadas']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar asignacion*/
    
    protected static function actualizar_grafica_solicitadas_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE grafica_solicitud SET grafica_solicitud_solicitadas=grafica_solicitud_solicitadas + :Cantidad WHERE grafica_solicitud_year=:Year AND grafica_solicitud_mes_id=:Mes");

        //Agregar los marcadores
         $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Mes", $datos['Mes']);

        $sql->execute();
        return $sql;
    }
    
     protected static function agregar_actividad_home_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO home_actividad (home_actividad_year, home_actividad_cantidad, home_actividad_porcentaje, actividad_id, actividad_nombre) VALUES (:Year, :Cantidad, :Porcentaje, :ActividadID, :Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":ActividadID", $datos['ActividadID']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        return $sql;
    }

  
    protected static function agregar_indicador_home_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO home_indicador (home_indicador_year, home_indicador_cantidad, home_indicador_porcentaje, indicador_id, indicador_nombre) VALUES (:Year, :Cantidad, :Porcentaje, :IndicadorID, :Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":IndicadorID", $datos['IndicadorID']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        return $sql;
    }
    
    protected static function agregar_gabinete_home_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO home_gabinete (home_gabinete_year, home_gabinete_cantidad, home_gabinete_porcentaje, gabinete_id, gabinete_nombre) VALUES (:Year, :Cantidad, :Porcentaje, :GabineteID, :Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":GabineteID", $datos['GabineteID']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        return $sql;
    }
    
     protected static function agregar_direccion_home_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO home_direccion (home_direccion_year, home_direccion_cantidad, home_direccion_porcentaje, direccion_id, direccion_nombre) VALUES (:Year, :Cantidad, :Porcentaje, :DireccionID, :Nombre)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":DireccionID", $datos['DireccionID']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_actividad_home_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_actividad SET home_actividad_cantidad=home_actividad_cantidad + :Cantidad WHERE home_actividad_year=:Year AND actividad_id=:Actividad");

        //Agregar los marcadores
         $sql->bindParam(":Cantidad", $datos['Cantidad']);
        // $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Actividad", $datos['Actividad']);

        $sql->execute();
        return $sql;
    }

    protected static function actualizar_actividad_porcentaje_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_actividad SET home_actividad_porcentaje = :Porcentaje WHERE home_actividad_id=:Indicador");

        //Agregar los marcadores
         $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Indicador", $datos['Indicador']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_indicador_home_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_indicador SET home_indicador_cantidad=home_indicador_cantidad + :Cantidad WHERE home_indicador_year=:Year AND indicador_id=:Indicador");

        //Agregar los marcadores
         $sql->bindParam(":Cantidad", $datos['Cantidad']);
      //   $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Indicador", $datos['Indicador']);

        $sql->execute();
        return $sql;
    }

    //Modelo para actualizar el porcentaje del indicador solamente
    protected static function actualizar_indicador_porcentaje_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_indicador SET home_indicador_porcentaje=:Porcentaje WHERE home_indicador_id=:Indicador");

        //Agregar los marcadores
        $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Indicador", $datos['Indicador']);

        $sql->execute();
        return $sql;
    }
    //Fin actualizar
    
    protected static function actualizar_gabinete_home_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_gabinete SET home_gabinete_cantidad=home_gabinete_cantidad + :Cantidad WHERE home_gabinete_year=:Year AND gabinete_id=:Gabinete");

        //Agregar los marcadores
         $sql->bindParam(":Cantidad", $datos['Cantidad']);
        // $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Gabinete", $datos['Gabinete']);

        $sql->execute();
        return $sql;
    }

    protected static function actualizar_gabinete_porcentaje_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_gabinete SET home_gabinete_porcentaje = :Porcentaje WHERE home_gabinete_id=:Indicador");

        //Agregar los marcadores
         $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Indicador", $datos['Indicador']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_direccion_home_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_direccion SET home_direccion_cantidad=home_direccion_cantidad + :Cantidad WHERE home_direccion_year=:Year AND direccion_id=:Direccion");

        //Agregar los marcadores
         $sql->bindParam(":Cantidad", $datos['Cantidad']);
        // $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Direccion", $datos['Direccion']);

        $sql->execute();
        return $sql;
    }

    protected static function actualizar_direccion_porcentaje_modelo($datos)
    {
        $sql= mainModel::conectar()->prepare("UPDATE home_direccion SET home_direccion_porcentaje = :Porcentaje WHERE direccion_id=:Indicador");

        //Agregar los marcadores
         $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Indicador", $datos['Indicador']);

        $sql->execute();
        return $sql;
    }
    
}