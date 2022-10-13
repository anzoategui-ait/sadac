<?php

session_start(['name' => 'TOR']);
require_once "../config/APP.php";

if (isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    //crear un array para recargar la vista desde donde se esta haciendo la busqueda
    $data_url = [
                "estudio" => "estudio-social-search",
                "cubiculo" => "cubiculo-search",
                "turno" => "turno-search",
                "evaluacion" => "evaluacion-search",
                "producto" => "producto-search",
                "kategoria" => "kategoria-search",
                "anexo_asignacion" => "asignacion-anexo-list",
                "consulta" => "consulta",
                "gabinete" => "gabinete-search",
                "municipio" => "municipio-search",
                "parroquia" => "parroquia-search",
                "sector" => "sector-search",
                "activo_usuario" => "activo-usuario-search",
              "procesadas" => "procesar-list",
              "procesar_asignacion" => "procesar-new",
              "usuario_cargo" => "user-cargo-list",
              "asignacion_b" => "asignacion-search",
              "asignacion" => "asignacion-new",
              "solicitud" => "solicitud-search",
              "indicador" => "inicador-search",
              "anexo" => "anexo-search",
              "paso" => "paso-search",
              "actividad" => "actividad-search",
              "cargo" => "cargo-search",
              "bitacora" => "bitacora-search",
              "direccion" => "direccion-search",
              "categoria" => "categoria-search",
        "usuario" => "user-search",
        "multimedia" => "multimedia-search",
        "configuracion" => "configuracion-search",
        "club" => "club-search",
        "pago" => "pago-search",
        "equipo" => "equipo-search",
        "partido" => "partido-search",
        "jugador" => "jugador-search",
        "jugador_gol" => "jugador-gol-search",
        "grupo" => "grupo-search",
        "grupo_equipo" => "grupo-equipo-search",
        "jugador_reporte" =>"reporte-jugador-list",
        "club_reporte" => "reporte-club-list",
        "jugador_perfil" => "reporte-jugador-perfil",
        "partido_jugador" => "partido-jugador-search",
        "club_jugador" => "club-jugador-search",
        "torneo" => "torneo-search",
        "torneo_equipo" => "torneo-equipo-search",
        "equipo_reporte"=> "reporte-equipo-list",
        "mensualidad" => "mensualidad-search"
    ];
    //para saber en que vista estamos
    if (isset($_POST['modulo'])) {
        $modulo = $_POST['modulo'];
        if (!isset($data_url[$modulo])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No podemos continuar con la busqueda debido a un error",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    } else {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ha ocurrido un error inesperado",
            "Texto" => "No podemos continuar con la busqueda debido a que una variable no esta definida",
            "Tipo" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }

    if ($modulo == "prestamo") {
        $fecha_inicio = "fecha_inicio_" . $modulo;
        $fecha_final = "fecha_final_" . $modulo;

        //iniciar busqueda
        if (isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
            if ($_POST['fecha_inicio'] == "" || $_POST['fecha_final'] == "") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Por favor introducir las  fechas que faltan para realizar la busqueda",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            //creamos las variables de sesion
            $_SESSION[$fecha_inicio] = $_POST['fecha_inicio'];
            $_SESSION[$fecha_final] = $_POST['fecha_final'];
        }

        //eliminar las busquedas
        if (isset($_POST['eliminar_busqueda'])) {
            unset($_SESSION[$fecha_inicio]); //se utiliza para eliminar los valores de las variables de sesion
            unset($_SESSION[$fecha_final]);
        }
    } else {
        $name_var = "busqueda_" . $modulo;

        //iniciar busqueda
        if (isset($_POST['busqueda_inicial'])) {
            //comprobar que este definido el valor que viene del formulario
            if ($_POST['busqueda_inicial'] == "") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Por favor introducir un termino de busqueda",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $_SESSION[$name_var] = $_POST['busqueda_inicial'];
        }
        //Eliminar busqueda
        if (isset($_POST['eliminar_busqueda'])) {
            unset($_SESSION[$name_var]); //se utiliza para eliminar los valores de las variables de sesion
        }
    }


    //redireccionar la pagina
    $url = $data_url[$modulo];
    $alerta = [
        "Alerta" => "redireccionar",
        "URL" => SERVERURL . $url . "/"
    ];

    echo json_encode($alerta);
} else {
    session_unset(); //vacia sesion
    session_destroy(); //cerrar sesion
    header("Location: " . SERVERURL . "login/"); //redirigir a otra pagina
    exit(); //salir del script
}

