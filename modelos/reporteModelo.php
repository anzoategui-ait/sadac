<?php

require_once "mainModel.php";

class reporteModelo extends mainModel {
     /** Modelo para obtener los datos del estudio social **/
     protected static function datos_estudio_social_modelo($cedula)
     {
           $sql= mainModel::conectar()->prepare("SELECT * FROM estudio WHERE estudio_cedula_solicitante=:CEDULA");
           $sql->bindParam(":CEDULA", $cedula);  
        
         $sql->execute();
         return $sql;
     } /*Fin modelo datos estudio social*/

     /** Modelo para obtener los datos del estudio social **/
     protected static function datos_familiares_modelo($cedula)
     {
           $sql= mainModel::conectar()->prepare("SELECT * FROM familiar WHERE estudio_cedula_solicitante=:CEDULA");
           $sql->bindParam(":CEDULA", $cedula);  
        
         $sql->execute();
         return $sql;
     } /*Fin modelo datos estudio social*/

    //Modelo para obtener el total de las solicitudes en un periodo de tiempo definido
    protected static function obtener_totalizacion_modelo($datos){
        
        $sql = mainModel::conectar()->prepare("SELECT solicitud.solicitud_inicio, solicitud.solicitud_descripcion, solicitud.solicitud_estado, 
        usuario.usuario_nombre, usuario.usuario_dni, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, usuario.usuario_telefono, 
        direccion.direccion_nombre, gabinete.gabinete_nombre, actividad.actividad_nombre, solicitud_actividad.solicitud_estado as actividad_estado, 
        municipio.municipio_nombre, parroquia.parroquia_nombre, sector.sector_nombre, asignacion.asignacion_fecha, analista.usuario_nombre as analista_nombre, 
        analista.usuario_dni as analista_cedula, analista.usuario_telefono as analista_telefono, categoria.categoria_nombre FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id 
        INNER JOIN solicitud_direccion ON solicitud_direccion.solicitud_id = solicitud.solicitud_id INNER JOIN direccion ON solicitud_direccion.direccion_id=direccion.direccion_id 
        INNER JOIN gabinete ON direccion.gabinete_id = gabinete.gabinete_id INNER JOIN solicitud_actividad ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN 
        actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id INNER JOIN 
        sector ON usuario_sector.sector_id = sector.sector_id INNER JOIN parroquia ON sector.parroquia_id = parroquia.parroquia_id INNER JOIN 
        municipio ON parroquia.municipio_id = municipio.municipio_id INNER JOIN asignacion ON asignacion.solicitud_actividad = solicitud_actividad.sol_act_id 
        INNER JOIN usuario as analista ON analista.usuario_id = asignacion.asignado_a INNER JOIN categoria ON categoria.categoria_id=actividad.categoria_id WHERE solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY solicitud.solicitud_inicio DESC");

        //$sql = mainModel::conectar()->prepare("SELECT solicitud_inicio, solicitud_descripcion, solicitud_estado FROM solicitud ORDER BY solicitud_inicio DESC");

        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Fin", $datos['Fin']);
        
        $sql->execute();
        return $sql;
    }


    //MOdelo para obtener los mantenimientos realizados
    protected static function obtener_mantenimiento_activo_modelo($tipo,$datos) {
       
          //ACTIVIDADES POR SECTORES
          if($tipo == "ActivosUsuarios") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, actividad.actividad_nombre, solicitud_actividad.solicitud_fin FROM producto INNER JOIN equipo_actividad ON equipo_actividad.producto_codigo = producto.producto_codigo INNER JOIN solicitud_actividad ON solicitud_actividad.sol_act_id = equipo_actividad.sol_act_id INNER JOIN actividad ON actividad.actividad_id = solicitud_actividad.actividad_id "
                    . " WHERE solicitud_actividad.solicitud_fin>=:Inicio AND solicitud_actividad.solicitud_fin<:Fin ORDER BY producto.producto_nombre ASC");
          }elseif($tipo == "ActividadEspecifica") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, actividad.actividad_nombre, solicitud_actividad.solicitud_fin FROM producto INNER JOIN equipo_actividad ON equipo_actividad.producto_codigo = producto.producto_codigo INNER JOIN solicitud_actividad ON solicitud_actividad.sol_act_id = equipo_actividad.sol_act_id INNER JOIN actividad ON actividad.actividad_id = solicitud_actividad.actividad_id "
                    . " WHERE actividad.actividad_id =:IDActividad AND solicitud_actividad.solicitud_fin>=:Inicio AND solicitud_actividad.solicitud_fin<:Fin ORDER BY producto.producto_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActivoEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, actividad.actividad_nombre, solicitud_actividad.solicitud_fin FROM producto INNER JOIN equipo_actividad ON equipo_actividad.producto_codigo = producto.producto_codigo INNER JOIN solicitud_actividad ON solicitud_actividad.sol_act_id = equipo_actividad.sol_act_id INNER JOIN actividad ON actividad.actividad_id = solicitud_actividad.actividad_id "
                    . " WHERE producto.producto_id =:IDActivo AND solicitud_actividad.solicitud_fin>=:Inicio AND solicitud_actividad.solicitud_fin<:Fin ORDER BY producto.producto_nombre ASC");
          $sql->bindParam(":IDActivo", $datos['IDActivo']);
          }elseif($tipo == "ActivoyActividadEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, actividad.actividad_nombre, solicitud_actividad.solicitud_fin FROM producto INNER JOIN equipo_actividad ON equipo_actividad.producto_codigo = producto.producto_codigo INNER JOIN solicitud_actividad ON solicitud_actividad.sol_act_id = equipo_actividad.sol_act_id INNER JOIN actividad ON actividad.actividad_id = solicitud_actividad.actividad_id "
                    . " WHERE actividad.actividad_id =:IDActividad AND producto.producto_id =:IDActivo AND solicitud_actividad.solicitud_fin>=:Inicio AND solicitud_actividad.solicitud_fin<:Fin ORDER BY producto.producto_nombre ASC");
          $sql->bindParam(":IDActivo", $datos['IDActivo']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          } 
          
          $sql->bindParam(":Inicio", $datos['Inicio']);
         $sql->bindParam(":Fin", $datos['Fin']);
          
        $sql->execute();
        return $sql;
    }  
    
    protected static function obtener_feedback_modelo($tipo,$datos) {
       
          //ACTIVIDADES POR SECTORES
          if($tipo == "tiempoSolucion") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_apellido, solicitud.solicitud_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, feedback.feedback_descripcion FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id"
                    . " WHERE solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY usuario.usuario_nombre ASC");
          }elseif($tipo == "tiempoEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_apellido, solicitud.solicitud_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, feedback.feedback_descripcion FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id"
          . " WHERE feedback.feedback_tiempo_respuesta =:IDTiempo AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY usuario.usuario_nombre ASC");
           $sql->bindParam(":IDTiempo", $datos['IDTiempo']);

          }elseif($tipo == "SolucionEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_apellido, solicitud.solicitud_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, feedback.feedback_descripcion FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id"
          . " WHERE feedback.feedback_tipo_solucion =:IDSolucion AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDSolucion", $datos['IDSolucion']);
         
        }elseif($tipo == "TiempoSolucionEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_apellido, solicitud.solicitud_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, feedback.feedback_descripcion FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id"
          . " WHERE feedback.feedback_tiempo_respuesta =:IDTiempo AND feedback.feedback_tipo_solucion =:IDSolucion AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDTiempo", $datos['IDTiempo']);
          $sql->bindParam(":IDSolucion", $datos['IDSolucion']);
          } 
          
          $sql->bindParam(":Inicio", $datos['Inicio']);
         $sql->bindParam(":Fin", $datos['Fin']);
          
        $sql->execute();
        return $sql;
    }  
    
     //Modelo para obtener la relacion de activos vs usuarios relacionados en el sistema
     protected static function obtener_activo_modelo($tipo,$datos) {
       
          //ACTIVIDADES POR SECTORES
          if($tipo == "ActivosUsuarios") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario INNER JOIN activo_usuario_status ON usuario.usuario_dni = activo_usuario_status.usuario_cedula INNER JOIN producto ON producto.producto_codigo = activo_usuario_status.producto_codigo"
                    . " WHERE activo_usuario_status.estado ='1' ORDER BY usuario.usuario_nombre ASC");
          }elseif($tipo == "ActivoEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario INNER JOIN activo_usuario_status ON usuario.usuario_dni = activo_usuario_status.usuario_cedula INNER JOIN producto ON producto.producto_codigo = activo_usuario_status.producto_codigo"
                    . " WHERE activo_usuario_status.estado ='1' AND producto.producto_id=:IDActividad ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "UsuarioEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario INNER JOIN activo_usuario_status ON usuario.usuario_dni = activo_usuario_status.usuario_cedula INNER JOIN producto ON producto.producto_codigo = activo_usuario_status.producto_codigo"
                    . " WHERE activo_usuario_status.estado ='1' AND usuario.usuario_id=:IDUsuario ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }elseif($tipo == "ActivoUsuarioEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT producto.producto_codigo, producto.producto_nombre, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario INNER JOIN activo_usuario_status ON usuario.usuario_dni = activo_usuario_status.usuario_cedula INNER JOIN producto ON producto.producto_codigo = activo_usuario_status.producto_codigo"
                    . " WHERE activo_usuario_status.estado ='1' AND usuario.usuario_id=:IDUsuario AND producto.producto_id=:IDActividad ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          } 
          
          
        $sql->execute();
        return $sql;
    }  
    
    //Modelo para obtener cuantas actividades ha realizado el usuario
  protected static function contador_actividades_modelo($tipo,$datos) {
    //INICIO CIUDADANO ACTIVIDAD
    if($tipo == "ActividadesCiu") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_dni, usuario.usuario_telefono, actividad.actividad_nombre,"
                . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
              . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
              . "solicitud ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
              . "usuario ON usuario.usuario_id = solicitud.usuario_id WHERE "
              . "asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY "
              . "usuario.usuario_nombre ASC");
      }
      elseif($tipo == "ActividadesEspecificaCiu") {
        $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_dni, usuario.usuario_telefono, actividad.actividad_nombre,"
                . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
              . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
              . "solicitud ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
              . "usuario ON usuario.usuario_id = solicitud.usuario_id WHERE actividad.actividad_id=:IDActividad AND "
              . "asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY "
              . "usuario.usuario_nombre ASC");
        $sql->bindParam(":IDActividad", $datos['IDActividad']);
        }
        elseif($tipo == "ActividadesCiuEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_dni, usuario.usuario_telefono, actividad.actividad_nombre,"
          . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
        . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
          . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
        . "solicitud ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
        . "usuario ON usuario.usuario_id = solicitud.usuario_id WHERE usuario.usuario_id=:IDUsuario AND "
        . "asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY "
        . "usuario.usuario_nombre ASC");
        
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }
          elseif($tipo == "ActividadyCiuEspecificos") {
            $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_dni, usuario.usuario_telefono, actividad.actividad_nombre,"
          . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
        . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
          . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
        . "solicitud ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
        . "usuario ON usuario.usuario_id = solicitud.usuario_id WHERE actividad.actividad_id=:IDActividad AND usuario.usuario_id=:IDUsuario AND "
        . "asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY "
        . "usuario.usuario_nombre ASC");

            $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
            $sql->bindParam(":IDActividad", $datos['IDActividad']);
            }

    //FIN CIDUADANO ACTIVIDAD
          elseif($tipo == "Actividades") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id WHERE asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY usuario.usuario_nombre ASC");
          }elseif($tipo == "ActividadesGabinete") {
          $sql = mainModel::conectar()->prepare("SELECT gabinete.gabinete_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud_gabinete ON solicitud_gabinete.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN gabinete ON gabinete.gabinete_id = solicitud_gabinete.gabinete_id WHERE asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY gabinete.gabinete_nombre ASC");
          }elseif($tipo == "ActividadesEspecificaGabinete") {
          $sql = mainModel::conectar()->prepare("SELECT gabinete.gabinete_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud_gabinete ON solicitud_gabinete.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN gabinete ON gabinete.gabinete_id = solicitud_gabinete.gabinete_id WHERE actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY gabinete.gabinete_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActividadesGabineteEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT gabinete.gabinete_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud_gabinete ON solicitud_gabinete.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN gabinete ON gabinete.gabinete_id = solicitud_gabinete.gabinete_id WHERE gabinete.gabinete_id=:IDUsuario AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY gabinete.gabinete_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }elseif($tipo == "ActividadyGabineteEspecificos") {
          $sql = mainModel::conectar()->prepare("SELECT gabinete.gabinete_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud_gabinete ON solicitud_gabinete.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN gabinete ON gabinete.gabinete_id = solicitud_gabinete.gabinete_id WHERE gabinete.gabinete_id=:IDUsuario AND actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY gabinete.gabinete_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActividadesEspecifica") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id WHERE actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActividadesOperadorEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id WHERE usuario.usuario_id=:IDUsuario AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }elseif($tipo == "ActividadeyOperadoresEspecificos") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id WHERE usuario.usuario_id=:IDUsuario AND actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY usuario.usuario_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }
          
          //Municipio + Actividades
          elseif($tipo == "MunicipioActividades") {
          $sql = mainModel::conectar()->prepare("SELECT municipio.municipio_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY municipio.municipio_nombre ASC");
          }elseif($tipo == "MunicipioActividadEspecifica") {
          $sql = mainModel::conectar()->prepare("SELECT municipio.municipio_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY municipio.municipio_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActividadesMunicipiodEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT municipio.municipio_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE municipio.municipio_id=:IDUsuario AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY municipio.municipio_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }elseif($tipo == "ActividadyMunicipiodEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT municipio.municipio_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE municipio.municipio_id=:IDUsuario AND actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY municipio.municipio_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }
          
          //Parroquia + Actividades
          elseif($tipo == "ParroquiaActividades") {
          $sql = mainModel::conectar()->prepare("SELECT parroquia.parroquia_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id WHERE asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY parroquia.parroquia_nombre ASC");
          }elseif($tipo == "ParroquiaActividadEspecifica") {
          $sql = mainModel::conectar()->prepare("SELECT parroquia.parroquia_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id WHERE actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY parroquia.parroquia_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActividadesParroquiadEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT parroquia.parroquia_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id WHERE parroquia.parroquia_id=:IDUsuario AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY parroquia.parroquia_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }elseif($tipo == "ActividadyParroquiadEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT parroquia.parroquia_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_parroquia "
                    . "ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id WHERE parroquia.parroquia_id=:IDUsuario AND actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY parroquia.parroquia_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }
          
          //ACTIVIDADES POR SECTORES
          elseif($tipo == "SectorActividades") {
          $sql = mainModel::conectar()->prepare("SELECT sector.sector_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_sector "
                    . "ON usuario_sector.usuario_id = usuario.usuario_id INNER JOIN sector ON sector.sector_id = usuario_sector.sector_id WHERE asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY sector.sector_nombre ASC");
          }elseif($tipo == "SectorActividadEspecifica") {
          $sql = mainModel::conectar()->prepare("SELECT sector.sector_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_sector "
                    . "ON usuario_sector.usuario_id = usuario.usuario_id INNER JOIN sector ON sector.sector_id = usuario_sector.sector_id WHERE actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY sector.sector_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }elseif($tipo == "ActividadesSectorEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT sector.sector_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_sector "
                    . "ON usuario_sector.usuario_id = usuario.usuario_id INNER JOIN sector ON sector.sector_id = usuario_sector.sector_id WHERE sector.sector_id=:IDUsuario AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY sector.sector_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }elseif($tipo == "ActividadySectorEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT sector.sector_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id INNER JOIN usuario ON usuario.usuario_id = solicitud.usuario_id INNER JOIN usuario_sector "
                    . "ON usuario_sector.usuario_id = usuario.usuario_id INNER JOIN sector ON sector.sector_id = usuario_sector.sector_id WHERE sector.sector_id=:IDUsuario AND actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY sector.sector_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          } 
          
          
       /* ACTIVIDAD SECTOR*/
          elseif($tipo == "ActividadesDir") {
          $sql = mainModel::conectar()->prepare("SELECT direccion.direccion_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
                  . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
                  . "solicitud_direccion ON solicitud_direccion.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
                  . "direccion ON direccion.direccion_id = solicitud_direccion.direccion_id WHERE "
                  . "asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin ORDER BY "
                  . "direccion.direccion_nombre ASC");
          }
          elseif($tipo == "ActividadesEspecificaDir") {
          $sql = mainModel::conectar()->prepare("SELECT direccion.direccion_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
                  . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
                  . "solicitud_direccion ON solicitud_direccion.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
                  . "direccion ON direccion.direccion_id = solicitud_direccion.direccion_id WHERE "
                  . "actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND "
                  . "asignacion.asignacion_fecha<:Fin ORDER BY direccion.direccion_nombre ASC");
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }
          elseif($tipo == "ActividadesDirEspecifico") {
          $sql = mainModel::conectar()->prepare("SELECT direccion.direccion_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
                  . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
                  . "solicitud_direccion ON solicitud_direccion.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
                  . "direccion ON direccion.direccion_id = solicitud_direccion.direccion_id WHERE "
                  . "direccion.direccion_id=:IDUsuario AND asignacion.asignacion_fecha>=:Inicio AND asignacion.asignacion_fecha<:Fin "
                  . "ORDER BY direccion.direccion_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          }
          elseif($tipo == "ActividadyDirEspecificos") {
          $sql = mainModel::conectar()->prepare("SELECT direccion.direccion_nombre, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN "
                  . "solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN "
                  . "solicitud_direccion ON solicitud_direccion.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN "
                  . "direccion ON direccion.direccion_id = solicitud_direccion.direccion_id WHERE direccion.direccion_id=:IDUsuario "
                  . "AND actividad.actividad_id=:IDActividad AND asignacion.asignacion_fecha>=:Inicio AND "
                  . "asignacion.asignacion_fecha<:Fin ORDER BY direccion.direccion_nombre ASC");
          $sql->bindParam(":IDUsuario", $datos['IDUsuario']);
          $sql->bindParam(":IDActividad", $datos['IDActividad']);
          }
          
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Fin", $datos['Fin']);
        
        $sql->execute();
        return $sql;
    }  
    
     /** Modelo para obtener los datos del solicitud **/
    protected static function datos_solicitud_modelo($tipo, $id)
    {
        if($tipo=="ActividadesSolicitud"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud_actividad.solicitud_estado, solicitud.solicitud_inicio, solicitud_actividad.solicitud_fin, actividad.actividad_nombre FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id WHERE solicitud.solicitud_id=:ID");
           $sql->bindParam(":ID", $id);
           
        }elseif($tipo== "DescripcionSolicitud"){
          $sql= mainModel::conectar()->prepare("SELECT solicitud.solicitud_descripcion FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud_actividad.sol_act_id=:ID");
          $sql->bindParam(":ID", $id);  
        }
        elseif($tipo== "DetalleSolicitudCiudadano"){
          $sql= mainModel::conectar()->prepare("SELECT solicitud.solicitud_descripcion, solicitud.solicitud_estado, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_dni, usuario.usuario_telefono, usuario.usuario_email FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.solicitud_id=:ID");
          $sql->bindParam(":ID", $id);  
        }
        elseif($tipo=="DetalleSolicitud"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud.solicitud_descripcion, usuario.usuario_nombre, usuario.usuario_apellido, cargo.cargo_nombre, direccion.direccion_nombre FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id INNER JOIN usuario_cargo ON usuario.usuario_id = usuario_cargo.usuario_id INNER JOIN cargo ON usuario_cargo.cargo_id = cargo.cargo_id INNER JOIN direccion ON direccion.direccion_id = cargo.direccion_id WHERE solicitud.solicitud_id=:ID");
           $sql->bindParam(":ID", $id);
         }elseif($tipo=="DetalleAsignacion"){
           $sql= mainModel::conectar()->prepare("SELECT asignacion.solicitud_actividad, supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as supervisor_apellido, "
                    . "usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id INNER JOIN usuario as supervisor "
                    . "ON asignacion.asignado_por=supervisor.usuario_id WHERE asignacion.asignacion_id=:ID");
           $sql->bindParam(":ID", $id);
         }elseif($tipo=="DetalleSolicitante"){
           $sql= mainModel::conectar()->prepare("SELECT usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_dni FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad = solicitud_actividad.sol_act_id INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE asignacion.asignacion_id=:ID");
           $sql->bindParam(":ID", $id);
         }elseif($tipo=="PasosActividad"){
           $sql= mainModel::conectar()->prepare("SELECT procesar.procesar_observacion, procesar.fecha_inicio, procesar.fecha_fin, paso.paso_nombre, paso.paso_duracion FROM procesar INNER JOIN paso ON procesar.paso_id = paso.paso_id WHERE procesar.asignacion_id=:ID");
           $sql->bindParam(":ID", $id);
         }elseif($tipo=="ImagenesActividad"){
           $sql= mainModel::conectar()->prepare("SELECT imagen_nombre FROM imagen WHERE imagen.asignacion_id=:ID");
           $sql->bindParam(":ID", $id);
         }
         elseif($tipo=="EnProceso"){
           $sql= mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad WHERE solicitud_estado='asignado'");
        }elseif($tipo=="SinProcesar"){
           $sql= mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad WHERE solicitud_estado='sin asignar'");
        }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos solicitud*/
  
    
    protected static function obtener_ciudadanos_modelo($tipo,$datos) 
    {   if($tipo == "Ciudadanos") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
     
    }elseif($tipo == "CiudadanosParroquia") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
    }elseif($tipo == "CiudadanosParroquiaSector") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND usuario_sector.sector_id=:Sector AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Sector", $datos['Sector']);
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
    }elseif($tipo == "CiudadanosParroquiaGenero") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND usuario.usuario_genero=:Genero AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
      $sql->bindParam(":Genero", $datos['Genero']);
    }elseif($tipo == "CiudadanosGenero") {
        $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND usuario.usuario_genero=:Genero AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
        $sql->bindParam(":Genero", $datos['Genero']);
    }elseif($tipo == "CiudadanosSector") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND usuario_sector.sector_id=:Sector AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
          $sql->bindParam(":Sector", $datos['Sector']);
    }elseif($tipo == "CiudadanosSectorGenero") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND usuario_sector.sector_id=:Sector AND usuario.usuario_genero=:Genero AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Sector", $datos['Sector']);
      $sql->bindParam(":Genero", $datos['Genero']);
    }elseif($tipo == "CiudadanosParroquiaSectorGenero") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND usuario_sector.sector_id=:Sector AND usuario.usuario_genero=:Genero AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Sector", $datos['Sector']);
      $sql->bindParam(":Genero", $datos['Genero']);
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
    }elseif($tipo == "CiudadanosMunicipio") {
            $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND municipio.municipio_id=:Municipio AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
            $sql->bindParam(":Municipio", $datos['Municipio']);
    }

    //inicio municipio
    elseif($tipo == "MCiudadanosParroquia") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND municipio.municipio_id=:Municipio AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
      $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosParroquiaSector") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND municipio.municipio_id=:Municipio AND  parroquia.parroquia_id=:Parroquia AND usuario_sector.sector_id=:Sector AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Sector", $datos['Sector']);
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
      $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosParroquiaGenero") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND usuario.usuario_genero=:Genero AND municipio.municipio_id=:Municipio AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
      $sql->bindParam(":Genero", $datos['Genero']);
      $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosGenero") {
        $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND usuario.usuario_genero=:Genero AND municipio.municipio_id=:Municipio AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
        $sql->bindParam(":Genero", $datos['Genero']);
        $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosSector") {
          $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND usuario_sector.sector_id=:Sector AND municipio.municipio_id=:Municipio AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
          $sql->bindParam(":Sector", $datos['Sector']);
          $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosSectorGenero") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND usuario_sector.sector_id=:Sector AND municipio.municipio_id=:Municipio AND usuario.usuario_genero=:Genero AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Sector", $datos['Sector']);
      $sql->bindParam(":Genero", $datos['Genero']);
      $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosParroquiaSectorGenero") {
      $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = usuario.usuario_id WHERE usuario.usuario_tipo='4' AND parroquia.parroquia_id=:Parroquia AND municipio.municipio_id=:Municipio AND usuario_sector.sector_id=:Sector AND usuario.usuario_genero=:Genero AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
      $sql->bindParam(":Sector", $datos['Sector']);
      $sql->bindParam(":Genero", $datos['Genero']);
      $sql->bindParam(":Parroquia", $datos['Parroquia']);
      $sql->bindParam(":Municipio", $datos['Municipio']);
    }elseif($tipo == "MCiudadanosMunicipio") {
            $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_id, usuario.usuario_dni, usuario.usuario_usuario, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_telefono, usuario.usuario_fecha_nacimiento, usuario.usuario_genero, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_direccion FROM usuario INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = usuario.usuario_id INNER JOIN parroquia ON parroquia.parroquia_id = usuario_parroquia.parroquia_id INNER JOIN municipio ON municipio.municipio_id = parroquia.municipio_id WHERE usuario.usuario_tipo='4' AND municipio.municipio_id=:Municipio AND usuario.usuario_fecha_nacimiento>=:Inicio AND usuario.usuario_fecha_nacimiento<:Fin ORDER BY usuario.usuario_fecha_nacimiento DESC");
            $sql->bindParam(":Municipio", $datos['Municipio']);
    }

    //fin de municipio
     

    $sql->bindParam(":Inicio", $datos['Inicio']);
    $sql->bindParam(":Fin", $datos['Fin']);
    
    $sql->execute();
    return $sql;
} 

