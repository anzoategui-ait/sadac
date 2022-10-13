<?php

if ($peticionAjax) {
    require_once "../modelos/solicitudModelo.php";
} else {
    require_once "./modelos/solicitudModelo.php";
}

class solicitudControlador extends solicitudModelo {
    /* ---- Controlador para agregar una evaluacion al sistema ----- */

    public function agregar_evaluacion_solicitud_controlador() {
        $solicitud_id = mainModel::decryption($_POST['evaluar_solicitud_id_up']);
        $solicitud_id = mainModel::limpiar_cadena($solicitud_id);
        $tiempo_respuesta = mainModel::limpiar_cadena($_POST['tiempo_respuesta_reg']);
        $tipo_solucion = mainModel::limpiar_cadena($_POST['tipo_solucion_reg']);
        $descripcion = mainModel::limpiar_cadena($_POST['evaluar_solicitud_descripcion_reg']);

        //Comprobar que no haya espacios en blancos
        /* --------  Comprobar los campos vacios  -------- */
        if ($tiempo_respuesta == "" || $tipo_solucion == "" || $descripcion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Verificar que cada variable que sea del tipo correcto */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Descripcion no coincide con el formato solicitado, posiblemente esta colocando caracteres no permitidos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($tiempo_respuesta < 1 || $tiempo_respuesta > 4) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El valor para el tiempo de repuesta no coincide con el formato solicitado, posiblemente esta colocando caracteres no permitidos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($tipo_solucion < 1 || $tipo_solucion > 4) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El valor para el tipo de solucion, no coincide con el formato solicitado, posiblemente esta colocando caracteres no permitidos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $usuario = 0;
        //Comprobar que la solicitud este registrada en el sistema
        $check_solicitud = mainModel::ejecutar_consulta_simple("SELECT solicitud_id, usuario_id FROM solicitud WHERE solicitud_id='$solicitud_id'");
        if ($check_solicitud->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La solicitud que intenta evaluar no se encuentra registrada en el sistema, intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $check_solicitud = $check_solicitud->fetch();
            $usuario = $check_solicitud['usuario_id'];
        }

        //Obtener el año actual
        $fecha_actual = mainModel::solo_fecha("Y-m-d");
        $nueva_fecha_fin = explode("-",$fecha_actual);
        $fecha_anual = $nueva_fecha_fin[0];


        //Crear array de datos para registrarlo a la tablaa feedback
        $datos_evaluar_reg = [
            "Solicitud" => $solicitud_id,
            "Usuario" => $usuario,
            "Descripcion" => $descripcion,
            "Tiempo" => $tiempo_respuesta,
            "Tipo" => $tipo_solucion,
            "Fecha" => $fecha_anual
        ];

        /*         * -- Agregar URL donde se va a redireccionar una vez agregada la evaluacion -- */
        $url = SERVERURL . "solicitud-list/";
        /* -- Agregar el registro -- */
        $agregar_evaluacion = solicitudModelo::agregar_evaluacion_modelo($datos_evaluar_reg);
        if ($agregar_evaluacion->rowCount() == 1) { // rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            $datos_actualizar_estado = [
                "Estado" => "finalizado",
                "ID" => $solicitud_id
            ];
            $actualizar_estado = solicitudModelo::actualizar_solicitud_estado_modelo($datos_actualizar_estado);
            
            //Calcular el porcentaje

            $alerta = [
                "Alerta" => "linkredireccionar",
                "Titulo" => "Evaluacion Registrada",
                "Texto" => "Los datos de la evaluacion han sido registrados con exito",
                "Tipo" => "success",
                "Footer" => "exito",
                "URL" => $url
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar dicha evaluacion, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /** verificar solicitud y actividades relacionadas  * */
    public function validar_relacion_actividad_solicitud($solicitud_id, $actividad_id) {
        $rs = mainModel::ejecutar_consulta_simple("SELECT * FROM solicitud_actividad WHERE solicitud_id='$solicitud_id' AND actividad_id='$actividad_id'");

        return $rs;
    }

    /** Controlador para que un ciudadano agregue una solicitud * */
    public function agregar_ciudadano_solicitud_controlador() {
        //Obtener las variables del Formulario
        $solicitud = mainModel::limpiar_cadena($_POST['usuario_solicitud_reg']);
        $nombre_apellido = mainModel::limpiar_cadena($_POST['usuario_nombre_apellido_reg']);
        $cedula = mainModel::limpiar_cadena($_POST['usuario_cedula_reg']);
        $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);
        $correo = mainModel::limpiar_cadena($_POST['usuario_correo_reg']);
        $municipio = mainModel::decryption($_POST['municipio_nombre_reg']);
        $municipio = mainModel::limpiar_cadena($municipio);
        $parroquia = mainModel::decryption($_POST['parroquia_nombre_reg']);
        $parroquia = mainModel::limpiar_cadena($parroquia);
        $sector = mainModel::limpiar_cadena($_POST['sector_nombre_reg']);

        //Agregar Fecha de Nacimiento y Genero
        $genero = mainModel::limpiar_cadena($_POST['usuario_genero_reg']);
        $fecha_nacimiento = mainModel::limpiar_cadena($_POST['usuario_fecha_nacimiento_reg']);



        $fecha_hora = mainModel::crear_fecha();
        $soliciud_estado = "sin procesar";
        $actividad_estado = "sin asignar";
        $fecha = mainModel::solo_fecha();

        $fecha_exp = explode("-", $fecha);
        $year = $fecha_exp[0];
        $mes = $fecha_exp[1];
        $dia = $fecha_exp[2];
        $dia = intval($dia) + 1;
        if ($dia < 10) {
            $dia = "0" . $dia;
        }
        $fecha_fin = $year . "-" . $mes . "-" . $dia;

        //Antes de Verificar los datos obtener el maximo de solicitudes diarias totales del sistema y comprobar que no haya llegado a ese numero
        $total_solicitudes_diarias = 0;
        $rs_total_solicitudes_diarias = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='total_solicitud_diaria'");
        if ($rs_total_solicitudes_diarias->rowCount() > 0) {
            $rs_total_solicitudes_diarias = $rs_total_solicitudes_diarias->fetch();
            $total_solicitudes_diarias = $rs_total_solicitudes_diarias['configuracion_valor'];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No esta definida el atributo total_solicitud_diaria en la tabla configuracion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        $total_solicitudes_bd = 0;

        $datos_sol_max = [
            "Inicio" => $fecha,
            "Fin" => $fecha_fin
        ];

        $rs_solicitudes_bd_diarias = solicitudModelo::datos_solicitud_ciudadano_modelo("solicitudes-maximas", $datos_sol_max);

        //$rs_solicitudes_bd_diarias = mainModel::ejecutar_consulta_simple("SELECT solicitud_id FROM solicitud WHERE solicitud_inicio >= '$fecha' AND solicitud_inicio <= '$fecha'");

        if ($rs_solicitudes_bd_diarias->rowCount() > 0) {
            $total_solicitudes_bd = $rs_solicitudes_bd_diarias->rowCount();
        } else {
            $total_solicitudes_bd = 0;
        }

        //Comprobar que el numero total d registros en la base de datos no sobrepase el numero permitido en la configuracion
        if ($total_solicitudes_bd >= $total_solicitudes_diarias) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Se ha alcanzado el maximo de solicitudes permitidas, gracias por su atencion, intente mañana nuevamente. Solo se atienden via online " . $total_solicitudes_diarias . " por dia. Estamos trabajando por usted.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        //VERIFICAR DATOS ENTRANTE
        /* --------  Comprobar los campos vacios  -------- */
        if ($genero == "" || $fecha_nacimiento == "" || $solicitud == "" || $nombre_apellido == "" || $cedula == "" || $telefono == "" || $correo == "" || $municipio == "" || $parroquia == "" || $sector == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{1,11}", $municipio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El municipio no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{1,11}", $parroquia)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La parroquia no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,50}", $sector)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "EL sector no coincide con el formato solicitado, posiblemente esta colocando caracteres no permitidos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,440}", $solicitud)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Solicitud no coincide con el formato solicitado, posiblemente esta colocando caracteres no permitidos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,150}", $nombre_apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9-vVeE]{6,20}", $cedula)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Cedula no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_fechas($fecha_nacimiento)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Fecha de Nacimiento no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($genero!="MASCULINO" && $genero!="FEMENINO") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Genero no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }




        //Validar que el municipio y la parroquia esten registrados en la base de datos
        /* ------  Comprobando que la municipio este registrada en la tabla ------ */
        $check_municipio = mainModel::ejecutar_consulta_simple("SELECT municipio_id FROM municipio WHERE municipio_id='$municipio'");
        if ($check_municipio->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El municipio que acaba de seleccionar no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* ------  Comprobando que la parroquia este registrada en la tabla ------ */
        $check_parroquia = mainModel::ejecutar_consulta_simple("SELECT parroquia_id FROM parroquia WHERE parroquia_id='$parroquia'");
        if ($check_parroquia->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La parroquia que acaba de seleccionar no se encuentra registrada en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /** Validar que la parroquia pertenezca al municipio * */
        $check_parroquia_municipio = mainModel::ejecutar_consulta_simple("SELECT parroquia_id FROM parroquia WHERE parroquia_id='$parroquia' AND municipio_id='$municipio'");
        if ($check_parroquia_municipio->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La parroquia que acaba de seleccionar no pertenece al MUNICIPIO seleccionado, corrija y vuelta a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $usuario_id = 0;
        //VERIFICAR CEDULA PARA HACER EL REGISTRO DEL USUARIO si la cedula no existe entonces registro el usuario
        $check_cedula = mainModel::ejecutar_consulta_simple("SELECT usuario_dni FROM usuario WHERE usuario_dni='$cedula'");
        if ($check_cedula->rowCount() <= 0) {
            //SOLO VALIDAR EN CASO QUE NUNCA SE HAYA REGISTRADO ESTE USUARIO, SI EL USUARIO YA ESTA REGISTRADO ENTONCES NO HACER VALIDACIONES
            if (mainModel::verificar_datos("[0-9()+-]{6,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Numero de Telefono no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            //VALIDAR  CORREO ELECTRONICO
            //filter_var se utiliza para verificar que sea un email valido
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$correo'");
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El Email ingresado ya se encuentra registrado en el sistema",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }



            //Hago el registro del usuario
            $clave = "Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=";
            $datos_usuario_reg = [
                "DNI" => $cedula,
                "Nombre" => $nombre_apellido,
                "Apellido" => "",
                "Telefono" => $telefono,
                "Direccion" => $sector,
                "Email" => $correo,
                "Usuario" => "ciudadano" . $cedula,
                "Clave" => $clave,
                "Estado" => "Deshabilitada",
                "Privilegio" => 3,
                "Imagen" => "default.jpg",
                "Tipo" => 4,
                "Genero" => $genero,
                "Fecha" => $fecha_nacimiento
            ];

            //Agregar el usuario
            $agregar_usuario = solicitudModelo::agregar_usuario_modelo($datos_usuario_reg);
            if ($agregar_usuario->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No hemos podido registrar su solicitud, ya que ha ocurrido un problema al registrar sus datos de usuario, intente mas tarde.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            //OBTENER EL ID DEL USUARIO REGISTRADO
            $obtener_usuario_id = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_dni='$cedula'");
            if ($obtener_usuario_id->rowCount() > 0) {
                $obtener_usuario_id = $obtener_usuario_id->fetch();
                $usuario_id = $obtener_usuario_id['usuario_id'];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No hemos podido obtener el ID de su usuario, intente nuevamnete dentro de unos minutos.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            //Registrar relacion usuario parroquia.
            $datos_usuario_parroquia_reg = [
                "Usuario" => $usuario_id,
                "Parroquia" => $parroquia
            ];

            /* -- Agregar el registro -- */
            $agregar_usuario_parroquia = solicitudModelo::agregar_usuario_parroquia_modelo($datos_usuario_parroquia_reg);
            if ($agregar_usuario_parroquia->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            } else {

                //Eliminar usuario registrado
                $eliminar_usuario = mainModel::ejecutar_consulta_simple("DELETE FROM usuario WHERE usuario_dni='$cedula'");

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No hemos podido registrar su solicitud, debido a un error al registrar la relacion parroquia usuario, intente nuevamente.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        } else {
            //OBTENER EL ID DEL USUARIO REGISTRADO
            $obtener_usuario_id = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_dni='$cedula'");
            if ($obtener_usuario_id->rowCount() > 0) {
                $obtener_usuario_id = $obtener_usuario_id->fetch();
                $usuario_id = $obtener_usuario_id['usuario_id'];
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No hemos podido obtener el ID de su usuario, intente nuevamnete dentro de unos minutos.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        //
        //COMPROBAR QUE EL CIUDADANO SOLO PUEDE REALIZAR TRES PETICIONES DIARIAS
        $config_maximo_diario_usuario = 0;
        $total_solicitudes_config = 0;
        $config_maximo_diario_usuario = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='total_solicitud_diaria_ciudadano'");
        if ($config_maximo_diario_usuario->rowCount() > 0) {
            $config_maximo_diario_usuario = $config_maximo_diario_usuario->fetch();
            $total_solicitudes_config = $config_maximo_diario_usuario['configuracion_valor'];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No esta definida el atributo total_solicitud_diaria_ciudadano en la tabla configuracion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $total_solicitudes_bd_ciudadano = 0;
        $datos_sol = [
            "Inicio" => $fecha,
            "Fin" => $fecha_fin,
            "Usuario" => $usuario_id
        ];
        $rs_solicitudes_bd_diarias_ciudadano = solicitudModelo::datos_solicitud_ciudadano_modelo("solicitudes-ciudadano-maximas", $datos_sol);
        // mainModel::ejecutar_consulta_simple("SELECT solicitud_id FROM solicitud WHERE solicitud_inicio >= '$fecha' AND solicitud_inicio <= '$fecha' AND usuario_id='$usuario_id'");

        if ($rs_solicitudes_bd_diarias_ciudadano->rowCount() > 0) {
            $total_solicitudes_bd_ciudadano = $rs_solicitudes_bd_diarias_ciudadano->rowCount();
        } else {
            $total_solicitudes_bd_ciudadano = 0;
        }



        //Comprobar que el numero total d registros en la base de datos no sobrepase el numero permitido en la configuracion
        if ($total_solicitudes_bd_ciudadano >= $total_solicitudes_config) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Se ha alcanzado el maximo de solicitudes permitidas diarias, gracias por su atencion, intente mañana nuevamente. Solo se atienden via online " . $total_solicitudes_config . " por cada ciudadano, por dia. Estamos trabajando por usted.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Area para agregar la solicitud

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_solicitud_reg = [
            "Usuario" => $usuario_id,
            "Inicio" => $fecha_hora,
            "Estado" => $soliciud_estado,
            "Descripcion" => $solicitud
        ];

        /* colocar enlace */
        /* -- Agregar el registro -- */
        $agregar_solicitud = solicitudModelo::agregar_solicitud_modelo($datos_solicitud_reg);

        $ultimo_id_solicitud = mainModel::ejecutar_consulta_simple("select LAST_INSERT_ID(solicitud_id) as last from solicitud order by solicitud_id desc limit 0,1");
        $rs_ultimo_id_solicitud = $ultimo_id_solicitud->fetch();
        $solicitud_id = $rs_ultimo_id_solicitud['last'];
        $solicitud_encryp = mainModel::encryption($solicitud_id);
        $enlace = '<a href="' . SERVERURL . 'reporte/print-solicitud-view.php?solicitud_id=' . $solicitud_encryp . '" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; imprimir</a>';

        if ($agregar_solicitud->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

            /*
              $alerta = [
              "Alerta" => "limpiar",
              "Titulo" => "Registro Exitoso",
              "Texto" => "Su solicitud ha sido enviada, espere que prontamente nos comunicaremos con usted, via telefonica o a traves del correo electronico registrado.",
              "Tipo" => "success"
              ];

             */
            $alerta = [
                "Alerta" => "recargarlink",
                "Titulo" => "Solicitud Registrada",
                "Texto" => "Los datos de la nueva solicitud han sido registrados satisfactoriamente.",
                "Footer" => $enlace,
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido enviar su solicitud, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /** Fin controlador* */

    /** Controlador para agregar una solicitud * */
    public function agregar_solicitud_controlador() {

        $descripcion = mainModel::limpiar_cadena($_POST['solicitud_descripcion_reg']);
        $usuario = mainModel::decryption($_POST['solicitud_usuario_reg']);
        $usuario = mainModel::limpiar_cadena($usuario);
        

        $estado = "sin procesar";
        $actividad_estado = "sin asginar";
        //Obtener la fecha
        $fecha = mainModel::limpiar_cadena($_POST['fecha_reg']);
        $hora_solicitud = mainModel::crear_fecha();
        $rs_hora = explode (" ", $hora_solicitud);
        $hora = $rs_hora[1];

        $fecha_inicio = $fecha . ' ' . $hora;


        $fecha_fin = "0000-00-00 00:00:00";

        /* --------  Comprobar los campos vacios  -------- */
        if ($descripcion == "" || $usuario == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El campo descripcion no puede estar vacio",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que el array de checkbox no este vacio */
        if (empty($_POST['actividad'])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Debe seleccionar almenos una actividad, para poder registrar una solicitud",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,500}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La descripcion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{1,11}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando que el usuario este registrado en el sistema ------ */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$usuario'");
        if ($check_usuario->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario que intenta ingresar al sistema, no se encuentra registrado, presione  F5 he intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* Comprobar que todas las actividades pertenezcan a la tabla actividad si hay una que no pertenece, entonces no realizar la solicitud */

        foreach ($_POST['actividad'] as $actividad) {
            $rs_actividad = mainModel::decryption($actividad);
            $rs_actividad = mainModel::limpiar_cadena($rs_actividad);
            /* ------  Comprobando que el nombre de la solicitud sea unica ------ */
            $check_nombre = mainModel::ejecutar_consulta_simple("SELECT actividad_id FROM actividad WHERE actividad_id='$rs_actividad'");
            if ($check_nombre->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La actividad que intenta ingresar al sistema, no se encuentra registrada, presione  F5 he intente nuevamente.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_solicitud_reg = [
            "Usuario" => $usuario,
            "Inicio" => $fecha_inicio,
            "Estado" => $estado,
            "Descripcion" => $descripcion
        ];

        /* -- Agregar el registro -- */
        $agregar_solicitud = solicitudModelo::agregar_solicitud_modelo($datos_solicitud_reg);
        if ($agregar_solicitud->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            //buscar el ultimo id registrado en la solicitud
            //Agregar todas las actividades a la tabla solicitud - actividad
            //obtener el ultimo id. registrado en la tabla factura
            $ultimo_id_solicitud = mainModel::ejecutar_consulta_simple("select LAST_INSERT_ID(solicitud_id) as last from solicitud order by solicitud_id desc limit 0,1");

            //sacar en caso de que haya un problema al obtener el ultimo id insertado
            if ($ultimo_id_solicitud->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No se pudo obtener el ultimo id_solicitud, para asi poder relacionar las actividades a dicha solicitud.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $rs_ultimo_id_solicitud = $ultimo_id_solicitud->fetch();
            $solicitud_id = $rs_ultimo_id_solicitud['last'];
            //Fin de buscar el ultimo id de la solicitud
            //Crear enlace colocando el id de la solicitud la cual se imprimira
            $solicitud_encryp = mainModel::encryption($solicitud_id);
            $enlace = '<a href="' . SERVERURL . 'reporte/print-solicitud-view.php?solicitud_id=' . $solicitud_encryp . '" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; imprimir</a>';

            //Inicio ciclo agregar actividades a la tabla solicitud - actividad
            foreach ($_POST['actividad'] as $actividad) {
                $rs_actividad = mainModel::decryption($actividad);
                $rs_actividad = mainModel::limpiar_cadena($rs_actividad);
                /* --- Agregar la relacion solicitud actividad --- */
                $datos_solicitud_activo_reg = [
                    "Solicitud" => $solicitud_id,
                    "Actividad" => $rs_actividad,
                    "Estado" => $actividad_estado,
                    "Fin" => $fecha_fin
                ];

                /* -- Agregar el registro -- */
                $agregar_solicitud_actividad = solicitudModelo::agregar_solicitud_actividad_modelo($datos_solicitud_activo_reg);
                if ($agregar_solicitud_actividad->rowCount() == 1) {
                    //Positivo
                } else {
                    //Borrar cualquier registro que tenga que ver con el id solicitud
                    //Primero de la tabla solicitudes
                    $delete_solicitud = mainModel::ejecutar_consulta_simple("DELETE FROM solicitud WHERE solicitud_id='$solicitud_id'");
                    $delete_solicitud_actividad = mainModel::ejecutar_consulta_simple("DELETE FROM solicitud_actividad WHERE solicitud_id='$solicitud_id'");

                    //Error, si hay error borrar la solicitud y borrar todas las relaciones, que tengan que ver con dicha solicitud
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "Error al tratar de registrar dicha solicitud.",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }
            //Fin del Ciclo agregar solicitud actividad
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Creacion de nueva solicitud: " . $descripcion;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargarlink",
                "Titulo" => "Solicitud Registrada",
                "Texto" => "Los datos de la nueva solicitud han sido registrados satisfactoriamente.",
                "Footer" => $enlace,
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error. No se pudo registrar la siguiente solicitud:" . $descripcion;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para esta nueva solicitud, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador */

    /** Controlador paginar solicituds * */
    public function paginador_solicitud_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, solicitud_actividad.solicitud_fin, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud_actividad.solicitud_estado LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR actividad.actividad_nombre LIKE '%$busqueda%' OR usuario.usuario_usuario LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, solicitud_actividad.solicitud_fin, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE ((solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud_actividad.solicitud_estado LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR actividad.actividad_nombre LIKE '%$busqueda%' OR usuario.usuario_usuario LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%') AND (solicitud.usuario_id='$usuario_actual')) ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }

            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Hizo la siguiente busqueda: " . $busqueda . " en el listado de solicitud";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        } else {
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, solicitud_actividad.solicitud_fin, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, solicitud_actividad.solicitud_fin, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.usuario_id='$usuario_actual' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Visualizo el listado de solicitud";
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
					<th>#</th><th>CONTROL</th>
					<th>DESCRIPCION</th><th>ACTIVIDAD</th><th>FECHA INICIO</th><th>ESTADO</th><th>FECHA FIN</th><th>VER</th>';

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
					<td>' . $contador . '</td> <td class="text-left">' . $rows['solicitud_id'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . ' (' . $rows['usuario_usuario'] . ') ' . $rows['solicitud_descripcion'] . '</td>
                                        <td class="text-left">' . $rows['actividad_nombre'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_inicio'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_estado'] . '</td> '
                        . '<td class="text-left">' . $rows['solicitud_fin'] . '</td>';

                $tabla .= '<td>
                                        <form class="form-neon" action="' . SERVERURL . 'reporte/comprobantesolicitud.php" method="POST" data-form="save" autocomplete="off">
                                           <input type="hidden" name="solicitud_id_comprobante" value="' . mainModel::encryption($rows['solicitud_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </form>
                                        </td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'solicitud-update/' . mainModel::encryption($rows['solicitud_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/solicitudAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="solicitud_id_del" value="' . mainModel::encryption($rows['solicitud_id']) . '">
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
                $tabla .= '<tr class="text-center"><td colspan="8"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="8">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando solicitud ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin Controlador paginador solicitud */

    /** Controlador paginar solicituds * */
    public function paginador_solicitud_ciudadano_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2 || $_SESSION['tipo_tor'] == 3) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud.solicitud_estado LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE ((solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud.solicitud_estado LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR usuario.usuario_usuario LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%') AND (solicitud.usuario_id='$usuario_actual')) ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }

            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Hizo la siguiente busqueda: " . $busqueda . " en el listado de solicitud";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        } else {
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2 || $_SESSION['tipo_tor'] == 3) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.usuario_id='$usuario_actual' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Visualizo el listado de solicitud";
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
					<th>#</th><th>CONTROL</th>
					<th>CIUDADANO</th><th>SOLICITUD</th><th>FECHA INICIO</th><th>ESTADO</th><th>VER</th>';

        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '<th>PROCESAR</th>';
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
                $comprobar_estado = $rows['solicitud_estado'];

                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td> <td class="text-left">' . $rows['solicitud_id'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_descripcion'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_inicio'] . '</td>';

                if ($comprobar_estado == "evaluar") {
                    $tabla .= '<td class="text-left"><a href="' . SERVERURL . 'evaluar-solicitud/' . mainModel::encryption($rows['solicitud_id']) . '/" class="btn btn-3d btn-success">Evaluar &nbsp;<i class="fa fa-check"></i></a>';
                } else {
                    $tabla .= '<td class="text-left">' . $rows['solicitud_estado'];
                }

                $tabla .= '</td> ';

                $tabla .= '<td>
                                        <form class="form-neon" action="' . SERVERURL . 'reporte/comprobantesolicitudciudadano.php" method="POST" data-form="save" autocomplete="off">
                                           <input type="hidden" name="solicitud_id_comprobante" value="' . mainModel::encryption($rows['solicitud_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </form>
                                        </td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'solicitud-update/' . mainModel::encryption($rows['solicitud_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-check"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/solicitudAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="solicitud_id_del" value="' . mainModel::encryption($rows['solicitud_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-danger">
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
                $tabla .= '<tr class="text-center"><td colspan="9"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="9">No hay solicitudes nuevas en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando solicitud ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin Controlador paginador solicitud */
    
    /** Controlador paginar solicituds * */
    public function paginador_solicitud_ciudadano_home_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2 || $_SESSION['tipo_tor'] == 3) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud.solicitud_estado LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE ((solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud.solicitud_estado LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR usuario.usuario_usuario LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%') AND (solicitud.usuario_id='$usuario_actual')) ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }

            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Hizo la siguiente busqueda: " . $busqueda . " en el listado de solicitud";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        } else {
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2 || $_SESSION['tipo_tor'] == 3) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE solicitud.usuario_id='$usuario_actual' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Visualizo el listado de solicitud";
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
					<th>#</th><th>CONTROL</th>
					<th>CIUDADANO</th><th>SOLICITUD</th><th>FECHA INICIO</th><th>ESTADO</th><th>VER</th>';

        $tabla .= '</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $comprobar_estado = $rows['solicitud_estado'];

                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td> <td class="text-left">' . $rows['solicitud_id'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_descripcion'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_inicio'] . '</td>';

                    $tabla .= '<td class="text-left">' . $rows['solicitud_estado'];
                
                $tabla .= '</td> ';

                $tabla .= '<td>
                                        <form class="form-neon" action="' . SERVERURL . 'reporte/comprobantesolicitudciudadano.php" method="POST" data-form="save" autocomplete="off">
                                           <input type="hidden" name="solicitud_id_comprobante" value="' . mainModel::encryption($rows['solicitud_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-print"></i>
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
                $tabla .= '<tr class="text-center"><td colspan="9">No hay solicitudes nuevas en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando solicitud ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin Controlador paginador solicitud */

    /* Paginador Mostrar consultas de las solicitudes realizadas sin asignar y procesando */

    public function paginador_consulta_ciudadano_controlador($pagina, $registros, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);

        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido FROM solicitud INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE usuario.usuario_dni LIKE '$busqueda' ORDER BY solicitud.solicitud_inicio ASC LIMIT $inicio,$registros";
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
					<th>#</th><th>CONTROL</th>
					<th>CIUDADANO</th><th>SOLICITUD</th><th>FECHA INICIO</th><th>ESTADO</th><th>VER</th>';

        $tabla .= '</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td> <td class="text-left">' . $rows['solicitud_id'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_descripcion'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_inicio'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_estado'] . '</td> ';

                $tabla .= '<td>
                                        <form class="form-neon" action="' . SERVERURL . 'reporte/comprobantesolicitudciudadano.php" method="POST" data-form="save" autocomplete="off">
                                           <input type="hidden" name="solicitud_id_comprobante" value="' . mainModel::encryption($rows['solicitud_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </form>
                                        </td>';

                $tabla .= '</tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="8"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="8">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando solicitud ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin del Controlador */

    /** Controlador para eliminar solicitud * */
    public function eliminar_solicitud_controlador($id) {
        /* --- recibiendo id de la solicitud --- */
        $id = mainModel::decryption($_POST['solicitud_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la solicitud en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT solicitud_id, solicitud_descripcion FROM solicitud WHERE solicitud_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La solicitud que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $check_nombre = $check_nombre->fetch();
            $nombre_solicitud = $check_nombre['solicitud_descripcion'];
        }

        /* Comprobar que la solicitud no este relacionada a alguna actividad... */
        /* si la solicitud ya fue asignada no se puede eliminar */
        $check_solicitud = mainModel::ejecutar_consulta_simple("SELECT asignacion_id FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN asignacion ON asignacion.solicitud_actividad = solicitud_actividad.sol_act_id WHERE solicitud.solicitud_id='$id'");
        if ($check_solicitud->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La solicitud no se puede eliminar, porque ya ha sido asignada a un analista.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar este solicitud",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_solicitud = solicitudModelo::eliminar_solicitud_modelo($id);

        if ($eliminar_solicitud->rowCount() == 1) {

            $eliminar_solicitud_actividad = solicitudModelo::eliminar_solicitud_actividad_modelo($id);

            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Elimino el siguiente solicitud: " . $nombre_solicitud;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Solicitud Eliminada",
                "Texto" => "La solicitud ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error al tratar de eliminar el siguiente solicitud: " . $nombre_solicitud;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la solicitud seleccionada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar solicitud */
    
     /** Eliminar evaluacion **/
     public function eliminar_evaluacion_controlador($id) {
        /* --- recibiendo id de la solicitud --- */
        $id = mainModel::decryption($_POST['evaluacion_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la solicitud en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT feedback_id, feedback_descripcion FROM feedback WHERE feedback_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La evaluacion que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $check_nombre = $check_nombre->fetch();
            $nombre_solicitud = $check_nombre['feedback_descripcion'];
        }

        /* Comprobar que la solicitud no este relacionada a alguna actividad... */
     

        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar este evaluacion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_evaluacion = solicitudModelo::eliminar_evaluacion_modelo($id);

        if ($eliminar_evaluacion->rowCount() == 1) {

            
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Elimino el siguiente evaluacion: " . $nombre_solicitud;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Evaluacion Eliminada",
                "Texto" => "La evaluacion ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Error al tratar de eliminar el siguiente evaluacion: " . $nombre_solicitud;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la evaluacion seleccionada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /** Controlador para obtener los datos de la solicitud * */
    public function datos_solicitud_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return solicitudModelo::datos_solicitud_modelo($tipo, $id);
    }

    /* Fin Controlador obtener datos */


    /* Controlador para agregar un valor a la tabla grafica mensualidad */

    static public function mensualidad_solicitud_controlador($cantidad, $fecha) {
        //Obtener el mes actual
       // $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);

        $mes = $fecha[1];
        $year = $fecha[0];

        //Verificar si existe registro en la tabla grafica solicitudes para el año en curso
        //en caso contrario crear la tabla
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
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 2,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 3,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 4,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 5,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 6,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 7,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 8,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 9,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 10,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 11,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);

            $datos_grafica_reg = [
                "Year" => $year,
                "Mes" => 12,
                "Solicitadas" => 0,
                "Finalizadas" => 0
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_grafica_solicitud_modelo($datos_grafica_reg);
        }

        //Agregar la cantidad nueva a la tabla
        $datos_grafica_up = [
            "Cantidad" => $cantidad,
            "Year" => $year,
            "Mes" => $mes
        ];
        /* -- Agregar el registro -- */
        $agregar_grafica_up = solicitudModelo::actualizar_grafica_solicitadas_modelo($datos_grafica_up);

        return true;
    }

    /* Fin del Controlador */


    /* Controlador para agregar los datos del mapa */

    static public function agregar_datos_mapa_controlador($year, $municipio_id, $cont_actividades_agregadas) {
        $check_mapa = mainModel::ejecutar_consulta_simple("SELECT mapa_id FROM mapa WHERE mapa_year='$year' LIMIT 0,1");
        if ($check_mapa->rowCount() <= 0) {
            //Crear un nuevo registro con el año y todos los municipios
            /* --- Agregar Municipios */
            $datos_mapa_reg = [
                "MunicipioID" => 1,
                "Nombre" => "Anaco",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 2,
                "Nombre" => "Aragua",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 3,
                "Nombre" => "Sotillo",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 4,
                "Nombre" => "Bolivar",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 5,
                "Nombre" => "Bruzual",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 6,
                "Nombre" => "Cajigal",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 7,
                "Nombre" => "Carvajal",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 8,
                "Nombre" => "Urbaneja",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 9,
                "Nombre" => "Freites",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 10,
                "Nombre" => "Guanipa",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 11,
                "Nombre" => "Guanta",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 12,
                "Nombre" => "Independencia",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 13,
                "Nombre" => "Libertad",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 14,
                "Nombre" => "Mcgregor",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 15,
                "Nombre" => "Miranda",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 16,
                "Nombre" => "Monagas",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 17,
                "Nombre" => "Penalver",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 18,
                "Nombre" => "Piritu",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 19,
                "Nombre" => "Capistrano",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 20,
                "Nombre" => "Santa_Ana",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);

            $datos_mapa_reg = [
                "MunicipioID" => 21,
                "Nombre" => "Simon_Rodriguez",
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "Year" => $year
            ];
            /* -- Agregar el registro -- */
            $agregar_mapa = solicitudModelo::agregar_mapa_modelo($datos_mapa_reg);
        }

        $check_mapa = mainModel::ejecutar_consulta_simple("SELECT mapa_id, mapa_cantidad, municipio_id FROM mapa WHERE mapa_year='$year'");

        //Se van actualizar todos los valores en la tabla mapa con el nuevo total de cantidades
        if ($check_mapa->rowCount() > 0) {
            $check_mapa = $check_mapa->fetchAll();

            //Obtener el total de solicitudes en el año en curso 
            $fecha_inicio = $year . "-01-01";
            $fecha_fin = $year . "-12-31";
            $obtener_solicitudes = mainModel::ejecutar_consulta_simple("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
            $total_solicitudes = $obtener_solicitudes->rowCount();
            //Ciclo para actualizar todos los datos correspondientes a los 21 municipios para la grafica de la tabla
            foreach ($check_mapa as $rows) {
                $cantidad_solicitudes = $rows['mapa_cantidad'];
                $mapa_id = $rows['mapa_id'];
                $municipio = $rows['municipio_id'];

                //COnsulto que sea el municipio de la solicitud actual
                if ($municipio == $municipio_id) {
                    $cantidad_solicitudes = $cantidad_solicitudes + $cont_actividades_agregadas;

                    //Obtener el nuevo porcentaje
                    if ($total_solicitudes != 0) {
                        $porcentaje = ($cantidad_solicitudes * 100) / $total_solicitudes;
                        $porcentaje = round($porcentaje, 2);
                    } else {
                        $porcentaje = 0;
                    }
                    $datos_mapa_up = [
                        "Cantidad" => $cantidad_solicitudes,
                        //"Porcentaje" => $porcentaje,
                        "ID" => $mapa_id
                    ];

                    /* -- Agregar el registro -- */
                    $actualizar_mapa = solicitudModelo::actualizar_mapa_modelo($datos_mapa_up);
                } else {

                    //Obtener el nuevo porcentaje
                    if ($total_solicitudes != 0) {
                        $porcentaje = ($cantidad_solicitudes * 100) / $total_solicitudes;
                        $porcentaje = round($porcentaje, 2);
                    } else {
                        $porcentaje = 0;
                    }
                    $datos_mapa_up = [
                        "Cantidad" => $cantidad_solicitudes,
                       // "Porcentaje" => $porcentaje,
                        "ID" => $mapa_id
                    ];

                    /* -- Agregar el registro -- */
                    $actualizar_mapa = solicitudModelo::actualizar_mapa_modelo($datos_mapa_up);
                }
            }
        }

        //Realizar la actualizacion de los porcentajes obtenidos
        /** Obtener todos los datos de la tabla home indicador **/
        $total_home_municipio = 0;
        $rs_total_home_municipio = mainModel::ejecutar_consulta_simple("SELECT mapa_id, mapa_cantidad FROM mapa WHERE mapa_year='$year'");
        if($rs_total_home_municipio->rowCount()>0){
            $rs_total_home_municipio = $rs_total_home_municipio->fetchAll();
             foreach($rs_total_home_municipio as $fila){
                $total_home_municipio += $fila['mapa_cantidad'];
            }
         }

        $rs_munic = mainModel::ejecutar_consulta_simple("SELECT mapa_id, mapa_cantidad FROM mapa WHERE mapa_year='$year'");
        if($rs_munic->rowCount()>0){
            $rs_munic = $rs_munic->fetchAll();

            foreach($rs_munic as $row){
                //obtener el porcentaje
                $porcentaje = ($row['mapa_cantidad'] * 100) / $total_home_municipio;
                $porcentaje = round($porcentaje, 2);
                //Crear el dato a mandar al modelo
                $act_modelo_porcentanje = [
                    "Indicador"=>$row['mapa_id'],
                    "Porcentaje"=> $porcentaje
                ];

                $rs_cambio = solicitudModelo::actualizar_mapa_porcentaje_modelo($act_modelo_porcentanje);

            }
        }


        //Fin actualizacion de los porcentajes
        return true;
    }

    /* Fin del Controlador */


    /* Controlador para actualizar la tabla home_actividades, esto permite que el ingreso al home sea mas rapido 
      Ademas de ordenar desde la actividad mayor hasta la menor */

    static public function actualizar_home_actividad_controlador($actividad_id, $fecha) {
        //Obtener año actual
       // $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);

        $year = $fecha[0];

        //Verificar si exite algun registro que contenga el año actual del registro de acividades
        //En caso contrario crear dichos registros con todas las actividades, que esten registradas en BD
        $check_home_actividad = mainModel::ejecutar_consulta_simple("SELECT home_actividad_id FROM home_actividad WHERE home_actividad_year ='$year'");
        if ($check_home_actividad->rowCount() <= 0) {
            //Buscaremos todas las actividades para crearlas en la tabla home_actividad
            $actividades = mainModel::ejecutar_consulta_simple("SELECT actividad_id, actividad_nombre FROM actividad");
            if ($actividades->rowCount() > 0) {
                //Realizar el registro en el foreach de las actividades en la tabla home actividad
                $actividades = $actividades->fetchAll();

                foreach ($actividades as $rows) {
                    //Agregar el registro en la tabla home_actividad
                    $datos_actividad_home_reg = [
                        "Year" => $year,
                        "Cantidad" => 0,
                        "Porcentaje" => 0,
                        "ActividadID" => $rows['actividad_id'],
                        "Nombre" => $rows['actividad_nombre']
                    ];
                    /* -- Agregar el registro -- */
                    $agregar_grafica = solicitudModelo::agregar_actividad_home_modelo($datos_actividad_home_reg);
                }
            }
        }

        //Verificar que exista el registro que corresponda al id y al año, de no existir, entonces crear el registro
        $check_reg_actividad = mainModel::ejecutar_consulta_simple("SELECT home_actividad_id FROM home_actividad WHERE home_actividad_year ='$year' AND actividad_id='$actividad_id'");
        if ($check_reg_actividad->rowCount() <= 0) {
            //Obtener el nombre de la actividad
            $nombre_actividad = mainModel::ejecutar_consulta_simple("SELECT actividad_nombre FROM actividad WHERE actividad_id='$actividad_id'");
            $nombre_actividad = $nombre_actividad->fetch();
            $actividad_nombre = $nombre_actividad['actividad_nombre'];

            //Agregar el registro
            $datos_actividad_home_reg = [
                "Year" => $year,
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "ActividadID" => $actividad_id,
                "Nombre" => $actividad_nombre
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_actividad_home_modelo($datos_actividad_home_reg);
        }

        //Ahora si se actuliza la cantidad y el porcentaje.
        //Se tiene que obtener el total de solicitud_actividades, para asi sacar el porcentaje
        $fecha_inicio = $year . "-01-01";
        $fecha_fin = $year . "-12-31";
        $total_solicitudes = mainModel::ejecutar_consulta_simple("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        $total_solicitudes = $total_solicitudes->rowCount();

        //la cantidad seria igual a 1a actividad escogida
        if ($total_solicitudes != 0) {
            $porcentaje = (1 * 100) / $total_solicitudes;
            $porcentaje = round($porcentaje, 2);
        } else {
            $porcentaje = 0;
        }

        //Actualizar la tabla home actividad
        //Agregar el registro
        $datos_actividad_home_up = [
            "Cantidad" => 1,
           // "Porcentaje" => $porcentaje,
            "Year" => $year,
            "Actividad" => $actividad_id
        ];
        /* -- Agregar el registro -- */
        $agregar_grafica = solicitudModelo::actualizar_actividad_home_modelo($datos_actividad_home_up);


            //Realizar la actualizacion de los porcentajes obtenidos
        /** Obtener todos los datos de la tabla home indicador **/
        $total_home_municipio = 0;
        $rs_total_home_municipio = mainModel::ejecutar_consulta_simple("SELECT home_actividad_id, home_actividad_cantidad FROM home_actividad WHERE home_actividad_year='$year'");
        if($rs_total_home_municipio->rowCount()>0){
            $rs_total_home_municipio = $rs_total_home_municipio->fetchAll();
             foreach($rs_total_home_municipio as $fila){
                $total_home_municipio += $fila['home_actividad_cantidad'];
            }
         }

        $rs_munic = mainModel::ejecutar_consulta_simple("SELECT home_actividad_id, home_actividad_cantidad FROM home_actividad WHERE home_actividad_year='$year'");
        if($rs_munic->rowCount()>0){
            $rs_munic = $rs_munic->fetchAll();

            foreach($rs_munic as $row){
                //obtener el porcentaje
                $porcentaje = ($row['home_actividad_cantidad'] * 100) / $total_home_municipio;
                $porcentaje = round($porcentaje, 2);
                //Crear el dato a mandar al modelo
                $act_modelo_porcentanje = [
                    "Indicador"=>$row['home_actividad_id'],
                    "Porcentaje"=> $porcentaje
                ];

                $rs_cambio = solicitudModelo::actualizar_actividad_porcentaje_modelo($act_modelo_porcentanje);

            }
        }

        //Fin actualizacion de los porcentajes


        return true;
    }

    /* Controlador para actualizar la tabla home_indicador */

    static public function actualizar_home_indicador_controlador($actividad_id, $fecha) {
        //Obtener año actual
        //$fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);

        $year = $fecha[0];

        //Obtener el id del indicador a traves del id actividad
        $rs_indicador = mainModel::ejecutar_consulta_simple("SElECT indicador_id FROM actividad WHERE actividad_id='$actividad_id' LIMIT 0,1");
        $indicador_id = 1;
        if ($rs_indicador->rowCount() > 0) {
            $rs_indicador = $rs_indicador->fetch();
            $indicador_id = $rs_indicador['indicador_id'];
        }

        //Obtener el nombre del indicador a traves del id indicador
        $rs_nombre_indicador = mainModel::ejecutar_consulta_simple("SELECT indicador_nombre FROM indicador WHERE indicador_id='$indicador_id' LIMIT 0,1");
        $indicador_nombre = "";
        if ($rs_nombre_indicador->rowCount() > 0) {
            $rs_nombre_indicador = $rs_nombre_indicador->fetch();
            $indicador_nombre = $rs_nombre_indicador['indicador_nombre'];
        }

        //Verificar si exite algun registro que contenga el año actual del registro de indicadores
        //En caso contrario crear dichos registros con todas los $indicadores, que esten registradas en BD
        $check_home_indicador = mainModel::ejecutar_consulta_simple("SELECT home_indicador_id FROM home_indicador WHERE home_indicador_year ='$year'");
        if ($check_home_indicador->rowCount() <= 0) {
            //Buscaremos todas los indicadores para crearlas en la tabla home_indicador
            $indicadores = mainModel::ejecutar_consulta_simple("SELECT indicador_id, indicador_nombre FROM indicador");
            if ($indicadores->rowCount() > 0) {
                //Realizar el registro en el foreach de las actividades en la tabla home actividad
                $indicadores = $indicadores->fetchAll();

                foreach ($indicadores as $rows) {
                    //Agregar el registro en la tabla home_actividad
                    $datos_indicador_home_reg = [
                        "Year" => $year,
                        "Cantidad" => 0,
                        "Porcentaje" => 0,
                        "IndicadorID" => $rows['indicador_id'],
                        "Nombre" => $rows['indicador_nombre']
                    ];
                    /* -- Agregar el registro -- */
                    $agregar_grafica = solicitudModelo::agregar_indicador_home_modelo($datos_indicador_home_reg);
                }
            }
        }

        //Verificar que exista el registro que corresponda al id y al año, de no existir, entonces crear el registro
        $check_reg_indicador = mainModel::ejecutar_consulta_simple("SELECT home_indicador_id FROM home_indicador WHERE home_indicador_year ='$year' AND indicador_id='$indicador_id'");
        if ($check_reg_indicador->rowCount() <= 0) {
            //Obtener el nombre de la actividad
            //Agregar el registro
            $datos_indicador_home_reg = [
                "Year" => $year,
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "IndicadorID" => $indicador_id,
                "Nombre" => $indicador_nombre
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_indicador_home_modelo($datos_indicador_home_reg);
        }

        //Ahora si se actuliza la cantidad y el porcentaje.
        //Se tiene que obtener el total de solicitud_actividades, para asi sacar el porcentaje

        $fecha_inicio = $year . "-01-01";
        $fecha_fin = $year . "-12-31";
        $total_solicitudes = mainModel::ejecutar_consulta_simple("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");

        $total_solicitudes = $total_solicitudes->rowCount();

        //la cantidad seria igual a 1a actividad escogida
        if ($total_solicitudes != 0) {
            $porcentaje = (1 * 100) / $total_solicitudes;
            $porcentaje = round($porcentaje, 2);
        } else {
            $porcentaje = 0;
        }

        //Actualizar la tabla home actividad
        //Agregar el registro
        $datos_indicador_home_up = [
            "Cantidad" => 1,
           // "Porcentaje" => $porcentaje,
            "Year" => $year,
            "Indicador" => $indicador_id
        ];
        /* -- Agregar el registro -- */
        $agregar_grafica = solicitudModelo::actualizar_indicador_home_modelo($datos_indicador_home_up);

        /** Obtener todos los datos de la tabla home indicador **/
        $total_home_indicador = 0;
        $rs_total_home_indicador = mainModel::ejecutar_consulta_simple("SELECT home_indicador_id, home_indicador_cantidad FROM home_indicador WHERE home_indicador_year='$year'");
        if($rs_total_home_indicador->rowCount()>0){
            $rs_total_home_indicador = $rs_total_home_indicador->fetchAll();
             foreach($rs_total_home_indicador as $fila){
                $total_home_indicador += $fila['home_indicador_cantidad'];
            }
         }

        $rs_indicador = mainModel::ejecutar_consulta_simple("SELECT home_indicador_id, home_indicador_cantidad FROM home_indicador WHERE home_indicador_year='$year'");
        if($rs_indicador->rowCount()>0){
            $rs_indicador = $rs_indicador->fetchAll();

            foreach($rs_indicador as $row){
                //obtener el porcentaje
                $porcentaje = ($row['home_indicador_cantidad'] * 100) / $total_home_indicador;
                $porcentaje = round($porcentaje, 2);
                //Crear el dato a mandar al modelo
                $act_modelo_porcentanje = [
                    "Indicador"=>$row['home_indicador_id'],
                    "Porcentaje"=> $porcentaje
                ];

                $rs_cambio = solicitudModelo::actualizar_indicador_porcentaje_modelo($act_modelo_porcentanje);

            }
        }


        return true;
    }

    /* Controlador para actualizar la tabla home_gabinete */

    static public function actualizar_home_gabinete_controlador($gabinete_id, $fecha) {
        //Obtener año actual
       // $fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);

        $year = $fecha[0];

        //Verificar si exite algun registro que contenga el año actual del registro de acividades
        //En caso contrario crear dichos registros con todas las actividades, que esten registradas en BD
        $check_home_gabinete = mainModel::ejecutar_consulta_simple("SELECT home_gabinete_id FROM home_gabinete WHERE home_gabinete_year ='$year'");
        if ($check_home_gabinete->rowCount() <= 0) {
            //Buscaremos todas las actividades para crearlas en la tabla home_actividad
            $gabinetes = mainModel::ejecutar_consulta_simple("SELECT gabinete_id, gabinete_nombre FROM gabinete");
            if ($gabinetes->rowCount() > 0) {
                //Realizar el registro en el foreach de las actividades en la tabla home actividad
                $gabinetes = $gabinetes->fetchAll();

                foreach ($gabinetes as $rows) {
                    //Agregar el registro en la tabla home_actividad
                    $datos_gabinete_home_reg = [
                        "Year" => $year,
                        "Cantidad" => 0,
                        "Porcentaje" => 0,
                        "GabineteID" => $rows['gabinete_id'],
                        "Nombre" => $rows['gabinete_nombre']
                    ];
                    /* -- Agregar el registro -- */
                    $agregar_grafica = solicitudModelo::agregar_gabinete_home_modelo($datos_gabinete_home_reg);
                }
            }
        }

        //Verificar que exista el registro que corresponda al id y al año, de no existir, entonces crear el registro
        $check_reg_gabinete = mainModel::ejecutar_consulta_simple("SELECT home_gabinete_id FROM home_gabinete WHERE home_gabinete_year ='$year' AND gabinete_id='$gabinete_id'");
        if ($check_reg_gabinete->rowCount() <= 0) {
            //Obtener el nombre de la actividad
            $nombre_gabinete = mainModel::ejecutar_consulta_simple("SELECT gabinete_nombre FROM gabinete WHERE gabinete_id='$gabinete_id'");
            $nombre_gabinete = $nombre_gabinete->fetch();
            $gabinete_nombre = $nombre_gabinete['gabinete_nombre'];

            //Agregar el registro
            $datos_gabinete_home_reg = [
                "Year" => $year,
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "GabineteID" => $gabinete_id,
                "Nombre" => $gabinete_nombre
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_gabinete_home_modelo($datos_gabinete_home_reg);
        }

        //Ahora si se actuliza la cantidad y el porcentaje.
        //Se tiene que obtener el total de solicitud_actividades, para asi sacar el porcentaje
        $fecha_inicio = $year . "-01-01";
        $fecha_fin = $year . "-12-31";
        $total_solicitudes = mainModel::ejecutar_consulta_simple("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        $total_solicitudes = $total_solicitudes->rowCount();

        //la cantidad seria igual a 1a actividad escogida
        if ($total_solicitudes != 0) {
            $porcentaje = (1 * 100) / $total_solicitudes;
            $porcentaje = round($porcentaje, 2);
        } else {
            $porcentaje = 0;
        }

        //Actualizar la tabla home actividad
        //Agregar el registro
        $datos_gabinete_home_up = [
            "Cantidad" => 1,
           // "Porcentaje" => $porcentaje,
            "Year" => $year,
            "Gabinete" => $gabinete_id
        ];
        /* -- Agregar el registro -- */
        $agregar_grafica = solicitudModelo::actualizar_gabinete_home_modelo($datos_gabinete_home_up);


          //Realizar la actualizacion de los porcentajes obtenidos
        /** Obtener todos los datos de la tabla home indicador **/
        $total_home_municipio = 0;
        $rs_total_home_municipio = mainModel::ejecutar_consulta_simple("SELECT home_gabinete_id, home_gabinete_cantidad FROM home_gabinete WHERE home_gabinete_year='$year'");
        if($rs_total_home_municipio->rowCount()>0){
            $rs_total_home_municipio = $rs_total_home_municipio->fetchAll();
             foreach($rs_total_home_municipio as $fila){
                $total_home_municipio += $fila['home_gabinete_cantidad'];
            }
         }

        $rs_munic = mainModel::ejecutar_consulta_simple("SELECT home_gabinete_id, home_gabinete_cantidad FROM home_gabinete WHERE home_gabinete_year='$year'");
        if($rs_munic->rowCount()>0){
            $rs_munic = $rs_munic->fetchAll();

            foreach($rs_munic as $row){
                //obtener el porcentaje
                $porcentaje = ($row['home_gabinete_cantidad'] * 100) / $total_home_municipio;
                $porcentaje = round($porcentaje, 2);
                //Crear el dato a mandar al modelo
                $act_modelo_porcentanje = [
                    "Indicador"=>$row['home_gabinete_id'],
                    "Porcentaje"=> $porcentaje
                ];

                $rs_cambio = solicitudModelo::actualizar_gabinete_porcentaje_modelo($act_modelo_porcentanje);

            }
        }




        //Fin actualizacion de los porcentajes

        return true;
    }

    /* Fin Controlador */

    /* Controlador para actualizar la tabla home_gabinete */

    static public function actualizar_home_direccion_controlador($gabinete_id, $fecha) {
        //Obtener año actual
        //$fecha = mainModel::solo_fecha();
        $fecha = explode("-", $fecha);

        $year = $fecha[0];

        //Verificar si exite algun registro que contenga el año actual del registro de acividades
        //En caso contrario crear dichos registros con todas las actividades, que esten registradas en BD
        $check_home_gabinete = mainModel::ejecutar_consulta_simple("SELECT home_direccion_id FROM home_direccion WHERE home_direccion_year ='$year'");
        if ($check_home_gabinete->rowCount() <= 0) {
            //Buscaremos todas las actividades para crearlas en la tabla home_actividad
            $gabinetes = mainModel::ejecutar_consulta_simple("SELECT direccion_id, direccion_nombre FROM direccion");
            if ($gabinetes->rowCount() > 0) {
                //Realizar el registro en el foreach de las actividades en la tabla home actividad
                $gabinetes = $gabinetes->fetchAll();

                foreach ($gabinetes as $rows) {
                    //Agregar el registro en la tabla home_actividad
                    $datos_gabinete_home_reg = [
                        "Year" => $year,
                        "Cantidad" => 0,
                        "Porcentaje" => 0,
                        "DireccionID" => $rows['direccion_id'],
                        "Nombre" => $rows['direccion_nombre']
                    ];
                    /* -- Agregar el registro -- */
                    $agregar_grafica = solicitudModelo::agregar_direccion_home_modelo($datos_gabinete_home_reg);
                }
            }
        }

        //Verificar que exista el registro que corresponda al id y al año, de no existir, entonces crear el registro
        $check_reg_gabinete = mainModel::ejecutar_consulta_simple("SELECT home_direccion_id FROM home_direccion WHERE home_direccion_year ='$year' AND direccion_id='$gabinete_id'");
        if ($check_reg_gabinete->rowCount() <= 0) {
            //Obtener el nombre de la actividad
            $nombre_gabinete = mainModel::ejecutar_consulta_simple("SELECT direccion_nombre FROM direccion WHERE direccion_id='$gabinete_id'");
            $nombre_gabinete = $nombre_gabinete->fetch();
            $gabinete_nombre = $nombre_gabinete['direccion_nombre'];

            //Agregar el registro
            $datos_gabinete_home_reg = [
                "Year" => $year,
                "Cantidad" => 0,
                "Porcentaje" => 0,
                "DireccionID" => $gabinete_id,
                "Nombre" => $gabinete_nombre
            ];
            /* -- Agregar el registro -- */
            $agregar_grafica = solicitudModelo::agregar_direccion_home_modelo($datos_gabinete_home_reg);
        }

        //Ahora si se actuliza la cantidad y el porcentaje.
        //Se tiene que obtener el total de solicitud_actividades, para asi sacar el porcentaje
        $fecha_inicio = $year . "-01-01";
        $fecha_fin = $year . "-12-31";
        $total_solicitudes = mainModel::ejecutar_consulta_simple("SELECT solicitud_actividad.sol_act_id FROM solicitud_actividad INNER JOIN solicitud ON solicitud.solicitud_id = solicitud_actividad.solicitud_id WHERE solicitud.solicitud_inicio>='$fecha_inicio' AND solicitud.solicitud_inicio<='$fecha_fin'");
        $total_solicitudes = $total_solicitudes->rowCount();

        //la cantidad seria igual a 1a actividad escogida
        if ($total_solicitudes != 0) {
            $porcentaje = (1 * 100) / $total_solicitudes;
            $porcentaje = round($porcentaje, 2);
        } else {
            $porcentaje = 0;
        }

        //Actualizar la tabla home actividad
        //Agregar el registro
        $datos_gabinete_home_up = [
            "Cantidad" => 1,
            //"Porcentaje" => $porcentaje,
            "Year" => $year,
            "Direccion" => $gabinete_id
        ];
        /* -- Agregar el registro -- */
        $agregar_grafica = solicitudModelo::actualizar_direccion_home_modelo($datos_gabinete_home_up);

          //Realizar la actualizacion de los porcentajes obtenidos
        /** Obtener todos los datos de la tabla home indicador **/
        $total_home_municipio = 0;
        $rs_total_home_municipio = mainModel::ejecutar_consulta_simple("SELECT home_direccion_id, home_direccion_cantidad FROM home_direccion WHERE home_direccion_year='$year'");
        if($rs_total_home_municipio->rowCount()>0){
            $rs_total_home_municipio = $rs_total_home_municipio->fetchAll();
             foreach($rs_total_home_municipio as $fila){
                $total_home_municipio += $fila['home_direccion_cantidad'];
            }
         }

        $rs_munic = mainModel::ejecutar_consulta_simple("SELECT home_direccion_id, home_direccion_cantidad FROM home_direccion WHERE home_direccion_year='$year'");
        if($rs_munic->rowCount()>0){
            $rs_munic = $rs_munic->fetchAll();

            foreach($rs_munic as $row){
                //obtener el porcentaje
                $porcentaje = ($row['home_direccion_cantidad'] * 100) / $total_home_municipio;
                $porcentaje = round($porcentaje, 2);
                //Crear el dato a mandar al modelo
                $act_modelo_porcentanje = [
                    "Indicador"=>$row['home_direccion_id'],
                    "Porcentaje"=> $porcentaje
                ];

                $rs_cambio = solicitudModelo::actualizar_direccion_porcentaje_modelo($act_modelo_porcentanje);

            }
        }




        //Fin actualizacion de los porcentajes

        return true;
    }

    /* Fin Controlador */

    /* Controlador para editar solicitud */

    public function actualizar_solicitud_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['solicitud_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Obtener año
        //Obtener la fecha
        $fecha_form = mainModel::limpiar_cadena($_POST['fecha_reg']);
        $hora_solicitud = mainModel::crear_fecha();
        $rs_hora = explode (" ", $hora_solicitud);
        $hora = $rs_hora[1];

        $fecha_inicio = $fecha_form . ' ' . $hora;
        

        //$fecha = mainModel::solo_fecha();
        $fecha_year = explode("-", $fecha_form);
        $year = $fecha_year[0];

        //Comprobar la solicitud mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM solicitud WHERE solicitud_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el solicitud en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        $descripcion = mainModel::limpiar_cadena($_POST['solicitud_descripcion_up']);
        $usuario = mainModel::decryption($_POST['solicitud_usuario_up']);
        $usuario = mainModel::limpiar_cadena($usuario);

        $sector = mainModel::decryption($_POST['sector_up']);
        $sector = mainModel::limpiar_cadena($sector);

        $gabinete = mainModel::decryption($_POST['gabinete_up']);
        $gabinete = mainModel::limpiar_cadena($gabinete);

        $direccion = mainModel::decryption($_POST['direccion_up']);
        $direccion = mainModel::limpiar_cadena($direccion);

        $estado = "procesando";
        $actividad_estado = "sin asignar";
        $fecha_inicio = $campos['solicitud_inicio'];
        //$fecha_fin = $campos['solicitud_fin'];
        $fecha_fin = "00-00-00 00:00:00";
        /* --------  Comprobar los campos vacios  -------- */
        if ($usuario == "" || $descripcion == "" || $sector == "" || $gabinete == "" || $direccion == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //VALIDAR QUE EL SECTOR PERTENEZCA A LA PARROQUIA DEL USUARIO
        //Obtener parroquia
        $parroquia_id = 0;
        $rs_parroquia = mainModel::ejecutar_consulta_simple("SELECT parroquia_id FROM usuario_parroquia WHERE usuario_id='$usuario'");
        if ($rs_parroquia->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido obtener el id de la parroquia",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $rs_parroquia = $rs_parroquia->fetch();
            $parroquia_id = $rs_parroquia['parroquia_id'];
        }

        //obtner el id del municipio
        $rs_municipio = mainModel::ejecutar_consulta_simple("SELECT municipio_id FROM parroquia WHERE parroquia_id='$parroquia_id'");
        $municipio_id = 0;
        if ($rs_municipio->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se encuentra un municipio relacionado a la parroquia del ciudadano",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $rs_municipio = $rs_municipio->fetch();
            $municipio_id = $rs_municipio['municipio_id'];
        }

        //COMPROBAR QUE EL SECTOR EXISTA
        $check_sector = mainModel::ejecutar_consulta_simple("SELECT sector_id FROM sector WHERE sector_id='$sector'");
        if ($check_sector->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El sector que acaba de seleccionar no se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //COMPROBAR QUE EL GABINETE EXISTA
        $check_gabinete = mainModel::ejecutar_consulta_simple("SELECT gabinete_id FROM gabinete WHERE gabinete_id='$gabinete'");
        if ($check_gabinete->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Gabinete que acaba de seleccionar no se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //COMPROBAR QUE LA DIRECCION EXISTA
        $check_direccion = mainModel::ejecutar_consulta_simple("SELECT direccion_id FROM direccion WHERE direccion_id='$direccion'");
        if ($check_direccion->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Direccion que acaba de seleccionar no se encuentra registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //COMPROBAR QUE EL SECTOR PERTENEZCA A LA PARROQUIA
        $check_parroquia_sector = mainModel::ejecutar_consulta_simple("SELECT sector_id FROM sector WHERE sector_id='$sector' AND parroquia_id='$parroquia_id'");
        if ($check_parroquia_sector->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El sector que acaba de seleccionar no corresponde a la parroquia registrada por el ciudadano",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que el array de checkbox no este vacio */
        if (empty($_POST['actividad'])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Debe seleccionar almenos una actividad, para poder procesar una solicitud",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-: ]{2,440}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La descripcion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        if (mainModel::verificar_datos("[0-9]{1,11}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }




        /* ------  Comprobando que el usuario este registrado en el sistema ------ */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$usuario'");
        if ($check_usuario->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario que intenta ingresar al sistema, no se encuentra registrado, presione  F5 he intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }




        /* Comprobar que todas las actividades pertenezcan a la tabla actividad si hay una que no pertenece, entonces no realizar la solicitud */

        foreach ($_POST['actividad'] as $actividad) {
            $rs_actividad = mainModel::decryption($actividad);
            $rs_actividad = mainModel::limpiar_cadena($rs_actividad);
            /* ------  Comprobando que el nombre sea unica ------ */
            $check_nombre = mainModel::ejecutar_consulta_simple("SELECT actividad_id FROM actividad WHERE actividad_id='$rs_actividad'");
            if ($check_nombre->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La actividad que intenta ingresar al sistema, no se encuentra registrada, presione  F5 he intente nuevamente.",
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
                "Texto" => "No tienes los permisos suficientes para editar este solicitud",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }




        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_solicitud_up = [
            "Usuario" => $usuario,
            "Inicio" => $fecha_inicio,
            "Estado" => $estado,
            "ID" => $id
        ];

         $url = SERVERURL . "solicitudes-list/";
         
        if (solicitudModelo::actualizar_solicitud_ciudadano_modelo($datos_solicitud_up)) {
            //Registrar relacion usuario sector
            //Registrar relacion soliciud gabinete
            //chequear que este usuario no tenga sector registrado

            $check_usuario_sector = mainModel::ejecutar_consulta_simple("SELECT usuario_sector_id FROM usuario_sector WHERE usuario_id='$usuario'");
            if ($check_usuario_sector->rowCount() <= 0) {
                $datos_usuario_sector_reg = [
                    "Usuario" => $usuario,
                    "Sector" => $sector
                ];
                //-- Agregar el registro -- 
                $agregar_usuario_sector = solicitudModelo::agregar_usuario_sector_modelo($datos_usuario_sector_reg);
            }

            //Relacion solicitud Gabinete
            $check_solicitud_gabinete = mainModel::ejecutar_consulta_simple("SELECT solicitud_gabinete_id FROM solicitud_gabinete WHERE solicitud_id='$id' AND gabinete_id='$gabinete'");
            if ($check_solicitud_gabinete->rowCount() <= 0) {
                $datos_solicitud_gabinete_reg = [
                    "Solicitud" => $id,
                    "Gabinete" => $gabinete
                ];
                $relacion_solicitud_gabinete = solicitudModelo::agregar_solicitud_gabinete_modelo($datos_solicitud_gabinete_reg);
            }

            //Relacion solicitud direccion
            $check_solicitud_direccion = mainModel::ejecutar_consulta_simple("SELECT solicitud_direccion_id FROM solicitud_direccion WHERE solicitud_id='$id' AND direccion_id='$direccion'");
            if ($check_solicitud_direccion->rowCount() <= 0) {
                $datos_solicitud_direccion_reg = [
                    "Solicitud" => $id,
                    "Direccion" => $direccion
                ];
                $relacion_solicitud_direccion = solicitudModelo::agregar_solicitud_direccion_modelo($datos_solicitud_direccion_reg);
            }

            //Eliminar todas las actividades relacionadas al id solicitud
            $eliminar_actividades = mainModel::ejecutar_consulta_simple("DELETE FROM solicitud_actividad WHERE solicitud_id='$id'");
            //Agregar actividades a la solicitud
            //Inicio ciclo agregar actividades a la tabla solicitud - actividad
            //$estado = "sin asignar";
            $cont_actividades_agregadas = 0;
            foreach ($_POST['actividad'] as $actividad) {
                $rs_actividad = mainModel::decryption($actividad);
                $rs_actividad = mainModel::limpiar_cadena($rs_actividad);
                /* --- Agregar la relacion solicitud actividad --- */
                $datos_solicitud_activo_reg = [
                    "Solicitud" => $id,
                    "Actividad" => $rs_actividad,
                    "Estado" => $actividad_estado,
                    "Fin" => $fecha_fin
                ];

                /* -- Agregar el registro -- */
                $agregar_solicitud_actividad = solicitudModelo::agregar_solicitud_actividad_modelo($datos_solicitud_activo_reg, $fecha_form);

                //Actualizar la tabla home_actividad
                $agr_actividad = solicitudControlador::actualizar_home_actividad_controlador($rs_actividad, $fecha_form);

                //Actualizar la tabla home_indicador
                $agr_indicador = solicitudControlador::actualizar_home_indicador_controlador($rs_actividad, $fecha_form);

                //Actualizar la tabla home_gabinete
                $agre_gabinete = solicitudControlador::actualizar_home_gabinete_controlador($gabinete, $fecha_form);

                //Actualizar la tabla home_direccion
                $agre_direccion = solicitudControlador::actualizar_home_direccion_controlador($direccion, $fecha_form);

                //cada actividad corresponde a una nueva actividad, asi que valor uno cada vez q actualice
                $agr_solic = solicitudControlador::mensualidad_solicitud_controlador(1, $fecha_form);

                $cont_actividades_agregadas++;
            }

            $agr_mapa = solicitudControlador::agregar_datos_mapa_controlador($year, $municipio_id, $cont_actividades_agregadas);
            /*             * ********************************** */

            //Fin del Ciclo agregar solicitud actividad
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Actualizo la siguiente solicitud: " . $descripcion;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            /*
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos del solicitud fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
            */
            
             $alerta = [
                "Alerta" => "linkredireccionar",
                "Titulo" => "Solicitud Actualizada",
                "Texto" => "Los datos del solicitud fueron actualizados satisfactoriamente.",
                "Tipo" => "success",
                "Footer"=>"Exito",
                "URL" => $url
            ];
            
        } else {
            //Para agregar bitacora
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "No pudo actualizar el siguiente solicitud: " . $descripcion;
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos del solicitud no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador editar solicitud */


    /* paginador para seleccionar una solicitud */

    /** Controlador paginar solicituds * */
    public function paginador_solicitud_seleccionar_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2 || $_SESSION['tipo_tor'] == 3) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.sol_act_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE (solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR actividad.actividad_nombre LIKE '%$busqueda%' OR usuario.usuario_usuario LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%') AND (solicitud_actividad.solicitud_estado='sin asignar' AND solicitud.solicitud_estado='procesando') ORDER BY solicitud.solicitud_inicio ASC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.sol_act_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE ((solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR solicitud.solicitud_inicio LIKE '%$busqueda%' OR actividad.actividad_nombre LIKE '%$busqueda%' OR usuario.usuario_usuario LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%') AND (solicitud.usuario_id='$usuario_actual') AND (solicitud_actividad.solicitud_estado='sin asignar' AND solicitud.solicitud_estado='procesando')) ORDER BY solicitud.solicitud_inicio ASC LIMIT $inicio,$registros";
            }

            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Hizo la siguiente busqueda: " . $busqueda . " en el listado de solicitud";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        } else {
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2 || $_SESSION['tipo_tor'] == 3) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.sol_act_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE (solicitud_actividad.solicitud_estado='sin asignar' AND solicitud.solicitud_estado='procesando') ORDER BY solicitud.solicitud_inicio ASC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS solicitud.solicitud_id, solicitud_actividad.sol_act_id, solicitud_actividad.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, actividad.actividad_nombre, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_usuario FROM solicitud INNER JOIN solicitud_actividad ON solicitud.solicitud_id=solicitud_actividad.solicitud_id INNER JOIN actividad ON actividad.actividad_id=solicitud_actividad.actividad_id INNER JOIN usuario ON solicitud.usuario_id = usuario.usuario_id WHERE (solicitud.usuario_id='$usuario_actual' AND solicitud_actividad.solicitud_estado='sin asignar' AND solicitud.solicitud_estado='procesando') ORDER BY solicitud.solicitud_inicio ASC LIMIT $inicio,$registros";
            }
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Visualizo el listado de solicitud";
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
					<th>#</th><th>CONTROL</th>
					<th>DESCRIPCION</th><th>ACTIVIDAD</th><th>FECHA</th><th>ESTADO</th>';

        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '<th>SELECCIONAR</th>';
        }


        $tabla .= '</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td> <td class="text-left">' . $rows['solicitud_id'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . ' (' . $rows['usuario_usuario'] . ') ' . $rows['solicitud_descripcion'] . '</td>
                                        <td class="text-left">' . $rows['actividad_nombre'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_inicio'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_estado'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'asignacion-selected/' . mainModel::encryption($rows['sol_act_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-check"></i></a></td>';
                }




                $tabla .= '</tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="8"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="8">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando solicitud ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin Controlador paginador solicitud */

    //Controlador para agregar usuarios al sistema
    public function solicitudes() {
        //Obtener las variables del Formulario
        $solicitud = "Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raices en una pieza clasica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, consecteur,";
        $nombre_apellido = "Nombre de Ciudadano";
        $cedula = time();
        $telefono = "0424" . time();
        $correo = $cedula . "@gmail.com";
        $municipio = rand(1, 21);

        //Obtener un id de una parroquia que corresponda a un municipio
        $obt_parroquia = mainModel::ejecutar_consulta_simple("SELECT parroquia_id FROM parroquia WHERE municipio_id='$municipio' LIMIT 0,1");
        $obt_parroquia = $obt_parroquia->fetch();
        $parroquia_id = $obt_parroquia['parroquia_id'];

        $parroquia = $parroquia_id;

        //obtener un sector que dependa de la parroquia
        $obt_sector = mainModel::ejecutar_consulta_simple("SELECT sector_id FROM sector WHERE parroquia_id='$parroquia' LIMIT 0,1");

        if ($obt_sector->rowCount() > 0) {
            $obt_sector = $obt_sector->fetch();
            $sector_id = $obt_sector['sector_id'];
        } else {
            $sector_id = $parroquia;
        }



        $sector = "Sector Donde vive el ciudadano";

        if (rand(1, 2) == 1) {
            $fecha_hora = "2022-01-15 10:30:15";
            $soliciud_estado = "sin procesar";
            $fecha = "2022-01-15";
        } else {
            $fecha_hora = mainModel::crear_fecha();
            $soliciud_estado = "sin procesar";
            $fecha = mainModel::solo_fecha();
        }

        $fecha_exp = explode("-", $fecha);
        $year = $fecha_exp[0];
        $mes = $fecha_exp[1];
        $dia = $fecha_exp[2];
        $dia = intval($dia) + 1;
        if ($dia < 10) {
            $dia = "0" . $dia;
        }
        $fecha_fin = $year . "-" . $mes . "-" . $dia;

        //REGISTRAR USUARIO
        //Hago el registro del usuario
        $clave = "Rm5SSjEvVW5sWmVNZ1huOFVpNVE1czdzdUhrU1FnVmhabDB4QXRnTVJvUT0=";
        $datos_usuario_reg = [
            "DNI" => $cedula,
            "Nombre" => $nombre_apellido,
            "Apellido" => "",
            "Telefono" => $telefono,
            "Direccion" => $sector,
            "Email" => $correo,
            "Usuario" => "ciudadano" . $cedula,
            "Clave" => $clave,
            "Estado" => "Deshabilitada",
            "Privilegio" => 3,
            "Imagen" => "default.jpg",
            "Tipo" => 4
        ];

        //Agregar el usuario
        $agregar_usuario = solicitudModelo::agregar_usuario_modelo($datos_usuario_reg);

        //OBTENER EL ID DEL USUARIO REGISTRADO
        $obtener_usuario_id = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_dni='$cedula'");
        if ($obtener_usuario_id->rowCount() > 0) {
            $obtener_usuario_id = $obtener_usuario_id->fetch();
            $usuario_id = $obtener_usuario_id['usuario_id'];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido obtener el ID de su usuario, intente nuevamnete dentro de unos minutos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Agregar usuario parroquia 
        $ag_usuario_parroquia = mainModel::ejecutar_consulta_simple("INSERT INTO usuario_parroquia(usuario_id, parroquia_id) VALUES ('$usuario_id', '$parroquia_id')");

        //Agregar usuario sctor 
        $ag_usuario_sector = mainModel::ejecutar_consulta_simple("INSERT INTO usuario_sector(usuario_id, sector_id) VALUES ('$usuario_id', '$sector_id')");

        //Area para agregar la solicitud
        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_solicitud_reg = [
            "Usuario" => $usuario_id,
            "Inicio" => $fecha_hora,
            "Estado" => $soliciud_estado,
            "Descripcion" => $solicitud
        ];

        /* colocar enlace */
        /* -- Agregar el registro -- */
        $agregar_solicitud = solicitudModelo::agregar_solicitud_modelo($datos_solicitud_reg);

        if ($agregar_solicitud->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

            /*
              $alerta = [
              "Alerta" => "limpiar",
              "Titulo" => "Registro Exitoso",
              "Texto" => "Su solicitud ha sido enviada, espere que prontamente nos comunicaremos con usted, via telefonica o a traves del correo electronico registrado.",
              "Tipo" => "success"
              ];
             */
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido enviar su solicitud, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        // echo json_encode($alerta);
    }

    //Controlador para agregar a gabinete

    public function agregar_gabinete_actividad() {

        //obtener todos los id de las solicitudes realizadas
        $obt_id_solicitudes = mainModel::ejecutar_consulta_simple("SELECT solicitud_id FROM solicitud");
        if ($obt_id_solicitudes->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el solicitud en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $obt_id_solicitudes = $obt_id_solicitudes->fetchAll();
        }

        $fecha_fin = "00-00-00 00:00:00";

        //Ciclo para agregar los gabinetes y las actividades y cambiar el estado de las solicitudes a procesadas
        foreach ($obt_id_solicitudes as $solicitud) {
            $gabinete = rand(1, 6);
            $actividad = rand(1, 6);
            $estado = "procesando";
            $solicitud_id = $solicitud['solicitud_id'];

            $check_solicitud_gabinete = mainModel::ejecutar_consulta_simple("SELECT solicitud_gabinete_id FROM solicitud_gabinete WHERE solicitud_id='$solicitud_id'");
            if ($check_solicitud_gabinete->rowCount() <= 0) {

                $datos_solicitud_up = [
                    "Estado" => $estado,
                    "ID" => $solicitud_id
                ];

                $act_solicitud = solicitudModelo::actualizar_solicitud_estado_script($datos_solicitud_up);

                $datos_solicitud_gabinete_reg = [
                    "Solicitud" => $solicitud_id,
                    "Gabinete" => $gabinete
                ];

                $relacion_solicitud_gabinete = solicitudModelo::agregar_solicitud_gabinete_modelo($datos_solicitud_gabinete_reg);

                $datos_solicitud_activo_reg = [
                    "Solicitud" => $solicitud_id,
                    "Actividad" => $actividad,
                    "Estado" => $estado,
                    "Fin" => $fecha_fin
                ];

                /* -- Agregar el registro -- */
                $agregar_solicitud_actividad = solicitudModelo::agregar_solicitud_actividad_modelo($datos_solicitud_activo_reg);
            }
        }
    }

    //Script para agregar una asignacion a un usuario

    /** Controlador para agregar una asignacion * */
    public function agregar_asignacion_script() {

        //obtener los id de la tabla solicitud actividad
        $solicitudes = mainModel::ejecutar_consulta_simple("SELECT sol_act_id FROM solicitud_actividad");
        $observacion = "Asignacion realizada via script, para que se responda esta solicitud a la brevedad posible";
        $fecha_asignacion = "2022-02-22 9:45:32";
        if ($solicitudes->rowCount() > 0) {
            $solicitudes = $solicitudes->fetchAll();

            foreach ($solicitudes as $rows) {
                //Obtener el id del operador
                $operador_random = rand(1, 4);
                $operador = 0;
                if ($operador_random == 1) {
                    $operador = 28;
                } elseif ($operador_random == 2) {
                    $operador = 3386;
                } elseif ($operador_random == 3) {
                    $operador = 3387;
                } elseif ($operador_random == 4) {
                    $operador = 3388;
                }
                $solicitud_id = $rows['sol_act_id'];

                //INSERTAR LA DATA
                $datos_asignacion_reg = [
                    "Solicitud" => $solicitud_id,
                    "Operador" => $operador,
                    "Observacion" => $observacion,
                    "Fecha" => $fecha_asignacion,
                    "Asignado" => $operador
                ];

                //Antes de agregar el registro verificar si no existe ya dicho registro en el sistema
                $check_asignacion = mainModel::ejecutar_consulta_simple("SELECT asignacion_id FROM asignacion WHERE solicitud_actividad='$solicitud_id' LIMIT 0,1");
                if ($check_asignacion->rowCount() <= 0) {
                    /* -- Agregar el registro -- */
                    $agregar_asignacion = solicitudModelo::agregar_asignacion_modelo($datos_asignacion_reg);
                }
            }
        }
    }

    /* Fin Controlador */

    /* Controlador para paginar las evaluaciones */

    /** Controlador paginar solicituds * */
    public function paginador_evaluacion_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS feedback.feedback_id, feedback.feedback_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_dni FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id WHERE solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR feedback.feedback_descripcion LIKE '%$busqueda%' OR feedback.feedback_tiempo_respuesta LIKE '%$busqueda%' OR feedback.feedback_tipo_solucion LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS feedback.feedback_id, feedback.feedback_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_dni FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id WHERE ((solicitud.solicitud_id LIKE '%$busqueda%' OR solicitud.solicitud_descripcion LIKE '%$busqueda%' OR feedback.feedback_descripcion LIKE '%$busqueda%' OR feedback.feedback_tiempo_respuesta LIKE '%$busqueda%' OR feedback.feedback_tipo_solucion LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%') AND (solicitud.usuario_id='$usuario_actual')) ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }

            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Hizo la siguiente busqueda: " . $busqueda . " en el listado de solicitud";
            $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
        } else {
            if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS feedback.feedback_id, feedback.feedback_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_dni FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            } else {
                $usuario_actual = $_SESSION['id_tor'];
                $consulta = "SELECT SQL_CALC_FOUND_ROWS feedback.feedback_id, feedback.feedback_descripcion, feedback.feedback_tiempo_respuesta, feedback.feedback_tipo_solucion, solicitud.solicitud_id, solicitud.solicitud_estado, solicitud.solicitud_descripcion, solicitud.solicitud_inicio, usuario.usuario_nombre, usuario.usuario_apellido, usuario.usuario_dni FROM feedback INNER JOIN usuario ON feedback.usuario_id = usuario.usuario_id INNER JOIN solicitud ON feedback.solicitud_id = solicitud.solicitud_id WHERE solicitud.usuario_id='$usuario_actual' ORDER BY solicitud.solicitud_inicio DESC LIMIT $inicio,$registros";
            }
            //Para agregar bitacora
            // session_start(['name' => 'TOR']);
            $fecha_bitacora = mainModel::crear_fecha();
            $usuario_bitacora = $_SESSION['id_tor'];
            $accion_bitacora = "Visualizo el listado de solicitud";
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
					<th>CIUDADANO</th>
                                        <th>CONTROL SOLICITUD</th>
                                        <th>DESCRIPCION SOLICITUD</th>
                                        <th>EVALUACION</th>
                                        <th>TIEMPO REPUESTA</th>
                                        <th>TIPO SOLUCION</th>';

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
                $tipo = ""; $tiempo="";
                if($rows['feedback_tiempo_respuesta']==1){$tiempo="Malo";}
                if($rows['feedback_tiempo_respuesta']==2){$tiempo="Regular";}
                if($rows['feedback_tiempo_respuesta']==3){$tiempo="Normal";}
                if($rows['feedback_tiempo_respuesta']==4){$tiempo="Bueno";}
                
                if($rows['feedback_tipo_solucion']==1){$tipo="Malo";}
                if($rows['feedback_tipo_solucion']==2){$tipo="Regular";}
                if($rows['feedback_tipo_solucion']==3){$tipo="Normal";}
                if($rows['feedback_tipo_solucion']==4){$tipo="Bueno";}
               

                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td> 
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . ' (' . $rows['usuario_dni'] . ')</td>
                                        <td class="text-left">' . $rows['solicitud_id'] . '</td>                                        
                                        <td class="text-left">' . $rows['solicitud_descripcion'] . '</td>
                                        <td class="text-left">' . $rows['feedback_descripcion'] . '</td>'
                        . '             <td class="text-left">' . $tiempo . '</td>'
                        . '             <td class="text-left">' . $tipo . '</td>';

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/solicitudAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="evaluacion_id_del" value="' . mainModel::encryption($rows['feedback_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-danger">
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
                $tabla .= '<tr class="text-center"><td colspan="8"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="8">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando solicitud ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin Controlador paginador solicitud */
}
