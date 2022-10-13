<?php

if ($peticionAjax) {
    require_once "../modelos/procesarModelo.php";
} else {
    require_once "./modelos/procesarModelo.php";
}

class procesarControlador extends procesarModelo {

    /** Finalizar Asignacion * */
    public function vincular_equipo_controlador() {

        $sol_act_id = mainModel::limpiar_cadena($_POST['sol_act_id_reg']);
        $codigo_equipo = mainModel::limpiar_cadena($_POST['equipo_codigo_reg']);

        /* --------  Comprobar los campos vacios  -------- */
        if ($codigo_equipo == "" || $sol_act_id == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $codigo_equipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Codigo del Equipo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* ------  Comprobando que el codigode la categoria sea unica ------ */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo_equipo'");
        if ($check_nombre->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Codigo del Activo Informatico no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        /* ----  Comprobando que exista el id de la sol_act_id  ---- */
        $check_id = mainModel::ejecutar_consulta_simple("SELECT sol_act_id FROM solicitud_actividad WHERE sol_act_id='$sol_act_id'");
        if ($check_id->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La actividad seleccionada no se encuentra registrada en el sistema, intente nuevamnete.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---  Chequear que no se registre dos veces el mismo equipo y la misma solicitud --- */
        $check_vinculacion = mainModel::ejecutar_consulta_simple("SELECT equipo_actividad_id FROM equipo_actividad WHERE sol_act_id='$sol_act_id' AND producto_codigo ='$codigo_equipo' LIMIT 0,1");
        if ($check_vinculacion->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La relación que intenta realizar ya se encuentra registrada en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_categoria_reg = [
            "Codigo" => $codigo_equipo,
            "ID" => $sol_act_id
        ];

        /* -- Agregar el registro -- */
        $vincular_equipo = procesarModelo::vincular_equipo_modelo($datos_categoria_reg);
        if ($vincular_equipo->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];

            $accion_bitacora = "Vincular Equipo: codigo equipo - " . $codigo_equipo . ". actividad - " . $sol_act_id;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Equipo vinculado",
                "Texto" => "El equipo ha sido vinculado a la actividad procesada.",
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error. No se pudo registrar la siguienterelacion: Equipo" . $codigo_equipo . ". Actividad - " . $sol_act_id;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para esta nueva categoria, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin de Controlador */

    /* Controlador para agregar un valor a la tabla grafica mensualidad */

    static public function mensualidad_solicitud_controlador($cantidad, $fecha) {
        //Obtener el mes actual
        // $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);

        $mes = $fecha[1];
        $year = $fecha[0];

        //Verificar si existe registro en la tabla grafica solicitudes para el año en curso
        //en caso contrario crear el registro
        $check_graf_solicitudes = mainModel::ejecutar_consulta_simple("SELECT grafica_solicitud_id FROM grafica_solicitud WHERE grafica_solicitud_year='$year' LIMIT 0,1");
        if ($check_graf_solicitudes->rowCount() <= 0) {
            //Crear todo el registro correspondiente al año en curso todos los meses
            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 1,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 2,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 3,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 4,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 5,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 6,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 7,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 8,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 9,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 10,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 11,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 12,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);
        }

        //Agregar la cantidad nueva a la tabla
        $datos_grafica_up = [
            "Cantidad" => $cantidad,
            "Year" => $year,
            "Mes" => $mes
        ];
        /* -- Agregar el registro -- */
        $agregar_grafica_up = procesarModelo::actualizar_grafica_finalizadas_modelo($datos_grafica_up);

        return true;
    }

    /* Fin del Controlador */

    /* Controlador para actualizar la tabla home_operador */

    static public function actualizar_home_operador_controlador($asignacion_id, $fecha) {
        //Obtener año actual
      //  $fecha = mainModel::solo_fecha();
        $fecha_new = explode("-", $fecha);
        $fecha_bd = "0000-00-00";
        $mes_bd = 0;
        $dia_bd = 0;
        $porcentaje = 0;

        $year = $fecha_new[0];
        $mes_actual = $fecha_new[1];
        $dia_actual = $fecha_new[2];

        $fecha_inicio = $year . "-01-01";
        $fecha_fin = $year . "-12-31";

        //Obtener el id del indicador del operador a traves del id asignacion
        $rs_operador = mainModel::ejecutar_consulta_simple("SElECT asignado_a FROM asignacion WHERE asignacion_id='$asignacion_id' LIMIT 0,1");
        $operador_id = 1;
        if ($rs_operador->rowCount() > 0) {
            $rs_operador = $rs_operador->fetch();
            $operador_id = $rs_operador['asignado_a'];
        }

        //Obtener el nombre del operador a traves del id operador
        $rs_nombre_operador = mainModel::ejecutar_consulta_simple("SELECT usuario_nombre, usuario_apellido, usuario_imagen FROM usuario WHERE usuario_id='$operador_id' LIMIT 0,1");
        $operador_nombre = "";
        $operador_imagen = "";
        if ($rs_nombre_operador->rowCount() > 0) {
            $rs_nombre_operador = $rs_nombre_operador->fetch();
            $operador_nombre = $rs_nombre_operador['usuario_nombre'] . ", " . $rs_nombre_operador['usuario_apellido'];
            $operador_imagen = $rs_nombre_operador['usuario_imagen'];
        }

        //Verificar si exite algun registro que contenga el año actual del registro de indicadores
        //En caso contrario crear dichos registros con todas los $indicadores, que esten registradas en BD
        $check_home_operador = mainModel::ejecutar_consulta_simple("SELECT home_operador_id FROM home_operador WHERE home_operador_year ='$year'");
        if ($check_home_operador->rowCount() <= 0) {
            //Buscaremos todas los usuario tipo 3 que son los operadores para crear la tabla home_operador
            $operadores = mainModel::ejecutar_consulta_simple("SELECT usuario_id, usuario_nombre, usuario_apellido, usuario_imagen FROM usuario WHERE usuario_tipo='3'");
            if ($operadores->rowCount() > 0) {
                //Realizar el registro en el foreach de las actividades en la tabla home actividad
                $operadores = $operadores->fetchAll();

                foreach ($operadores as $rows) {
                    //Agregar el registro en la tabla home_actividad
                    $datos_operador_home_reg = [
                        "Year" => $year,
                        "YearCantidad" => 0,
                        "YearPorcentaje" => 0,
                        "MesCantidad" => 0,
                        "MesPorcentaje" => 0,
                        "DiaCantidad" => 0,
                        "DiaPorcentaje" => 0,
                        "UsuarioID" => $rows['usuario_id'],
                        "Nombre" => $rows['usuario_nombre'] . ", " . $rows['usuario_apellido'],
                        "Imagen" => $rows['usuario_imagen'],
                        "Fecha" => $fecha
                    ];
                    /* -- Agregar el registro -- */
                    $agregar_grafica = procesarModelo::agregar_operador_home_modelo($datos_operador_home_reg);
                }
            }
        }

        //Verificar que exista el registro que corresponda al id y al año, de no existir, entonces crear el registro
        $check_reg_operador = mainModel::ejecutar_consulta_simple("SELECT home_operador_id, home_operador_fecha FROM home_operador WHERE home_operador_year ='$year' AND usuario_id='$operador_id'");
        if ($check_reg_operador->rowCount() <= 0) {
            //Obtener el nombre de la actividad
            //Agregar el registro
            $datos_operador_home_reg = [
                "Year" => $year,
                "YearCantidad" => 0,
                "YearPorcentaje" => 0,
                "MesCantidad" => 0,
                "MesPorcentaje" => 0,
                "DiaCantidad" => 0,
                "DiaPorcentaje" => 0,
                "UsuarioID" => $operador_id,
                "Nombre" => $operador_nombre,
                "Imagen" => $operador_imagen,
                "Fecha" => $fecha
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = procesarModelo::agregar_operador_home_modelo($datos_operador_home_reg);
        } else {
            $check_reg_operador = $check_reg_operador->fetch();
            //Obtener datos que necesito para hacer las comprobaciones, mes, dia, año
            $fecha_bd = $check_reg_operador['home_operador_fecha'];
            $new_fecha_bd = explode("-", $fecha_bd);
            $mes_bd = $new_fecha_bd[1];
            $dia_bd = $new_fecha_bd[2];
        }

        //Ahora si se actuliza la cantidad y el porcentaje.
        //Se tiene que obtener el total de solicitud_actividades, para asi sacar el porcentaje
        $total_solicitudes = mainModel::ejecutar_consulta_simple("SELECT sol_act_id FROM solicitud_actividad WHERE solicitud_estado='finalizado' AND solicitud_fin>='$fecha_inicio' AND solicitud_fin<'$fecha_fin'");
        $total_solicitudes = $total_solicitudes->rowCount();

        //la cantidad seria igual a 1a actividad escogida
        if ($total_solicitudes != 0) {
            $porcentaje = (1 * 100) / $total_solicitudes;
            $porcentaje = round($porcentaje, 2);
        } else {
            $porcentaje = 0;
        }


        //Actualizar solicitud finalizada al año
        $datos_operador_home_up = [
            "Cantidad" => 1,
            //"Porcentaje" => $porcentaje,
            "Year" => $year,
            "Operador" => $operador_id
        ];
        /* -- Agregar el registro -- */
        $agregar_anual = procesarModelo::actualizar_operador_home_anual_modelo($datos_operador_home_up);

        //ACTUALIZAR EL MES SI ES IGUAL AL MES ACTUAL SUMARLE LA CANTIDAD Y EL PORCENTAJE
        if ($mes_actual == $mes_bd) {
            $datos_operador_home_up = [
                "Cantidad" => 1,
                // "Porcentaje" => $porcentaje,
                "Year" => $year,
                "Operador" => $operador_id
            ];
            /* -- Agregar el registro -- */
            $agregar_mes = procesarModelo::actualizar_operador_home_mes_modelo($datos_operador_home_up);
        } else {
            //SI EL MES DE LA BASE DE DATOS ES DIFERENE A LA ACTUAL, EMPEZARIA DESDE UNO, Y SE ACTUALIZARIA LA FECHA
            $datos_operador_home_up = [
                "Cantidad" => 1,
                // "Porcentaje" => $porcentaje,
                "Year" => $year,
                "Operador" => $operador_id,
                "Fecha" => $fecha
            ];
            /* -- Agregar el registro -- */
            $agregar_mes = procesarModelo::actualizar_operador_home_mes_diferente_modelo($datos_operador_home_up);
        }

        //ACTUALIZAR EL DIA SI ES IGUAL AL DIA ACTUAL SUMARLE LA CANTIDAD Y EL PORCENTAJE
        if ($dia_actual == $dia_bd) {
            $datos_operador_home_up = [
                "Cantidad" => 1,
                // "Porcentaje" => $porcentaje,
                "Year" => $year,
                "Operador" => $operador_id
            ];
            /* -- Agregar el registro -- */
            $agregar_dia = procesarModelo::actualizar_operador_home_dia_modelo($datos_operador_home_up);
        } else {
            //SI EL DIA DE LA BASE DE DATOS ES DIFERENE AL DIA ACTUAL, EMPEZARIA DESDE UNO, Y SE ACTUALIZARIA LA FECHA
            $datos_operador_home_up = [
                "Cantidad" => 1,
                //"Porcentaje" => $porcentaje,
                "Year" => $year,
                "Operador" => $operador_id,
                "Fecha" => $fecha
            ];
            /* -- Agregar el registro -- */
            $agregar_dia = procesarModelo::actualizar_operador_home_dia_diferente_modelo($datos_operador_home_up);
        }

        //Ciclo para recorrer todos los usuarios y sacar el porcentaje que le toca a todos anualmente
        $recorrer_operadores = mainModel::ejecutar_consulta_simple("SELECT home_operador_id, home_operador_cantidad_anual, home_operador_cantidad_mensual, home_operador_cantidad_diario FROM home_operador WHERE home_operador_year ='$year'");
        if ($recorrer_operadores->rowCount() > 0) {
            $recorrer_operadores = $recorrer_operadores->fetchAll();
            
            foreach ($recorrer_operadores as $row){
            
            $id_actualizar = $row['home_operador_id'];
            //Obtener el procentaje anual
            $total_cantidad_anual = $row['home_operador_cantidad_anual'];
            $total_porcentaje_anual = $total_cantidad_anual * $porcentaje;
            
            //obtener el porcentaje mensual
            $total_cantidad_mensual = $row['home_operador_cantidad_mensual'];
            $total_porcentaje_mensual = $total_cantidad_mensual * $porcentaje;
            
            //Obtener porcentaje diario
            $total_cantidad_diario = $row['home_operador_cantidad_diario'];
            $total_porcentaje_diario = $total_cantidad_diario * $porcentaje;
            
            
            //obtener el porcentaje diario

            $porcentajes_home_up = [
                "ID" => $id_actualizar,
                "YearPorcentaje" => $total_porcentaje_anual,
                "MesPorcentaje" =>$total_porcentaje_mensual,
                "DiaPorcentaje" => $total_porcentaje_diario
            ];
            /* -- Agregar el registro -- */
            $agregar_porcentajes_home = procesarModelo::actualizar_home_porcentajes_modelo($porcentajes_home_up);
            }
            
            
        }

        return true;
    }

    /* Fin del Controlador */

    /** Finalizar Asignacion * */
    public function finalizar_asignacion_controlador() {

        $asignacion = mainModel::limpiar_cadena($_POST['finalizar_asignacion_id_reg']);
        $estado = "finalizado";
        //Obtener la fecha
        $fecha = mainModel::limpiar_cadena($_POST['fecha_reg']);
        $hora_solicitud = mainModel::crear_fecha();
        $rs_hora = explode (" ", $hora_solicitud);
        $hora = $rs_hora[1];

        $fecha_fin = $fecha . ' ' . $hora;

        $URL = SERVERURL . "procesar-new/";

        //Obtener nuevo enlace 

        $asignacion_encryp = mainModel::encryption($asignacion);
        $enlace = '<a href="' . SERVERURL . 'reporte/print-asignacion-view.php?asignacion_id=' . $asignacion_encryp . '" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; imprimir</a>';

        /* --------  Comprobar los campos vacios  -------- */
        if ($asignacion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        //Verificar la integridad de los datos
        if (mainModel::verificar_datos("[0-9]{1,11}", $asignacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El numero de asignacion para el archivo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Chequear que la asignacion este registrada en la base de datos
        $check_asignacion = mainModel::ejecutar_consulta_simple("SELECT asignacion_id, solicitud_actividad FROM asignacion WHERE asignacion_id='$asignacion'");
        if ($check_asignacion->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La asignacion no esta registrada en la base de datos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $rs_id = $check_asignacion->fetch();
            $ID_solicitud_actividad = $rs_id['solicitud_actividad'];
        }

        //Chequear si la solicitud que intenta finalizar ya esta finalizada
        $check_solicitud_finalizada = mainModel::ejecutar_consulta_simple("SELECT sol_act_id FROM solicitud_actividad WHERE solicitud_estado='finalizado' AND sol_act_id='$ID_solicitud_actividad'");
        if ($check_solicitud_finalizada->rowCount() > 0) {
            /*  $alerta = [
              "Alerta" => "simple",
              "Titulo" => "Ha ocurrido un error inesperado",
              "Texto" => "La asignacion que intenta finalizar, ya ha sido finalizada anteriormente.",
              "Tipo" => "error"
              ]; */

            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => $URL
            ];

            echo json_encode($alerta);
            exit();
        }

        /* Obtener el id de la solicitud para asi cambiar su estado */
        $obt_id_solicitud = mainModel::ejecutar_consulta_simple("SELECT solicitud_id FROM solicitud_actividad WHERE sol_act_id='$ID_solicitud_actividad'");
        if ($obt_id_solicitud->rowCount() > 0) {
            $id_solicitud = $obt_id_solicitud->fetch();
            $id_solicitud_act = $id_solicitud['solicitud_id'];

            $datos_actualizar_estado = [
                "Estado" => "evaluar",
                "ID" => $id_solicitud_act
            ];
            $actualizar_estado = procesarModelo::actualizar_solicitud_modelo($datos_actualizar_estado);
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_finalizar_reg = [
            "Estado" => $estado,
            "Fin" => $fecha_fin,
            "ID" => $ID_solicitud_actividad
        ];

        $url = SERVERURL . "procesar-new/";

        /* -- Agregar el registro -- */
        $agregar_procesar = procesarModelo::finalizar_asignacion_modelo($datos_finalizar_reg);
        if ($agregar_procesar->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            //Actualizar estado de la solicitud
            //Agregar a la grafica una solicitud finalizada
            $actualizar_solicitud = procesarControlador::mensualidad_solicitud_controlador(1, $fecha);

            //agregar a la tabla home operador
            $actualizar_home_operador = procesarControlador::actualizar_home_operador_controlador($asignacion, $fecha);

            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Asignacion finalizada: " . $ID_solicitud_actividad;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            /* Mensaje de Finalizada Actividad
              $alerta = [
              "Alerta" => "redireccionar",
              "URL" => $URL
              ]; */
            /** Codigo Viejo
              $alerta = [
              "Alerta" => "recargarlink",
              "Titulo" => "Actividad Finalizada",
              "Texto" => "Se ha realizado el registro de manera satisfactoria.",
              "Footer"=> $enlace,
              "Tipo" => "success"
              ]; codigo nueevo * */
            $alerta = [
                "Alerta" => "linkredireccionar",
                "Titulo" => "Actividad Finalizada",
                "Texto" => "Se ha finalizado el proceso de manera satisfactoria.",
                "Tipo" => "success",
                "Footer" => $enlace,
                "URL" => $url
            ];
        } else {
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error. No se pudo finalizar la asignacion:" . $ID_solicitud_actividad;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido finalizar la asignacion, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin de Controlador */

    /** Verificar que este o no registrado un paso en la tabla procesamiento * */
    public function verificar_paso_procesado_controlador($asignacion_id, $paso_id) {
        $consulta = mainModel::ejecutar_consulta_simple("SELECT procesar_id FROM procesar WHERE asignacion_id='$asignacion_id' AND paso_id='$paso_id'");
        return $consulta;
    }

    /** Controlador para agregar una procesar * */
    public function agregar_procesar_controlador() {

        $observacion = mainModel::limpiar_cadena($_POST['procesar_observacion_reg']);
        $asignacion = mainModel::limpiar_cadena($_POST['procesar_asignacion_id_reg']);
        $paso = mainModel::limpiar_cadena($_POST['procesar_paso_id_reg']);
        /*$fecha_inicio = mainModel::limpiar_cadena($_POST['procesar_fecha_inicio_reg']);
        $fecha_fin = mainModel::crear_fecha();*/



        ///
        $fecha1 = mainModel::limpiar_cadena($_POST['procesar_fecha_inicio_reg']);
        $hora_solicitud1 = mainModel::crear_fecha();
        $rs_hora = explode (" ", $hora_solicitud1);
        $hora1 = $rs_hora[1];

        $fecha_inicio = $fecha1 . ' ' . $hora1;

        $fecha2 = mainModel::limpiar_cadena($_POST['procesar_fecha_fin_reg']);
        $hora_solicitud2 = mainModel::crear_fecha();
        $rs_hora2 = explode (" ", $hora_solicitud2);
        $hora2 = $rs_hora2[1];

        $fecha_fin = $fecha2 . ' ' . $hora2;

        /* --------  Comprobar los campos vacios  -------- */
        if ($asignacion == "" || $paso == "" || $fecha_inicio == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($observacion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,500}", $observacion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La descripcion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }



        /* Validar asignacion, paso y fecha de inicio */
        /* Asignacion */
        $check_asignacion = mainModel::ejecutar_consulta_simple("SELECT asignacion_id FROM asignacion WHERE asignacion_id='$asignacion'");
        if ($check_asignacion->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "La asignacion no se encuetra registrado en el sistema, intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        /* Paso */
        $check_paso = mainModel::ejecutar_consulta_simple("SELECT paso_id FROM paso WHERE paso_id='$paso'");
        if ($check_paso->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "El paso seleccionado no se encuetra registrado en el sistema, intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Fecha de Inicio de procesar el paso */
        $exp_fecha = explode(" ", $fecha_inicio);
        if (mainModel::verificar_fechas($exp_fecha[0])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La fecha de inicio no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /*
          $alerta = [
          "Alerta" => "simple",
          "Titulo" => "Ha ocurrido un error inesperado",
          "Texto" => "Observacion " . $observacion . " Asignacion " . $asignacion . " paso " . $paso . " fecha inicio " . $fecha_inicio . " fecha fin " . $fecha_fin,
          "Tipo" => "error"
          ];
          echo json_encode($alerta);
          exit();
         * 
         */

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_procesar_reg = [
            "Asignacion" => $asignacion,
            "Paso" => $paso,
            "Observacion" => $observacion,
            "Inicio" => $fecha_inicio,
            "Fin" => $fecha_fin
        ];

        /* -- Agregar el registro -- */
        $agregar_procesar = procesarModelo::agregar_procesar_modelo($datos_procesar_reg);
        if ($agregar_procesar->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Creacion de nuevo paso procesado: " . $observacion;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Paso Procesado",
                "Texto" => "Se ha procesado el paso de manera satisfactoria .",
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error. No se pudo registrar la siguiente paso procesado:" . $observacion;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para esta nueva procesar, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador */

    /** Controlador paginar procesars * */
    public function paginador_procesar_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM procesar WHERE procesar_nombre LIKE '%$busqueda%' OR procesar_descripcion LIKE '%$busqueda%' ORDER BY procesar_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Hizo la siguiente busqueda: " . $busqueda . " en el listado de procesars";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM procesar ORDER BY procesar_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Visualizo el listado de procesars";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        }

        $conexion = mainModel::conectar(); //creamos nuestra con conexion con el modelo principal
        $datos = $conexion->query($consulta); //ejecutamos la consulta a traves de un query, que se usa para ejecutar la consulta
        $datos = $datos->fetchAll(); //fetchAll para crear un array con todos los datos obtenidos de la base de datos

        $total = $conexion->query("SELECT FOUND_ROWS()"); //Para contar todos los registros de mi consulta a la base de datos, pero en la consulta debe de ir SQL_CALC_FOUND_ROWS despues del SELECT
        $total = (int) $total->fetchColumn(); //luego de la consulta anterior con esto se cuenta cuantos registros hay en la base de datos

        $Npaginas = ceil($total / $registros); //Funcion PHP Para redondear los numeros de paginas que devuelve el llamado a la base de datos a su numero mas proximo

        $tabla .= '<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<tr class="text-center roboto-medium">
					<th>#</th>
					<th>CATEGORIA</th>
                    <th>DESCRIPCION</th>';

        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '<th>ACTUALIZAR</th>';
        }
        if ($privilegio == 1) {
            $tabla .= '<th>ELIMINAR</th>';
        }

        $tabla .= '</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['procesar_nombre'] . '</td>
                                        <td class="text-left">' . $rows['procesar_descripcion'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'procesar-update/' . mainModel::encryption($rows['procesar_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/procesarAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="procesar_id_del" value="' . mainModel::encryption($rows['procesar_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        </td>';
                }


                $tabla .= '</tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="5"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="5">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando procesar ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

/* Fin Controlador paginador procesar */

    /** Controlador para eliminar procesar * */
    public function eliminar_procesar_controlador($id) {
        /* --- recibiendo id de la procesar --- */
        $id = mainModel::decryption($_POST['procesar_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la procesar en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT procesar_id, procesar_nombre FROM procesar WHERE procesar_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Categoria que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $check_nombre = $check_nombre->fetch();
            $nombre_procesar = $check_nombre['procesar_nombre'];
        }

        /* Comprobar que la procesar no este relacionada a alguna actividad... */


        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar esta procesar",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_procesar = procesarModelo::eliminar_procesar_modelo($id);

        if ($eliminar_procesar->rowCount() == 1) {
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Elimino la siguiente procesar: " . $nombre_procesar;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Categoria Eliminada",
                "Texto" => "La Categoria ha sido eliminada del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error al tratar de eliminar la siguiente procesar: " . $nombre_procesar;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la procesar seleccionada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

/* Fin Controlador eliminar procesar */

    /** Controlador para obtener los datos de la procesar * */
    public function datos_procesar_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return procesarModelo::datos_procesar_modelo($tipo, $id);
    }

/* Fin Controlador obtener datos */

    /* Controlador para editar procesar */

    public function actualizar_procesar_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['procesar_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la procesar mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM procesar WHERE procesar_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado la Categoria en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }


        $nombre = mainModel::limpiar_cadena($_POST['procesar_nombre_up']);
        $descripcion = mainModel::limpiar_cadena($_POST['procesar_descripcion_up']);

        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $descripcion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre la procesar no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,300}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La descripcion para la procesar no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Comprobar que el nombre a ingresar no este ya registrador en el sistema
        if ($nombre != $campos['procesar_nombre']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT procesar_nombre FROM procesar WHERE procesar_nombre='$nombre'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre de la procesar ingresada ya se encuentra registrada en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /* Comprobar privilegios del usuario que esta intentado editar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1 && $_SESSION['privilegio_tor'] != 2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para editar esta procesar esta procesar",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando los datos para enviarlos al modelo
        $datos_procesar_up = [
            "Nombre" => $nombre,
            "Descripcion" => $descripcion,
            "ID" => $id
        ];

        if (procesarModelo::actualizar_procesar_modelo($datos_procesar_up)) {

            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Actualizo la siguiente procesar: " . $nombre;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos de la procesar fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "No puso actualizar la siguiente procesar: " . $nombre;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos de la procesar no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador editar procesar */
}
