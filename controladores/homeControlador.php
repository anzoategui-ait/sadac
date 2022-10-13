<?php

if ($peticionAjax) {
    require_once "../modelos/homeModelo.php";
} else {
    require_once "./modelos/homeModelo.php";
}

class homeControlador extends homeModelo {

    /** Controlador para obtener los datos de la solicitud * */
    public function datos_solicitud_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return homeModelo::datos_solicitud_modelo($tipo, $id);
    }

    /* Fin Controlador obtener datos */

    /* Obtener los datos para la tabla municipio y para el mapa de municipios */

    public function obtener_datos_municipios_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT municipio_nombre, mapa_porcentaje FROM mapa WHERE mapa_year='$year' ORDER BY mapa_cantidad DESC");

        return $valores;
    }

    /* Fin Controlador */

    /* Obtener los datos para la grafica mapa y para el mapa de municipios */

    public function obtener_datos_mapa_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT municipio_nombre, mapa_cantidad, mapa_porcentaje FROM mapa WHERE mapa_year='$year'");

        return $valores;
    }

    /* Fin Controlador */

    /* Obtener los datos de todas las actividades solicitadas */

    public function obtener_datos_home_actividad_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT actividad_nombre, home_actividad_porcentaje FROM home_actividad WHERE home_actividad_year='$year' ORDER BY home_actividad_cantidad DESC");

        return $valores;
    }

    /* Fin Controlador */

    /* Obtener la tabla home_operador para que el inicio de pantalla sea mucho mas rapido */

    public function obtener_datos_home_operador_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT usuario_nombre, usuario_imagen, home_operador_cantidad_anual, home_operador_porcentaje_anual, home_operador_cantidad_mensual, "
                        . "home_operador_porcentaje_mensual, home_operador_cantidad_diario, home_operador_porcentaje_diario  FROM home_operador WHERE home_operador_year='$year' ORDER BY home_operador_cantidad_anual DESC");

        return $valores;
    }

    /* Fin del Controlador */

    /* Obtener los datos de todas las actividades solicitadas */

    public function obtener_datos_home_indicador_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT indicador_nombre, home_indicador_porcentaje FROM home_indicador WHERE home_indicador_year='$year' ORDER BY home_indicador_cantidad DESC");

        return $valores;
    }

    /* Fin Controlador */

    /* Obtener los datos de todas las gabinetes solicitadas */

    public function obtener_datos_home_gabinete_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT gabinete_nombre, home_gabinete_porcentaje FROM home_gabinete WHERE home_gabinete_year='$year' ORDER BY home_gabinete_cantidad DESC");

        return $valores;
    }

    /* Fin Controlador */

    /* Obtener los datos de todas las direcciones solicitadas */

    public function obtener_datos_home_direccion_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];

        $valores = mainModel::ejecutar_consulta_simple("SELECT direccion_nombre, home_direccion_porcentaje FROM home_direccion WHERE home_direccion_year='$year' ORDER BY home_direccion_cantidad DESC");

        return $valores;
    }

    /* Fin Controlador */

    /* Obtener datos para la grafica de las solicitudes anuales tanto solicitadas como finalizadas */

    public function cadena_grafica_solicitudes_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];
        $cadena_solicitadas = "";
        $cadena_finalizadas = "";

        //Hacer consulta de todos los registro con el año actual
        $registros_grafica = mainModel::ejecutar_consulta_simple("SELECT grafica_solicitud_solicitadas, grafica_solicitud_finalizadas FROM grafica_solicitud WHERE grafica_solicitud_year='$year'");

        if ($registros_grafica->rowCount() > 0) {
            $registros_grafica = $registros_grafica->fetchAll();

            $cont = 1;
            foreach ($registros_grafica as $rows) {
                if ($cont == 12) {
                    $cadena_solicitadas .= $rows['grafica_solicitud_solicitadas'];
                    $cadena_finalizadas .= $rows['grafica_solicitud_finalizadas'];
                } else {
                    $cadena_solicitadas .= $rows['grafica_solicitud_solicitadas'] . ",";
                    $cadena_finalizadas .= $rows['grafica_solicitud_finalizadas'] . ",";
                }
                $cont++;
            }
        } else {
            $cadena_solicitadas = "0,0,0,0,0,0,0,0,0,0,0,0";
            $cadena_finalizadas = "0,0,0,0,0,0,0,0,0,0,0,0";
        }

        $rs = [
            "Solicitadas" => $cadena_solicitadas,
            "Finalizadas" => $cadena_finalizadas
        ];

        return $rs;
    }

    /* Fin Controlador */

    //Controlador para obtener el feedback de los resultados positivos o negativos
    public function home_feedback_controlador() {
        //Primero escoger el año actual
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];
        $cant_tiempo_malo = 0;
        $porc_tiempo_malo = 0.0;
        $cant_tiempo_regular = 0;
        $porc_tiempo_regular = 0.0;
        $cant_tiempo_normal = 0;
        $porc_tiempo_normal = 0.0;
        $cant_tiempo_bueno = 0;
        $porc_tiempo_bueno = 0.0;

        $cant_sol_malo = 0;
        $porc_sol_malo = 0.0;
        $cant_sol_regular = 0;
        $porc_sol_regular = 0.0;
        $cant_sol_normal = 0;
        $porc_sol_normal = 0.0;
        $cant_sol_bueno = 0;
        $porc_sol_bueno = 0.0;

        $total_feedback = 0;

        //Consultar todal la tabla con por el año de feedback
        $check_feedback = mainModel::ejecutar_consulta_simple("SELECT feedback_tiempo_respuesta, feedback_tipo_solucion FROM feedback WHERE feedback_fecha='$year'");

        if ($check_feedback->rowCount() > 0) {
            $total_feedback = $check_feedback->rowCount();

            $check_feedback = $check_feedback->fetchAll();
            //Obtener las cantidades a traves de un ciclo
            foreach ($check_feedback as $row) {
                if ($row['feedback_tiempo_respuesta'] == 1) {
                    $cant_tiempo_malo += 1;
                }
                if ($row['feedback_tipo_solucion'] == 1) {
                    $cant_sol_malo += 1;
                }

                if ($row['feedback_tiempo_respuesta'] == 2) {
                    $cant_tiempo_regular += 1;
                }
                if ($row['feedback_tipo_solucion'] == 2) {
                    $cant_sol_regular += 1;
                }

                if ($row['feedback_tiempo_respuesta'] == 3) {
                    $cant_tiempo_normal += 1;
                }
                if ($row['feedback_tipo_solucion'] == 3) {
                    $cant_sol_normal += 1;
                }

                if ($row['feedback_tiempo_respuesta'] == 4) {
                    $cant_tiempo_bueno += 1;
                }
                if ($row['feedback_tipo_solucion'] == 4) {
                    $cant_sol_bueno += 1;
                }
            }

            //Despues del foreach obtener ahora los porcentajes correspondientes
            $porcentaje = 0;
            //la cantidad seria igual a 1a actividad escogida
            if ($total_feedback != 0) {
                $porcentaje = (1 * 100) / $total_feedback;
                $porcentaje = round($porcentaje, 2);
            } else {
                $porcentaje = 0;
            }
            
            //Obtener los diferentes porcentajes
           
        $porc_tiempo_malo =  $cant_tiempo_malo * $porcentaje;
        
        $porc_tiempo_regular = $cant_tiempo_regular * $porcentaje;
        
        $porc_tiempo_normal = $cant_tiempo_normal * $porcentaje;
        
        $porc_tiempo_bueno = $cant_tiempo_bueno * $porcentaje;

        
        $porc_sol_malo = $cant_sol_malo * $porcentaje;
        
        $porc_sol_regular = $cant_sol_regular * $porcentaje;
        
        $porc_sol_normal = $cant_sol_normal * $porcentaje;
        
        $porc_sol_bueno = $cant_sol_bueno * $porcentaje;
            
            
        }
        
        $datos_feedback = [
            "porc_tiempo_malo"=>$porc_tiempo_malo,
            "porc_tiempo_regular"=>$porc_tiempo_regular,
            "porc_tiempo_normal"=>$porc_tiempo_normal,
            "porc_tiempo_bueno"=>$porc_tiempo_bueno,
            "porc_sol_malo"=>$porc_sol_malo,
            "porc_sol_regular"=>$porc_sol_regular,
            "porc_sol_normal"=>$porc_sol_normal,
            "porc_sol_bueno"=>$porc_sol_bueno
            
        ];
        
        return $datos_feedback;
    }

    //Controlador para obtener las solicitudes en el transcurso del año
    public function solicitudes_anuales_controlador($tipo) {

        //Obtener el año en curso
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];
        //Declaro la variable cadena que es el resultado que devolvera el controlador
        $cadena = "";

        //Realizar ciclo para recorrer los doce meses
        for ($i = 1; $i <= 12; $i++) {
            //Creo el rango con el cual voy a buscar los valores en la base de datos
            if ($i < 10) {
                $fechaInicio = $year . "-0" . $i . "-01";
                $fechaFin = $year . "-0" . $i . "-31";
            } else {
                $fechaInicio = $year . "-" . $i . "-01";
                $fechaFin = $year . "-" . $i . "-31";
            }
            //Creo mi array de datos para hacer la consulta
            $datos_solicitudes = [
                "Inicio" => $fechaInicio,
                "Fin" => $fechaFin
            ];
            //Obtener resultados
            $solicitudes = homeModelo::solicitudes_anuales_modelo($tipo, $datos_solicitudes);

            if ($solicitudes->rowCount() > 0) {
                $total_solicitudes = $solicitudes->rowCount();
            } else {
                $total_solicitudes = 0;
            }

            //ir creando mi cadena con los resultados de los goles realizados en el año
            if ($i < 12) {
                $cadena .= $total_solicitudes . ",";
            } else {
                $cadena .= $total_solicitudes . "";
            }
            $total_solicitudes = 0;
        }

        return $cadena;
    }

    //Fin Controlador

    /** Controlador para obtner el porcentaje de un numero * */
    public function obtener_porcentaje_controlador($total, $individual) {
        //Validar si la division es entre cero 
        if ($total != 0) {
            $rs = ($individual * 100) / $total;
        } else {
            $rs = 0;
        }
        return $rs;
    }

    /** Fin Controlador * */

    /** Controlador para Obtener recurrencia de actividades * */
    public function obtener_recurrencia_controlador($tipo, $id) {
        //Obtener el año en curso
        $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);
        $year = $fecha[0];
        $fechaInicio = $year . "-01-01";
        $fechaFin = $year . "-12-31";

        if ($tipo == "recurrencia-mensual") {
            $mes = $fecha[1];
            $fechaInicio = $year . "-" . $mes . "-01";
            $fechaFin = $year . "-" . $mes . "-31";
        }

        if ($tipo == "recurrencia-dia") {
            $mes = $fecha[1];
            $dia = $fecha[2];
            $fechaInicio = $year . "-" . $mes . "-" . $dia;

            $dia = intval($dia) + 1;
            if ($dia < 10) {
                $dia = "0" . $dia;
            }

            $fechaFin = $year . "-" . $mes . "-" . $dia;
        }

        //Preparo los datos para la consulta
        //Creo mi array de datos para hacer la consulta
        $datos_actividades = [
            "Inicio" => $fechaInicio,
            "Fin" => $fechaFin,
            "ID" => $id
        ];
        //Obtener resultados
        $actividades = homeModelo::contador_actividades_modelo($tipo, $datos_actividades);

        return $actividades;
    }

    /** Fin de Controlador* */

    /** Controlador para Obtener recurrencia de actividades * */
    public function obtener_recurrencia_fecha_controlador($tipo, $id, $fecha_inicio, $fecha_fin) {
        $fechaInicio = $fecha_inicio;
        $fechaFin = $fecha_fin;

        //Siempre agregarle un dia mas a la fecha fin
        $nueva_fecha_fin = explode("-",$fechaFin);
        $dia =  $nueva_fecha_fin[2];

        //consultar que mes es cuyo numero sea 28
        if($nueva_fecha_fin[1] == 2){
            //Consultar que el dia maximo sea el dia 28
            if($dia==28){
                $fechaFin = $nueva_fecha_fin[0] . "-03-01";
            }else{
                $dia = $dia + 1;
                $fechaFin = $nueva_fecha_fin[0] . "-" . $nueva_fecha_fin[1] . "-" .  $dia; 
            }
        }
        elseif($nueva_fecha_fin[1] == 1 || $nueva_fecha_fin[1] == 3 || $nueva_fecha_fin[1] == 5 || $nueva_fecha_fin[1] == 7 || $nueva_fecha_fin[1] == 8 || $nueva_fecha_fin[1] == 10 || $nueva_fecha_fin[1] == 12){
            if($dia==31){
                
                //consultar el mes si es doce
                if($nueva_fecha_fin[1]==12){
                    $fechaFin = $nueva_fecha_fin[0] + 1 . "-01-01";
                }else{
                    $fechaFin = $nueva_fecha_fin[0] . "-" . $nueva_fecha_fin[1] + 1 . "-01";
                }

            }else{
                $dia = $dia + 1;
                $fechaFin = $nueva_fecha_fin[0] . "-" . $nueva_fecha_fin[1] . "-" .  $dia; 
            }
        }
        elseif($nueva_fecha_fin[1] == 4 || $nueva_fecha_fin[1] == 6 || $nueva_fecha_fin[1] == 9 || $nueva_fecha_fin[1] == 11){
            if($dia==30){
                $fechaFin = $nueva_fecha_fin[0] . "-" . $nueva_fecha_fin[1] + 1 . "-01";
            }
            else{
                $dia = $dia + 1;
                $fechaFin = $nueva_fecha_fin[0] . "-" . $nueva_fecha_fin[1] . "-" .  $dia; 
            }
        }

        //Preparo los datos para la consulta
        //Creo mi array de datos para hacer la consulta
        $datos_actividades = [
            "Inicio" => $fechaInicio,
            "Fin" => $fechaFin,
            "ID" => $id
        ];
        //Obtener resultados
        $actividades = homeModelo::contador_actividades_modelo($tipo, $datos_actividades);

        return $actividades;
    }

    /** Fin de Controlador* */
}
