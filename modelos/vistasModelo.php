<?php

class vistasModelo
{

    /* --------- Modelo obtener vistas --------- */
    protected static function obtener_vistas_modelo($vistas)
    {
        $listaBlanca = [
                    "estudio-social-new", "estudio-social-update", "estudio-social-search", "estudio-social-list",
                    "reporte-gestion", "totalizacion-gestion",
                    "reporte-ciudadanos", "reporte-turnos","reporte-solicitudes", "reporte-ciudadano-actividad",
                    "turno-new", "turno-list", "turno-search", "turno-update", "turno-public",
                    "cubiculo-new", "cubiculo-list", "cubiculo-search", "cubiculo-update",
                    "evaluar-solicitud","evaluacion-list", "evaluacion-search", "reporte-evaluacion",
                    "activo-usuario-list", "activo-usuario-search", "reporte-activo-usuario", "reporte-equipo-incidencia",
                    "kategoria-new", "kategoria-search", "kategoria-list", "kategoria-update", "activo-usuario",
                    "producto-new", "producto-list", "producto-search", "producto-update", "producto-categoria", "producto-imagen",
                    "reporte-direccion","reporte-direccion-actividad","user-direccion",
                    "asignacion-anexo-list","visor-pdf", "script-agregar-solicitudes", "solicitudes-list",
                    "reporte-municipio-actividad","reporte-parroquia-actividad","reporte-sector-actividad",
                    "reporte-parroquia-pdf", "reporte-sector-pdf", "reporte-gabinete-actividad",
                    "solicitud", "consulta", "requisitos", "leaflet", "reporte-gabinete", "reporte-municipio-pdf",
                    "gabinete-new", "gabinete-list", "gabinete-search", "gabinete-update",
                    "municipio-new", "municipio-list", "municipio-search", "municipio-update",
                    "parroquia-new", "parroquia-list", "parroquia-search", "parroquia-update",
                    "sector-new", "sector-list", "sector-search", "sector-update",
                     "reporte-actividades-pdf", "reporte-indicadores-pdf","reporte-direcciones-pdf", "reporte-operadores-pdf",
                     "procesar-new", "procesar-list", "procesar-search", "procesar-update", "procesar-asignacion",
                     "user-cargo","user-cargo-list",
                     "asignacion-selected",
                     "asignacion-new", "asignacion-list", "asignacion-search", "asignacion-update",
                     "eliminar",
                     "solicitud-new", "solicitud-list", "solicitud-search", "solicitud-update",
                     "indicador-new", "indicador-list", "indicador-search", "indicador-update",
                     "visor-anexos",
                     "anexo-new", "anexo-list", "anexo-search",
                     "paso-new", "paso-list", "paso-search", "paso-update",
                     "actividad-new", "actividad-list", "actividad-search", "actividad-update",
                     "cargo-new", "cargo-list", "cargo-search", "cargo-update",
                     "bitacora-list", "bitacora-search",
                     "direccion-new", "direccion-list", "direccion-search", "direccion-update",
            "user-list", "user-new", "user-search", "user-update", "home", "multimedia-new", "multimedia-list", "multimedia-search",
            "multimedia-update", "configuracion-new", "configuracion-list", "configuracion-search", "configuracion-update",
            "club-new", "club-list", "club-search", "club-update", "pago-new", "pago-list", "pago-search", "pago-update", "visor-pagos",
            "categoria-new", "categoria-list", "categoria-search", "categoria-update", "equipo-new", "equipo-list", "equipo-search",
            "equipo-update", "inscripcion-new", "partido-new", "partido-list", "partido-search", "partido-update", "partido-agregar-jugador",
            "jugador-new", "jugador-list", "jugador-search", "jugador-update", "jugador-perfil", "jugador-gol-new", "jugador-gol-list",
            "jugador-gol-search", "jugador-gol-update", "grupo-new", "grupo-list", "grupo-search", "grupo-update", "grupo-equipo-new",
           "reporte"
            
            
            
            
        ];
        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./vistas/contenidos/" . $vistas . "-view.php")) {
                $contenido = "./vistas/contenidos/" . $vistas . "-view.php";
            } else {
                $contenido = "404";
            }
        } elseif ($vistas == "login-club") {
            $contenido = "login-club";
        }elseif ($vistas == "login" || $vistas == "index") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}
