<?php
require_once "mainModel.php";

class homeModelo extends mainModel{
  
   /** Modelo para obtener los datos del solicitud **/
    protected static function datos_solicitud_modelo($tipo, $id)
    {
        //obtener el año actual del sistema, las consultas se haran anuales
        $fecha = mainModel::solo_fecha();
        $fecha_actual = explode("-",$fecha);
        $year = $fecha_actual[0];
        $fecha_inicio =$year."-01-01";
        $fecha_fin = $year."-12-31";
        
        
        if($tipo=="Todos"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        }elseif($tipo=="Finalizados"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud_actividad.solicitud_estado='finalizado' AND solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        }elseif($tipo=="EnProceso"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud_actividad.solicitud_estado='asignado' AND solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        }elseif($tipo=="SinProcesar"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud_actividad.solicitud_estado='sin asignar' AND solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        }elseif($tipo=="Online"){
           $sql= mainModel::conectar()->prepare("SELECT solicitud_id FROM solicitud WHERE solicitud_inicio>='$fecha_inicio' AND solicitud_inicio<='$fecha_fin'");
        }

        $sql->execute();
        return $sql;
    } /*Fin modelo datos solicitud*/
    
    /* Modelo para obtener los datos de las solicitudes para obtener la cadena que se mostrara en la grafica principal */
    protected static function solicitudes_anuales_modelo($tipo, $datos) {
        if ($tipo == "Solicitadas") {
            $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id WHERE solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
        } elseif ($tipo == "Finalizadas") {
             $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id WHERE solicitud_actividad.solicitud_estado='finalizado' AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
       } 

        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Fin", $datos['Fin']);
        $sql->execute();
        return $sql;
    }
    
    //Modelo par obtener la recurrencia de las actividades
    protected static function contador_actividades_modelo($tipo,$datos) {
          if($tipo == "Actividades") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id WHERE solicitud_actividad.actividad_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "ActividadesSinAsignar") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id WHERE solicitud_actividad.solicitud_estado='sin asignar' AND solicitud_actividad.actividad_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "ActividadesAsignadas") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id WHERE solicitud_actividad.solicitud_estado='asignado' AND solicitud_actividad.actividad_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "ActividadesFinalizadas") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id WHERE solicitud_actividad.solicitud_estado='finalizado' AND solicitud_actividad.actividad_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Indicadores") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN actividad ON solicitud_actividad.actividad_id = actividad.actividad_id WHERE actividad.indicador_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Direccion") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN usuario_cargo ON usuario_cargo.usuario_id = solicitud.usuario_id INNER JOIN cargo ON cargo.cargo_id =usuario_cargo.cargo_id WHERE cargo.direccion_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "DireccionHome") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN solicitud_direccion ON solicitud.solicitud_id = solicitud_direccion.solicitud_id WHERE solicitud_direccion.direccion_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Gabinete") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN solicitud_gabinete ON solicitud.solicitud_id = solicitud_gabinete.solicitud_id WHERE solicitud_gabinete.gabinete_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Municipio") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = solicitud.usuario_id INNER JOIN parroquia ON usuario_parroquia.parroquia_id = parroquia.parroquia_id WHERE parroquia.municipio_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Parroquia") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN usuario_parroquia ON usuario_parroquia.usuario_id = solicitud.usuario_id WHERE usuario_parroquia.parroquia_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Sector") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN usuario_sector ON usuario_sector.usuario_id = solicitud.usuario_id WHERE usuario_sector.sector_id=:ID AND solicitud.solicitud_inicio>=:Inicio AND solicitud.solicitud_inicio<=:Fin");
          }elseif($tipo == "Usuario_Anual" || $tipo == "recurrencia-mensual" || $tipo == "recurrencia-dia") {
          $sql = mainModel::conectar()->prepare("SELECT sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud_actividad.solicitud_id = solicitud.solicitud_id INNER JOIN asignacion ON solicitud_actividad.sol_act_id = asignacion.solicitud_actividad WHERE asignacion.asignado_a=:ID AND solicitud_actividad.solicitud_estado='finalizado' AND solicitud_actividad.solicitud_fin>=:Inicio AND solicitud_actividad.solicitud_fin<=:Fin");
          }
          
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Fin", $datos['Fin']);
        $sql->bindParam(":ID", $datos['ID']);
        $sql->execute();
        return $sql;
    }
    
}