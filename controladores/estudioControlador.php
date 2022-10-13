<?php
if ($peticionAjax) {
    require_once "../modelos/estudioModelo.php";
} else {
    require_once "./modelos/estudioModelo.php";
}

class estudioControlador extends estudioModelo {

    /** Controlador para agregar una estudio **/
    public function agregar_estudio_controlador() {
        //Fecha del registro
        $fecha_registro = mainModel::crear_fecha();
        //DATOS PERSONALES
        $nombre = mainModel::limpiar_cadena($_POST['nombres_apellidos_solicitante_reg']);
        $tipo_documento = mainModel::limpiar_cadena($_POST['tipo_cedula_solicitante_reg']);
        $cedula_solicitante = mainModel::limpiar_cadena($_POST['numero_cedula_solicitante_reg']);
        $nacionalidad_solicitante = mainModel::limpiar_cadena($_POST['nacionalidad_solicitante_reg']);
        $estado_civil = mainModel::limpiar_cadena($_POST['estado_civil_reg']);
        $telefono_fax_celular = mainModel::limpiar_cadena($_POST['telefono_fax_celular_reg']);
        $lugar_nacimiento_solicitante = mainModel::limpiar_cadena($_POST['lugar_nacimiento_solicitante_reg']);
        $estado_nacimiento = mainModel::limpiar_cadena($_POST['estado_nacimiento_reg']);
        $fecha_nacimiento = mainModel::limpiar_cadena($_POST['fecha_nacimiento_reg']);
        $genero = mainModel::limpiar_cadena($_POST['genero_reg']);
        $direccion_permanente = mainModel::limpiar_cadena($_POST['direccion_permanente_reg']);
        $municipio = mainModel::limpiar_cadena($_POST['municipio_reg']);
        $parroquia = mainModel::limpiar_cadena($_POST['parroquia_reg']);
        $estado = mainModel::limpiar_cadena($_POST['estado_reg']);
        //GRADO INSTRUCCION
        $grado_instruccion = mainModel::limpiar_cadena($_POST['grado_instruccion_reg']);
        //SITUACION SOCIOECONOMICA
        $trabaja = mainModel::limpiar_cadena($_POST['trabaja_reg']);
        $profesion = mainModel::limpiar_cadena($_POST['profesion_reg']);
        $institucion = mainModel::limpiar_cadena($_POST['institucion_reg']);
        $ocupacion = mainModel::limpiar_cadena($_POST['ocupacion_reg']);
        $telefono_trabajo = mainModel::limpiar_cadena($_POST['telefono_trabajo_reg']);
        $direccion_trabajo = mainModel::limpiar_cadena($_POST['direccion_trabajo_reg']);
        $ingreso_familiar = mainModel::limpiar_cadena($_POST['ingreso_familiar_reg']);
        $observaciones = mainModel::limpiar_cadena($_POST['observaciones_reg']);
        //TIPO DE VIVIENDA Y TENENCIA
        $tipo_vivienda = mainModel::limpiar_cadena($_POST['tipo_vivienda_reg']);
        $tenencia_vivienda = mainModel::limpiar_cadena($_POST['tenencia_vivienda_reg']);
        //ESTUDIO SOCIAL
        $tipo_ayuda = mainModel::limpiar_cadena($_POST['tipo_ayuda_reg']);
        $sintesis_caso = mainModel::limpiar_cadena($_POST['sintesis_caso_reg']);
        $area_socioeconomica = mainModel::limpiar_cadena($_POST['area_socioeconomica_reg']);
        $conclusion = mainModel::limpiar_cadena($_POST['conclusion_reg']);
        //DOCUMENTOS ANEXOS
        $planilla_solicitud = mainModel::limpiar_cadena($_POST['planilla_solicitud_reg']);
        $copia_cedula = mainModel::limpiar_cadena($_POST['copia_cedula_reg']);
        $informe_medico = mainModel::limpiar_cadena($_POST['informe_medico_reg']);
        $rif = mainModel::limpiar_cadena($_POST['rif_reg']);
        $presupuesto = mainModel::limpiar_cadena($_POST['presupuesto_reg']);
        $orden_medica = mainModel::limpiar_cadena($_POST['orden_medica_reg']);
        $carta = mainModel::limpiar_cadena($_POST['carta_reg']);
        $acta_nacimiento = mainModel::limpiar_cadena($_POST['acta_nacimiento_reg']);
        //FIRMAS INFORME SOCIAL
        $elaborado_por = mainModel::limpiar_cadena($_POST['elaborado_por_reg']);
        $nombre_apellido_elaborado = mainModel::limpiar_cadena($_POST['nombre_apellido_elaborado_reg']);
        $cedula_elaborado = mainModel::limpiar_cadena($_POST['cedula_elaborado_reg']);
        $supervisado_por = mainModel::limpiar_cadena($_POST['supervisado_por_reg']);
        $nombre_apellido_supervisado = mainModel::limpiar_cadena($_POST['nombre_apellido_supervisado_reg']);
        $cedula_supervisado = mainModel::limpiar_cadena($_POST['cedula_supervisado_reg']);
        $aprobado_por = mainModel::limpiar_cadena($_POST['aprobado_por_reg']);
        $nombre_apellido_aprobado = mainModel::limpiar_cadena($_POST['nombre_apellido_aprobado_reg']);
        $cedula_aprobado = mainModel::limpiar_cadena($_POST['cedula_aprobado_reg']);



       

        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == ""  || $tipo_documento == "" || $cedula_solicitante == "")   {
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
                "Texto" => "El Nombre y el apellido del ciudadano solicitante no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9-]{5,30}", $cedula_solicitante)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El número del cédula del solicitante no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($tipo_documento != "V-" && $tipo_documento != "E-") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El número del cédula del solicitante no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //VALORES QUE PÚEDEN VENIR VACIOS DATOS PERSONALES
        if($nacionalidad_solicitante!=""){
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $nacionalidad_solicitante)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La nacionalidad del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if($estado_civil!=""){
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,20}", $estado_civil)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El estado civil del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if($telefono_fax_celular!=""){
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,40}", $telefono_fax_celular)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El número de telefono del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if($lugar_nacimiento_solicitante!=""){
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $lugar_nacimiento_solicitante)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El lugar de nacimiento del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if($estado_nacimiento!=""){
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $estado_nacimiento)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Estado donde nacio del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if($fecha_nacimiento!=""){
            if (mainModel::verificar_fechas($fecha_nacimiento)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La fecha de nacimiento del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($genero!="FEMENINO" && $genero!="MASCULINO") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El genero del ciudadano solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if($direccion_permanente!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $direccion_permanente)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La direccion permanente del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($municipio!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,30}", $municipio)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El municipio del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($parroquia!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $parroquia)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La parroquia del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($estado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $estado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El Estado del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            //GRADO DE INSTRUCCION 
            if ($grado_instruccion != "NO POSEE" && $grado_instruccion != "PRIMARIA" && $grado_instruccion != "SECUNDARIA" && $grado_instruccion != "TECNICA" && $grado_instruccion != "UNIVERSITARIA") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El grado de instrucción del solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            //ESTUDIO SOCIOECONOMICO
            if ($trabaja != "NO" && $trabaja != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor agregado para el tipo trabaja no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if($profesion!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $profesion)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La profesión del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($institucion!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,120}", $institucion)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La institución o empresa donde trabaja el ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($ocupacion!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,120}", $ocupacion)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La ocupación del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($telefono_trabajo!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,40}", $telefono_trabajo)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El Número de teléfono del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($direccion_trabajo!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $direccion_trabajo)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La dirección de trabajo del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($ingreso_familiar!=""){
                if (mainModel::verificar_datos("[0-9.]{1,25}", $ingreso_familiar)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El ingreso familiar del ciudadano solicitante no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($observaciones!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $observaciones)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El campo observaciones no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            //TIPO DE VIVIENDA Y TENENCIA DE VIVIENDA 
            if ($tipo_vivienda != "APARTAMENTO" && $tipo_vivienda != "QUINTA" && $tipo_vivienda != "RANCHO" && $tipo_vivienda != "CASA" && $tipo_vivienda != "OTRO") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El tipo de vivienda del solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($tenencia_vivienda != "PROPIA" && $tenencia_vivienda != "ALQUILADA" && $tenencia_vivienda != "ALOJADA" && $tenencia_vivienda != "COMPARTIDA" && $tenencia_vivienda != "OTRO") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor para la tenencia de vivienda del solicitante no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            //ESTUDIO SOCIAL  
            if($tipo_ayuda!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $tipo_ayuda)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El tipo de ayuda no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }  
            if($sintesis_caso!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $sintesis_caso)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La sintesis del caso no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($area_socioeconomica!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $area_socioeconomica)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El área socioeconómica no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($conclusion!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $conclusion)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "La conclusión no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            //DOCUMENTOS ANEXOS
            if ($planilla_solicitud != "NO" && $planilla_solicitud != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor para la planilla de solicitud no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($copia_cedula != "NO" && $copia_cedula != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor para la copia de cedula de identidad no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($informe_medico != "NO" && $informe_medico != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor documento informe medico no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($rif != "NO" && $rif != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor del rif no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($presupuesto != "NO" && $presupuesto != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor para el presupuesto no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($orden_medica != "NO" && $orden_medica != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor de la orden medica no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($carta != "NO" && $carta != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor de la carta para el gobernador no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            if ($acta_nacimiento != "NO" && $acta_nacimiento != "SI") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El valor del acta de nacimiento no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            //FIRMAS DEL ESTUDIO SOCIAL
            if($elaborado_por!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $elaborado_por)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de elaborado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($nombre_apellido_elaborado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $nombre_apellido_elaborado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de nombre y apellido de elaborado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($cedula_elaborado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $cedula_elaborado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de la cedula de elaborado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($supervisado_por!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $supervisado_por)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de supervisado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($nombre_apellido_supervisado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $nombre_apellido_supervisado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de nombre y apellido de supervisado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($cedula_supervisado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $cedula_supervisado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de la cedula de supervisado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($aprobado_por!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $aprobado_por)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de aprobado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($nombre_apellido_aprobado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $nombre_apellido_aprobado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de nombre y apellido de aprobacion por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            if($cedula_aprobado!=""){
                if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $cedula_aprobado)) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El valor de la cedula de aprobado por no coincide con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }


        /* ------  Comprobando que el numero de cedula ya no este previamente registrado ------ */
        $check_cedula_solicitante = mainModel::ejecutar_consulta_simple("SELECT estudio_cedula_solicitante FROM estudio WHERE estudio_cedula_solicitante='$cedula_solicitante'");
        if ($check_cedula_solicitante->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Numero de Cédula del solicitante que acaba de ingresar, ya se encuentra registrado en el sistema, por favor modifique el valor y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_estudio_reg = [
            //Datos Personales
            "NombreSolicitante" => $nombre,
            "TipoDocumento" => $tipo_documento,
            "CedulaSolicitante" => $cedula_solicitante,
            "Nacionalidad_solicitante" => $nacionalidad_solicitante,
            "Estado_civil" => $estado_civil,
            "Telefono_fax_celular" => $telefono_fax_celular,
            "Lugar_nacimiento_solicitante" => $lugar_nacimiento_solicitante,
            "Estado_nacimiento" => $estado_nacimiento,
            "Fecha_nacimiento" => $fecha_nacimiento,
            "Genero" => $genero,
            "Direccion_permanente" => $direccion_permanente,
            "Municipio" => $municipio,
            "Parroquia" => $parroquia,
            "Estado" => $estado,

            "FechaRegistro" => $fecha_registro,
            //GRADO INSTRUCCION 
            "Grado_instruccion" => $grado_instruccion,

            // SITUACION SOCIOECONOMICA
            "Trabaja" => $trabaja,
            "Profesion" => $profesion,
            "Institucion" => $institucion,
            "Ocupacion" => $ocupacion,
            "Telefono_trabajo" => $telefono_trabajo,
            "Direccion_trabajo" => $direccion_trabajo,
            "Ingreso_familiar" => $ingreso_familiar,
            "Observaciones" => $observaciones,

            //TIPO DE VIVIENDA Y TENENCIA
            "Tipo_vivienda" => $tipo_vivienda,
            "Tenencia_vivienda" => $tenencia_vivienda,

            //ESTUDIO SOCIAL
            "Tipo_ayuda" => $tipo_ayuda,
            "Sintesis_caso" => $sintesis_caso,
            "Area_socioeconomica" => $area_socioeconomica,
            "Conclusion" => $conclusion,

            //DOCUMENTOS ANEXOS
            "Planilla_solicitud" => $planilla_solicitud,
            "Copia_cedula" => $copia_cedula,
            "Informe_medico" => $informe_medico,
            "Rif" => $rif,
            "Presupuesto" => $presupuesto,
            "Orden_medica" => $orden_medica,
            "Carta" => $carta,
            "Acta_nacimiento" => $acta_nacimiento,

            //FIRMAS DEL ESTUDIO SOCIAL
            "Elaborado_por" => $elaborado_por,
            "Nombre_apellido_elaborado" => $nombre_apellido_elaborado,
            "Cedula_elaborado" => $cedula_elaborado,
            "Supervisado_por" => $supervisado_por,
            "Nombre_apellido_supervisado" => $nombre_apellido_supervisado,
            "Cedula_supervisado" => $cedula_supervisado,
            "Aprobado_por" => $aprobado_por,
            "Nombre_apellido_aprobado" => $nombre_apellido_aprobado,
            "Cedula_aprobado" => $cedula_aprobado

        ];

        /* -- Agregar el registro -- */
        $agregar_estudio = estudioModelo::agregar_estudio_modelo($datos_estudio_reg);

        $cedula_solicitante_encryp = mainModel::encryption($cedula_solicitante);
        $enlace = '<a href="' . SERVERURL . 'reporte/estudio-social-view.php?cedula_id=' . $cedula_solicitante_encryp . '" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; imprimir</a>';


        if ($agregar_estudio->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            
            session_start(['name' => 'TOR']);
            unset($_SESSION['cedula_solicitante']);
            $alerta = [
                "Alerta" => "recargarlink",
                "Titulo" => "Informe Social Registrado",
                "Texto" => "Los datos del nuevo Informe Social se han registrado satisfactoriamente.",
                "Footer" => $enlace,
                "Tipo" => "success"
            ];
        } else {
       
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para este nuevo estudio, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

     /** Controlador para agregar un familiar **/
     public function agregar_familiar_controlador() {

        $nombre = mainModel::limpiar_cadena($_POST['nombre_familiar_reg']);
        $cedula_familiar= mainModel::limpiar_cadena($_POST['cedula_familiar_reg']);
        $cedula_solicitante = mainModel::limpiar_cadena($_POST['numero_cedula_solicitante_familiar_reg']);
        
        $lugar_nacimiento_familiar = mainModel::limpiar_cadena($_POST['lugar_nacimiento_familiar_reg']);
        $fecha_nacimiento_familiar = mainModel::limpiar_cadena($_POST['fecha_nacimiento_familiar_reg']);
        $genero_familiar = mainModel::limpiar_cadena($_POST['genero_familiar_reg']);
        $ocupacion_familiar = mainModel::limpiar_cadena($_POST['ocupacion_familiar_reg']);
        $filiacion = mainModel::limpiar_cadena($_POST['filiacion_reg']);
        
        session_start(['name' => 'TOR']);
        $_SESSION['cedula_solicitante']=$cedula_solicitante;
       

        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == ""  || $cedula_familiar == "" || $cedula_solicitante == "")   {
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
                "Texto" => "El Nombre y el apellido del ciudadano solicitante no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9-]{5,30}", $cedula_solicitante)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El número del cédula del solicitante no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9-]{5,30}", $cedula_familiar)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El número del cédula del familiar no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,200}", $lugar_nacimiento_familiar)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Lugar de Nacimiento no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_fechas($fecha_nacimiento_familiar)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La fecha de nacimiento no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($genero_familiar!="MASCULINO" && $genero_familiar!="FEMENINO") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El tipo de Genero no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $ocupacion_familiar)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La ocupacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $filiacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "La filiacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* ------  Comprobando que el numero de cedula del familiar no este vinculada al usuario solicitante. -- */
        $check_cedula_familiar = mainModel::ejecutar_consulta_simple("SELECT familiar_id FROM familiar WHERE estudio_cedula_solicitante='$cedula_solicitante' AND familiar_cedula='$cedula_familiar'");
        if ($check_cedula_familiar->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Numero de Cédula del familiar que acaba de ingresar, ya se encuentra vinculado al solicitante, por favor modifique el valor y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_estudio_reg = [
            "NombreFamiliar" => $nombre,
            "CedulaFamiliar" => $cedula_familiar,
            "CedulaSolicitante" => $cedula_solicitante,

            "Filiacion" => $filiacion,
            "Ocupacion" => $ocupacion_familiar,
            "LugarNacimiento" => $lugar_nacimiento_familiar,
            "FechaNacimiento" => $fecha_nacimiento_familiar,
            "Genero" => $genero_familiar

        ];

        /* -- Agregar el registro -- */
        $agregar_estudio = estudioModelo::agregar_familiar_modelo($datos_estudio_reg);
        if ($agregar_estudio->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

           
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Familiar Registrado",
                "Texto" => "Borre en el formulario los datos del familiar, que acaba de registrar en el sistema.",
                "Tipo" => "success"
            ];
        } else {
       
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para este familiar, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

    /** Controlador paginar estudios **/
    public function paginador_estudio_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM estudio WHERE estudio_nombre_solicitante LIKE '%$busqueda%' OR estudio_cedula_solicitante LIKE '%$busqueda%' OR estudio_fecha_solicitud LIKE '%$busqueda%' ORDER BY estudio_nombre_solicitante ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de estudio";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM estudio ORDER BY estudio_nombre_solicitante ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de estudio";
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
					<th>Ciudadano Solicitante</th><th>No. Cedula</th><th>Fecha Solicitud</th>';

        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '<th>PROCESAR</th>';
        }
        if ($privilegio == 1) {
            $tabla .= '<th>ELIMINAR</th>';
        }

		$tabla .='</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['estudio_nombre_solicitante'] . '</td>
                                        <td class="text-left">' . $rows['estudio_cedula_solicitante'] . '</td>
                                        <td class="text-left">' . $rows['estudio_fecha_solicitud'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'reporte/estudio-social-view.php?cedula_id=' . mainModel::encryption($rows['estudio_cedula_solicitante']) . '/" class="btn btn-3d btn-info" target="_black"><i class="fa fa-print"></i></a>&nbsp;&nbsp;&nbsp;';
                    $tabla .= '<a href="' . SERVERURL . 'estudio-social-update/' . mainModel::encryption($rows['estudio_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/estudioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="estudio_id_del" value="' . mainModel::encryption($rows['estudio_id']) . '">
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
                $tabla .= '<tr class="text-center"><td colspan="6"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="6">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando estudio ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador estudio*/

     /** Controlador paginar familiares **/
     public function paginador_familiar_controlador($pagina, $registros, $url) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        //verificar que la variable de sesion este creada 
        $cedula_solicitante = 0;
        if(isset($_SESSION['cedula_solicitante'])){
            $cedula_solicitante = $_SESSION['cedula_solicitante'];
        }

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM familiar WHERE estudio_cedula_solicitante LIKE '$cedula_solicitante' ORDER BY familiar_nombre ASC LIMIT $inicio,$registros";
        
       

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
					<th>Nombre y Apellido</th><th>No. Cedula</th><th>Fecha Nac.</th><th>Lugar Nac.</th><th>Genero</th><th>Ocupacion</th><th>Filiacion</th><th>ELIMINAR</th>';


		$tabla .='</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['familiar_nombre'] . '</td>
                                        <td class="text-left">' . $rows['familiar_cedula'] . '</td>
                                        <td class="text-left">' . $rows['familiar_fecha_nacimiento'] . '</td>
                                        <td class="text-left">' . $rows['familiar_lugar_nacimiento'] . '</td>
                                        <td class="text-left">' . $rows['familiar_genero'] . '</td>
                                        <td class="text-left">' . $rows['familiar_ocupacion'] . '</td>
                                        <td class="text-left">' . $rows['familiar_filiacion'] . '</td>';

               
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/estudioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="familiar_id_del" value="' . mainModel::encryption($rows['familiar_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        </td>';
                


                $tabla .= '</tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="9"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="9">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando estudio ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador familiar*/

    /** Controlador para eliminar estudio **/
    public function eliminar_estudio_controlador($id) {
        /* --- recibiendo id de la estudio --- */
        $id = mainModel::decryption($_POST['estudio_id_del']);
        $id = mainModel::limpiar_cadena($id);



        /* Comprobar que exista la estudio en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT estudio_id, estudio_nombre FROM estudio WHERE estudio_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El estudio que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_estudio = $check_nombre['estudio_nombre'];
        }

        /* Comprobar que la estudio no este relacionada a alguna OTRA TABLA... */
        $check_cargo = mainModel::ejecutar_consulta_simple("SELECT solicitud_estudio_id FROM solicitud_estudio WHERE estudio_id='$id' LIMIT 1");
         if ($check_cargo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar el siguiente estudio, porque esta relacionado a una solicitud.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar este estudio",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_estudio = estudioModelo::eliminar_estudio_modelo($id);

        if ($eliminar_estudio->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino el siguiente estudio: " . $nombre_estudio;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "estudio Eliminado",
                "Texto" => "El estudio ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente estudio: " . $nombre_estudio;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el estudio seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin Controlador eliminar estudio*/

     /** Controlador para eliminar familiar **/
     public function eliminar_familiar_controlador($id) {
        /* --- recibiendo id de la estudio --- */
        $id = mainModel::decryption($_POST['familiar_id_del']);
        $id = mainModel::limpiar_cadena($id);



        /* Comprobar que exista la estudio en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT familiar_id FROM familiar WHERE familiar_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El familiar que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } 

        $eliminar_estudio = estudioModelo::eliminar_familiar_modelo($id);

        if ($eliminar_estudio->rowCount() == 1) {
        
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Familiar Eliminado",
                "Texto" => "El estudio ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
       
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el estudio seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin Controlador eliminar familiar*/


    /** Controlador para obtener los datos de la estudio **/
    public function datos_estudio_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return estudioModelo::datos_estudio_modelo($tipo, $id);
    } /*Fin Controlador obtener datos*/

    /* Controlador para editar estudio */
    public function actualizar_estudio_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['estudio_id_up']);
        $id = mainModel::limpiar_cadena($id);

      

        //Comprobar la estudio mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM estudio WHERE estudio_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el estudio en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        /************************************* */
         //DATOS PERSONALES
         $nombre = mainModel::limpiar_cadena($_POST['nombres_apellidos_solicitante_up']);
         $tipo_documento = mainModel::limpiar_cadena($_POST['tipo_cedula_solicitante_up']);
         $cedula_solicitante = mainModel::limpiar_cadena($_POST['numero_cedula_solicitante_up']);
         $nacionalidad_solicitante = mainModel::limpiar_cadena($_POST['nacionalidad_solicitante_up']);
         $estado_civil = mainModel::limpiar_cadena($_POST['estado_civil_up']);
         $telefono_fax_celular = mainModel::limpiar_cadena($_POST['telefono_fax_celular_up']);
         $lugar_nacimiento_solicitante = mainModel::limpiar_cadena($_POST['lugar_nacimiento_solicitante_up']);
         $estado_nacimiento = mainModel::limpiar_cadena($_POST['estado_nacimiento_up']);
         $fecha_nacimiento = mainModel::limpiar_cadena($_POST['fecha_nacimiento_up']);
         $genero = mainModel::limpiar_cadena($_POST['genero_up']);
         $direccion_permanente = mainModel::limpiar_cadena($_POST['direccion_permanente_up']);
         $municipio = mainModel::limpiar_cadena($_POST['municipio_up']);
         $parroquia = mainModel::limpiar_cadena($_POST['parroquia_up']);
         $estado = mainModel::limpiar_cadena($_POST['estado_up']);
         //GRADO INSTRUCCION
         $grado_instruccion = mainModel::limpiar_cadena($_POST['grado_instruccion_up']);
         //SITUACION SOCIOECONOMICA
         $trabaja = mainModel::limpiar_cadena($_POST['trabaja_up']);
         $profesion = mainModel::limpiar_cadena($_POST['profesion_up']);
         $institucion = mainModel::limpiar_cadena($_POST['institucion_up']);
         $ocupacion = mainModel::limpiar_cadena($_POST['ocupacion_up']);
         $telefono_trabajo = mainModel::limpiar_cadena($_POST['telefono_trabajo_up']);
         $direccion_trabajo = mainModel::limpiar_cadena($_POST['direccion_trabajo_up']);
         $ingreso_familiar = mainModel::limpiar_cadena($_POST['ingreso_familiar_up']);
         $observaciones = mainModel::limpiar_cadena($_POST['observaciones_up']);
         //TIPO DE VIVIENDA Y TENENCIA
         $tipo_vivienda = mainModel::limpiar_cadena($_POST['tipo_vivienda_up']);
         $tenencia_vivienda = mainModel::limpiar_cadena($_POST['tenencia_vivienda_up']);
         //ESTUDIO SOCIAL
         $tipo_ayuda = mainModel::limpiar_cadena($_POST['tipo_ayuda_up']);
         $sintesis_caso = mainModel::limpiar_cadena($_POST['sintesis_caso_up']);
         $area_socioeconomica = mainModel::limpiar_cadena($_POST['area_socioeconomica_up']);
         $conclusion = mainModel::limpiar_cadena($_POST['conclusion_up']);
         //DOCUMENTOS ANEXOS
         $planilla_solicitud = mainModel::limpiar_cadena($_POST['planilla_solicitud_up']);
         $copia_cedula = mainModel::limpiar_cadena($_POST['copia_cedula_up']);
         $informe_medico = mainModel::limpiar_cadena($_POST['informe_medico_up']);
         $rif = mainModel::limpiar_cadena($_POST['rif_up']);
         $presupuesto = mainModel::limpiar_cadena($_POST['presupuesto_up']);
         $orden_medica = mainModel::limpiar_cadena($_POST['orden_medica_up']);
         $carta = mainModel::limpiar_cadena($_POST['carta_up']);
         $acta_nacimiento = mainModel::limpiar_cadena($_POST['acta_nacimiento_up']);
         //FIRMAS INFORME SOCIAL
         $elaborado_por = mainModel::limpiar_cadena($_POST['elaborado_por_up']);
         $nombre_apellido_elaborado = mainModel::limpiar_cadena($_POST['nombre_apellido_elaborado_up']);
         $cedula_elaborado = mainModel::limpiar_cadena($_POST['cedula_elaborado_up']);
         $supervisado_por = mainModel::limpiar_cadena($_POST['supervisado_por_up']);
         $nombre_apellido_supervisado = mainModel::limpiar_cadena($_POST['nombre_apellido_supervisado_up']);
         $cedula_supervisado = mainModel::limpiar_cadena($_POST['cedula_supervisado_up']);
         $aprobado_por = mainModel::limpiar_cadena($_POST['aprobado_por_up']);
         $nombre_apellido_aprobado = mainModel::limpiar_cadena($_POST['nombre_apellido_aprobado_up']);
         $cedula_aprobado = mainModel::limpiar_cadena($_POST['cedula_aprobado_up']);
 
 
 
        
 
         /* --------  Comprobar los campos vacios  -------- */
         if ($nombre == ""  || $tipo_documento == "" || $cedula_solicitante == "")   {
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
                 "Texto" => "El Nombre y el apellido del ciudadano solicitante no coincide con el formato solicitado",
                 "Tipo" => "error"
             ];
             echo json_encode($alerta);
             exit();
         }
         if (mainModel::verificar_datos("[0-9-]{5,30}", $cedula_solicitante)) {
             $alerta = [
                 "Alerta" => "simple",
                 "Titulo" => "Ha ocurrido un error inesperado",
                 "Texto" => "El número del cédula del solicitante no coincide con el formato solicitado",
                 "Tipo" => "error"
             ];
             echo json_encode($alerta);
             exit();
         }
         if ($tipo_documento != "V-" && $tipo_documento != "E-") {
             $alerta = [
                 "Alerta" => "simple",
                 "Titulo" => "Ha ocurrido un error inesperado",
                 "Texto" => "El tipo de documento del solicitante no coincide con el formato solicitado",
                 "Tipo" => "error"
             ];
             echo json_encode($alerta);
             exit();
         }
 
         //VALORES QUE PÚEDEN VENIR VACIOS DATOS PERSONALES
         if($nacionalidad_solicitante!=""){
             if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $nacionalidad_solicitante)) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "La nacionalidad del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
         }
         if($estado_civil!=""){
             if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,20}", $estado_civil)) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El estado civil del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
         }
         if($telefono_fax_celular!=""){
             if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,40}", $telefono_fax_celular)) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El número de telefono del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
         }
         if($lugar_nacimiento_solicitante!=""){
             if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $lugar_nacimiento_solicitante)) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El lugar de nacimiento del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
         }
         if($estado_nacimiento!=""){
             if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $estado_nacimiento)) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El Estado donde nacio del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
         }
         if($fecha_nacimiento!=""){
             if (mainModel::verificar_fechas($fecha_nacimiento)) {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "La fecha de nacimiento del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
         }
         if ($genero!="FEMENINO" && $genero!="MASCULINO") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El genero del ciudadano solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if($direccion_permanente!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $direccion_permanente)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La direccion permanente del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($municipio!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,30}", $municipio)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El municipio del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($parroquia!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $parroquia)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La parroquia del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($estado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $estado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El Estado del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             //GRADO DE INSTRUCCION 
             if ($grado_instruccion != "NO POSEE" && $grado_instruccion != "PRIMARIA" && $grado_instruccion != "SECUNDARIA" && $grado_instruccion != "TECNICA" && $grado_instruccion != "UNIVERSITARIA") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El grado de instrucción del solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
 
             //ESTUDIO SOCIOECONOMICO
             if ($trabaja != "NO" && $trabaja != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor agregado para el tipo trabaja no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
 
             if($profesion!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $profesion)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La profesión del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($institucion!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,120}", $institucion)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La institución o empresa donde trabaja el ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($ocupacion!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,120}", $ocupacion)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La ocupación del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($telefono_trabajo!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,40}", $telefono_trabajo)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El Número de teléfono del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($direccion_trabajo!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $direccion_trabajo)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La dirección de trabajo del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($ingreso_familiar!=""){
                 if (mainModel::verificar_datos("[0-9.]{1,25}", $ingreso_familiar)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El ingreso familiar del ciudadano solicitante no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($observaciones!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,200}", $observaciones)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El campo observaciones no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
 
             //TIPO DE VIVIENDA Y TENENCIA DE VIVIENDA 
             if ($tipo_vivienda != "APARTAMENTO" && $tipo_vivienda != "QUINTA" && $tipo_vivienda != "RANCHO" && $tipo_vivienda != "CASA" && $tipo_vivienda != "OTRO") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El tipo de vivienda del solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($tenencia_vivienda != "PROPIA" && $tenencia_vivienda != "ALQUILADA" && $tenencia_vivienda != "ALOJADA" && $tenencia_vivienda != "COMPARTIDA" && $tenencia_vivienda != "OTRO") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor para la tenencia de vivienda del solicitante no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             //ESTUDIO SOCIAL  
             if($tipo_ayuda!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $tipo_ayuda)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El tipo de ayuda no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }  
             if($sintesis_caso!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $sintesis_caso)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La sintesis del caso no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($area_socioeconomica!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $area_socioeconomica)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El área socioeconómica no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($conclusion!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,1200}", $conclusion)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "La conclusión no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
 
             //DOCUMENTOS ANEXOS
             if ($planilla_solicitud != "NO" && $planilla_solicitud != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor para la planilla de solicitud no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($copia_cedula != "NO" && $copia_cedula != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor para la copia de cedula de identidad no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($informe_medico != "NO" && $informe_medico != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor documento informe medico no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($rif != "NO" && $rif != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor del rif no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($presupuesto != "NO" && $presupuesto != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor para el presupuesto no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($orden_medica != "NO" && $orden_medica != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor de la orden medica no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($carta != "NO" && $carta != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor de la carta para el gobernador no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             if ($acta_nacimiento != "NO" && $acta_nacimiento != "SI") {
                 $alerta = [
                     "Alerta" => "simple",
                     "Titulo" => "Ha ocurrido un error inesperado",
                     "Texto" => "El valor del acta de nacimiento no coincide con el formato solicitado",
                     "Tipo" => "error"
                 ];
                 echo json_encode($alerta);
                 exit();
             }
             //FIRMAS DEL ESTUDIO SOCIAL
             if($elaborado_por!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $elaborado_por)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de elaborado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($nombre_apellido_elaborado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $nombre_apellido_elaborado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de nombre y apellido de elaborado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($cedula_elaborado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $cedula_elaborado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de la cedula de elaborado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($supervisado_por!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $supervisado_por)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de supervisado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($nombre_apellido_supervisado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $nombre_apellido_supervisado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de nombre y apellido de supervisado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($cedula_supervisado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $cedula_supervisado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de la cedula de supervisado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($aprobado_por!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $aprobado_por)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de aprobado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($nombre_apellido_aprobado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $nombre_apellido_aprobado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de nombre y apellido de aprobacion por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
             if($cedula_aprobado!=""){
                 if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,60}", $cedula_aprobado)) {
                     $alerta = [
                         "Alerta" => "simple",
                         "Titulo" => "Ha ocurrido un error inesperado",
                         "Texto" => "El valor de la cedula de aprobado por no coincide con el formato solicitado",
                         "Tipo" => "error"
                     ];
                     echo json_encode($alerta);
                     exit();
                 }
             }
 

            
 
         /* ------  Comprobando que el numero de cedula ya no este previamente registrado ------ */
         //Comprobar que el nombre a ingresar no este ya registrador en el sistema
        if ($cedula_solicitante != $campos['estudio_cedula_solicitante']) {
            $check_cedula = mainModel::ejecutar_consulta_simple("SELECT estudio_id FROM estudio WHERE estudio_cedula_solicitante='$cedula_solicitante'");
            if ($check_cedula->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Número de Cédula ya se encuentra registrado en el sistema, a otro solicitante.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

       
 
         /* ---- crear el array con los datos para el registro en la base de datos ----- */
         $datos_estudio_up = [
             //Datos Personales
             "NombreSolicitante" => $nombre,
             "TipoDocumento" => $tipo_documento,
             "CedulaSolicitante" => $cedula_solicitante,
             "Nacionalidad_solicitante" => $nacionalidad_solicitante,
             "Estado_civil" => $estado_civil,
             "Telefono_fax_celular" => $telefono_fax_celular,
             "Lugar_nacimiento_solicitante" => $lugar_nacimiento_solicitante,
             "Estado_nacimiento" => $estado_nacimiento,
             "Fecha_nacimiento" => $fecha_nacimiento,
             "Genero" => $genero,
             "Direccion_permanente" => $direccion_permanente,
             "Municipio" => $municipio,
             "Parroquia" => $parroquia,
             "Estado" => $estado,
 
             //GRADO INSTRUCCION 
             "Grado_instruccion" => $grado_instruccion,
 
             // SITUACION SOCIOECONOMICA
             "Trabaja" => $trabaja,
             "Profesion" => $profesion,
             "Institucion" => $institucion,
             "Ocupacion" => $ocupacion,
             "Telefono_trabajo" => $telefono_trabajo,
             "Direccion_trabajo" => $direccion_trabajo,
             "Ingreso_familiar" => $ingreso_familiar,
             "Observaciones" => $observaciones,
 
             //TIPO DE VIVIENDA Y TENENCIA
             "Tipo_vivienda" => $tipo_vivienda,
             "Tenencia_vivienda" => $tenencia_vivienda,
 
             //ESTUDIO SOCIAL
             "Tipo_ayuda" => $tipo_ayuda,
             "Sintesis_caso" => $sintesis_caso,
             "Area_socioeconomica" => $area_socioeconomica,
             "Conclusion" => $conclusion,
 
             //DOCUMENTOS ANEXOS
             "Planilla_solicitud" => $planilla_solicitud,
             "Copia_cedula" => $copia_cedula,
             "Informe_medico" => $informe_medico,
             "Rif" => $rif,
             "Presupuesto" => $presupuesto,
             "Orden_medica" => $orden_medica,
             "Carta" => $carta,
             "Acta_nacimiento" => $acta_nacimiento,
 
             //FIRMAS DEL ESTUDIO SOCIAL
             "Elaborado_por" => $elaborado_por,
             "Nombre_apellido_elaborado" => $nombre_apellido_elaborado,
             "Cedula_elaborado" => $cedula_elaborado,
             "Supervisado_por" => $supervisado_por,
             "Nombre_apellido_supervisado" => $nombre_apellido_supervisado,
             "Cedula_supervisado" => $cedula_supervisado,
             "Aprobado_por" => $aprobado_por,
             "Nombre_apellido_aprobado" => $nombre_apellido_aprobado,
             "Cedula_aprobado" => $cedula_aprobado,
             "ID" => $id
 
         ];

      

        /*********************************************** */

        if(estudioModelo::actualizar_estudio_modelo($datos_estudio_up)){

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos del estudio fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        }else{
        
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos del estudio no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin Controlador editar estudio */

}