//Modelo para obtener los usuarios atendidos en el dia.
protected static function obtener_turnos_modelo($tipo,$datos) {
  if($tipo == "Turnos") {
    $sql = mainModel::conectar()->prepare("SELECT turno.turno_nombre, turno.turno_fecha, turno.turno_cedula, turno.turno_descripcion, turno.turno_fecha_login, turno.turno_estado, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM turno LEFT JOIN turno_usuario ON turno.turno_id = turno_usuario.turno_id LEFT JOIN usuario ON usuario.usuario_id = turno_usuario.usuario_id WHERE turno.turno_fecha_login>=:Inicio AND turno.turno_fecha_login<:Fin ORDER BY turno.turno_fecha_login DESC");
   
  }elseif($tipo == "TurnosEspecificos") {
    $sql = mainModel::conectar()->prepare("SELECT turno.turno_nombre, turno.turno_fecha, turno.turno_cedula, turno.turno_descripcion, turno.turno_fecha_login, turno.turno_estado, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM turno INNER JOIN turno_usuario ON turno.turno_id = turno_usuario.turno_id INNER JOIN usuario ON usuario.usuario_id = turno_usuario.usuario_id WHERE usuario.usuario_id=:Usuario AND turno.turno_fecha_login>=:Inicio AND turno.turno_fecha_login<:Fin ORDER BY turno.turno_fecha_login DESC");
    $sql->bindParam(":Usuario", $datos['Usuario']);
  }
   

  $sql->bindParam(":Inicio", $datos['Inicio']);
  $sql->bindParam(":Fin", $datos['Fin']);
  
  $sql->execute();
  return $sql;
} 

protected static function obtener_solicitud_modelo($tipo,$datos) {
  if($tipo == "Solicitudes") {
    $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY usuario.usuario_nombre ASC");
   
  }elseif($tipo == "SolicitudEspecifica") {
    $sql = mainModel::conectar()->prepare("SELECT usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE usuario.usuario_dni=:Usuario AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<:Fin ORDER BY usuario.usuario_nombre ASC");
    $sql->bindParam(":Usuario", $datos['Usuario']);
  }
   

  $sql->bindParam(":Inicio", $datos['Inicio']);
  $sql->bindParam(":Fin", $datos['Fin']);
  
  $sql->execute();
  return $sql;
} 

  }