<?php

if ($peticionAjax) {
    require_once "../modelos/usuarioModelo.php";
} else {
    require_once "./modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo {
    /* Agregar relacion usuario direccion, parroquia y sector */

    public function relacion_usuario_direccion_controlador() {
        
        //Obtener los datos en post
        $usuario_id = mainModel::decryption($_POST['relacion_usuario_id_reg']);
        $usuario_id = mainModel::limpiar_cadena($usuario_id);
        $sector = mainModel::decryption($_POST['sector_nombre_reg']);
        $sector = mainModel::limpiar_cadena($sector);
        $municipio = mainModel::decryption($_POST['municipio_nombre_reg']);
        $municipio = mainModel::limpiar_cadena($municipio);
        $parroquia = mainModel::decryption($_POST['parroquia_nombre_reg']);
        $parroquia = mainModel::limpiar_cadena($parroquia);
        
         
         
        //Verificar que no entre del formulario campos en blanco
         /* --------  Comprobar los campos vacios  -------- */
        if ($usuario_id == "" || $municipio == "" || $parroquia == "" || $sector == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Validar los campos que se estan recibiendo */
         if (mainModel::verificar_datos("[0-9]{1,11}", $usuario_id)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Usuario no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            if (mainModel::verificar_datos("[0-9]{1,11}", $municipio)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Municipio no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[0-9]{1,11}", $parroquia)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La Parroquia no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            if (mainModel::verificar_datos("[0-9]{1,11}", $sector)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "EL Sector no coincide con el formato solicitado.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
             /*  $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => $usuario_id . ", " . $sector . ", " .$municipio . ", " . $parroquia . ". " ,
                "Tipo" => "error"
            ];
         echo json_encode($alerta);
            exit();
            */
            //Validar que los diferentes id pertenezcan a una tabla en la base de datos
             $check_usuario_direccion = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario_sector WHERE usuario_id='$usuario_id' LIMIT 0,1");
        if ($check_usuario_direccion->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Usuario que acaba de seleccionar ya tiene una direccion relacianada.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
     
                     /* ------  Comprobando que el usuario este registrada en la tabla ------ */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$usuario_id' LIMIT 0,1");
        if ($check_usuario->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Usuario que acaba de seleccionar no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
            
                 /* ------  Comprobando que el sector este registrada en la tabla ------ */
        $check_sector = mainModel::ejecutar_consulta_simple("SELECT sector_id FROM sector WHERE sector_id='$sector' LIMIT 0,1");
        if ($check_sector->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Sector que acaba de seleccionar no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
            
            /* ------  Comprobando que la municipio este registrada en la tabla ------ */
        $check_municipio = mainModel::ejecutar_consulta_simple("SELECT municipio_id FROM municipio WHERE municipio_id='$municipio' LIMIT 0,1");
        if ($check_municipio->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Municipio que acaba de seleccionar no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
     
            
        /* ------  Comprobando que la parroquia este registrada en la tabla ------ */
        $check_parroquia = mainModel::ejecutar_consulta_simple("SELECT parroquia_id FROM parroquia WHERE parroquia_id='$parroquia' LIMIT 0,1");
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
        $check_parroquia_municipio = mainModel::ejecutar_consulta_simple("SELECT parroquia_id FROM parroquia WHERE parroquia_id='$parroquia' AND municipio_id='$municipio' LIMIT 0,1");
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
        
    
            
            
         /** Validar que el sector pertenezca a la parroquia * */
        $check_sector_parroquia = mainModel::ejecutar_consulta_simple("SELECT sector_id FROM sector WHERE parroquia_id='$parroquia' AND sector_id='$sector' LIMIT 0,1");
        if ($check_sector_parroquia->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "EL Sector que acaba de escoger no pertenece a la Parroquia seleccionada, corrija y vuelta a intentarlo.",
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
            $agregar_usuario_parroquia = usuarioModelo::agregar_usuario_parroquia_modelo($datos_usuario_parroquia_reg);
            if ($agregar_usuario_parroquia->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No hemos podido registrar la relacion parroquia usuario, intente nuevamente.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        
            //Registrar relacion usuario setor.
            $datos_usuario_sector_reg = [
                "Usuario" => $usuario_id,
                "Sector" => $sector
            ];

            /* -- Agregar el registro -- */
            $agregar_usuario_sector = usuarioModelo::agregar_usuario_sector_modelo($datos_usuario_sector_reg);
            if ($agregar_usuario_sector->rowCount() <= 0) {
                
                //Eliminar la relacion
                $delete_rel = mainModel::ejecutar_consulta_simple("DELETE FROM usuario_parroquia WHERE usuario_id='$usuario_id'");
                
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No hemos podido registrar la relacion sector usuario, intente nuevamente.",
                    "Tipo" => "error"
                ];
                
            }else{
                $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Registro Exitoso",
                "Texto" => "Se ha asignado la direccion al Usuario de manera satisfactoria.",
                "Tipo" => "success"
            ];
            }
            echo json_encode($alerta);
               
            
    }

    /* Controlador para agregar una nueva relacion entre un usuario y su cargo */

    public function agregar_usuario_cargo_controlador() {
        $usuario = mainModel::decryption($_POST['relacion_usuario_id_reg']);
        $cargo = mainModel::decryption($_POST['relacion_cargo_id_reg']);
        $usuario = mainModel::limpiar_cadena($usuario);
        $cargo = mainModel::limpiar_cadena($cargo);

        /* --------  Comprobar los campos vacios  -------- */
        if ($usuario == "" || $cargo == "") {
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
        if (mainModel::verificar_datos("[0-9]{1,11}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El ID del usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9]{1,11}", $cargo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El ID del cargo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* ------  Comprobando que el usuario este registrado en el sistema ------ */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$usuario'");
        if ($check_usuario->rowCount() <= 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario seleccionado no se encuentra registrado en el sistema, intente nuevamente",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando que el cargo este registrado en el sistema ------ */
        $check_cargo = mainModel::ejecutar_consulta_simple("SELECT cargo_id FROM cargo WHERE cargo_id='$cargo'");
        if ($check_cargo->rowCount() <= 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El cargo seleccionado no se encuentra registrado en el sistema, intente nuevamente",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Verificar que el usuario no tenga un cargo ya registrado */
        $check_relacion = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario_cargo WHERE usuario_id='$usuario'");
        if ($check_relacion->rowCount() > 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario seleccionado ya tiene registrado un cargo, elimine dicha relacion he intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_usuario_reg = [
            "Usuario" => $usuario,
            "Cargo" => $cargo
        ];

        /* -- Agregar el registro -- */
        $agregar_usuario = usuarioModelo::agregar_usuario_cargo_modelo($datos_usuario_reg);
        if ($agregar_usuario->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Registro Exitoso",
                "Texto" => "Se ha asignado un cargo al usuario de manera satisfactoria.",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar la relacion",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */


    /* ------------- Controlador para agregar usuario ----------------- */

    public function agregar_usuario_controlador() {
        $dni = mainModel::limpiar_cadena($_POST['usuario_dni_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
        $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_reg']);
        $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);
        $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_reg']);

        $usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_reg']);
        $email = mainModel::limpiar_cadena($_POST['usuario_email_reg']);
        $clave1 = mainModel::limpiar_cadena($_POST['usuario_clave_1_reg']);
        $clave2 = mainModel::limpiar_cadena($_POST['usuario_clave_2_reg']);

        $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_reg']);
        $tipo = mainModel::limpiar_cadena($_POST['usuario_tipo_reg']);

         //Agregar Fecha de Nacimiento y Genero
         $genero = mainModel::limpiar_cadena($_POST['usuario_genero_reg']);
         $fecha_nacimiento = mainModel::limpiar_cadena($_POST['usuario_fecha_nacimiento_reg']);

        //Para el archivo con la imagen de perfil
        $origen = $_FILES['multimedia_perfil_reg']['tmp_name'];
        $tamano_archivo = $_FILES['multimedia_perfil_reg']['size'];
        $nombre_archivo = $_FILES['multimedia_perfil_reg']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);

        $imagen = "avatar.jpg";

        /* --------  Comprobar los campos vacios  -------- */
        if ($genero == "" || $fecha_nacimiento == "" || $dni == "" || $nombre == "" || $apellido == "" || $usuario == "" || $clave1 == "" || $clave2 == "" || $nombre_archivo == "") {
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
        if (mainModel::verificar_datos("[0-9-]{6,20}", $dni)) {
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

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}", $apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Apellido no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Telefono no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{4,200}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La Direccion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{4,50}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de Usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave1) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave2)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Las Claves no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando DNI ------ */
        $check_dni = mainModel::ejecutar_consulta_simple("SELECT usuario_dni FROM usuario WHERE usuario_dni='$dni'");
        if ($check_dni->rowCount() > 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Numero de Cedula ingresado ya se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* ------  Comprobando Usuario ------ */
        $check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
        if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del Usuario ingresado ya se encuentra registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando el email   ----- */
        if ($email != "") {
            //filter_var se utiliza para verificar que sea un email valido
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
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
        }

        /* ------ Comprobar claves ------- */
        if ($clave1 != $clave2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Las claves que acaba de ingresar no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $clave = mainModel::encryption($clave1);
        }

        /* ---  Comprobar privilegios ---- */
        if ($privilegio < 1 || $privilegio > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El privilegio seleccionado no es valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($tipo < 1 || $tipo > 4) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El tipo seleccionado no es valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        //Con respecto a la imagen de perfil del jugador
        //Verificar que la extension del archivo sea permitida
        $extension_archivo = explode(".", $nombre_archivo, 2);
        $extension = $extension_archivo[1]; //Obtengo la extension del archivo
        $ext_permitida = "";
        //obtener las extensiones permitidas
        $extension_permitidas = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='extension_permitida'");
        if ($extension_permitidas->rowCount() > 0) {
            $extension_permitidas = $extension_permitidas->fetch();
            $ext_permitida = $extension_permitidas['configuracion_valor'];
        }

        $rs_comparacion = strpos($ext_permitida, $extension);
        if ($rs_comparacion === false) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El tipo de documento imagen perfil no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        //Verificar que el tamaño del archivo no supere el tamaño maximo permitido
        $tamano_permitido = 0;
        $rs_tamano = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='size_permitido'");
        if ($rs_tamano->rowCount() > 0) {
            $rs_tamano = $rs_tamano->fetch();
            $tamano_permitido = $rs_tamano['configuracion_valor'];
        }
        if (intval($tamano_archivo) > intval($tamano_permitido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El tamaño del Archivo es: " . $tamano_archivo . " y supera el maximo permitido que es: " . $tamano_permitido . ", intente nuevamente con un archivo menos pesado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $nombre_archivo = time() . " " . $nombre_archivo;
        //declarar variable con la ruta y el nombre donde se va a colocar el archivo
        $destino = "../multimedia/$nombre_archivo";

        $imagen = $nombre_archivo;
        //Subir el archivo al servidor
        //Subir el archivo al servidor con la imagen del perfil del jugador
        $upload = move_uploaded_file($origen, $destino); //retorna 1 si sube el archivo
        //sleep(2);
        if ($upload != 1) {
            //Mensaje para indicar que no se pudo hacer la carga del archivo al servidor
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo subir el archivo seleccionado al servidor. Por favor intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_usuario_reg = [
            "DNI" => $dni,
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "Telefono" => $telefono,
            "Direccion" => $direccion,
            "Email" => $email,
            "Usuario" => $usuario,
            "Clave" => $clave,
            "Estado" => "Activa",
            "Privilegio" => $privilegio,
            "Imagen" => $imagen,
            "Tipo" => $tipo,
            "Genero" => $genero,
            "Fecha" => $fecha_nacimiento
        ];

        /* -- Agregar el registro -- */
        $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);
        if ($agregar_usuario->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del usuario han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */

    /* ---- Controlador paginar usuarios ----- */

    public function paginador_usuario_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);

        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE ((usuario_id!='$id' AND usuario_id!='1') AND (usuario_dni LIKE '%$busqueda%' OR usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' OR usuario_telefono LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE usuario_id!='$id' AND usuario_id!='1' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";
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
					<th>CEDULA</th>
					<th>NOMBRE</th>
					<th>TELÉFONO</th>
					<th>USUARIO</th>
					<th>EMAIL</th>
					<th>ACTUALIZAR</th>
					<th>ELIMINAR</th>
				</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center" >
					<td>' . $contador . '</td>
                                        <td>' . $rows['usuario_dni'] . '</td>
                                        <td>' . $rows['usuario_nombre'] . ' ' . $rows['usuario_apellido'] . '</td>
                                        <td>' . $rows['usuario_telefono'] . '</td>
                                        <td>' . $rows['usuario_usuario'] . '</td>
                                        <td>' . $rows['usuario_email'] . '</td>
                                        <td><a href="' . SERVERURL . 'user-update/' . mainModel::encryption($rows['usuario_id']) . '/" class="btn btn-3d btn-success"><span class="fa fa-refresh"></span></a></td>
                                        <td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="usuario_id_del" value="' . mainModel::encryption($rows['usuario_id']) . '"> 
                                            <button type="submit" class="btn btn-3d btn-danger"><span class="fa fa-trash"></span>
                                            </button>
                                        </form>
                                        </td>
				</tr>';
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
            $tabla .= '<p class="text-right">Mostrando usuario ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* --- Fin Controlador paginador usuario --- */

    /* ------------- Controlador para eliminar usuario ----------------- */

    public function eliminar_usuario_controlador($id) {
        /* --- recibiendo id del usuario --- */
        $id = mainModel::decryption($_POST['usuario_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobando el usuario principal */
        if ($id == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No podemos eliminar el usuario principal",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que exista el usuario en la base de datos */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El usuario que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar los prestamos en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT solicitud_id FROM solicitud WHERE usuario_id='$id'");
        if ($check_indicador->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar este usuario, porque tiene una solicitud relacionada.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar este usuario",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_usuario = usuarioModelo::eliminar_usuario_modelo($id);

        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario Eliminado",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el usuario, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar usuario */

    /*     * ** Controlador para obtener los datos del usuario ******* */

    public function datos_usuario_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return usuarioModelo::datos_usuario_modelo($tipo, $id);
    }

    /* Fin controlador datos usuario */

    /*     * ****  Controlador para editar usuario ***** */

    public function actualizar_usuario_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['usuario_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar el usuario mediante el ID en la BD
        $check_user = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usuario_id='$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el usuario en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        $dni = mainModel::limpiar_cadena($_POST['usuario_dni_up']);
        $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
        $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_up']);
        $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_up']);
        $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_up']);

        $usuario = mainModel::limpiar_cadena($_POST['usuario_usuario_up']);
        $email = mainModel::limpiar_cadena($_POST['usuario_email_up']);

         //Agregar Fecha de Nacimiento y Genero
         $genero = mainModel::limpiar_cadena($_POST['usuario_genero_up']);
         $fecha_nacimiento = mainModel::limpiar_cadena($_POST['usuario_fecha_nacimiento_up']);

        //Para el archivo con la imagen de perfil
        $origen = $_FILES['multimedia_perfil_up']['tmp_name'];
        $tamano_archivo = $_FILES['multimedia_perfil_up']['size'];
        $nombre_archivo = $_FILES['multimedia_perfil_up']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);

        if (isset($_POST['usuario_estado_up'])) {
            $estado = mainModel::limpiar_cadena($_POST['usuario_estado_up']);
        } else {
            $estado = $campos['usuario_estado'];
        }

        if (isset($_POST['usuario_privilegio_up'])) {
            $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_up']);
        } else {
            $privilegio = $campos['usuario_privilegio'];
        }

        if (isset($_POST['usuario_tipo_up'])) {
            $tipo = mainModel::limpiar_cadena($_POST['usuario_tipo_up']);
        } else {
            $tipo = $campos['usuario_tipo'];
        }

        $admin_usuario = mainModel::limpiar_cadena($_POST['usuario_admin']);
        $admin_clave = mainModel::limpiar_cadena($_POST['clave_admin']);

        $tipo_cuenta = mainModel::limpiar_cadena($_POST['tipo_cuenta']);

        /* --------  Comprobar los campos vacios  -------- */
        if ($genero == "" || $fecha_nacimiento == "" || $dni == "" || $nombre == "" || $apellido == "" || $usuario == "" || $admin_usuario == "" || $admin_clave == "") {
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
        /* Comprobando la foto perfil */
        if ($nombre_archivo != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre_archivo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El nombre del archivo para la imagen de perfil no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            //Si pasa hasta aqui agregar todo el proceso para subir la imagen del avatar al servidor
            //Con respecto a la imagen de perfil del jugador
            //Verificar que la extension del archivo sea permitida
            $extension_archivo = explode(".", $nombre_archivo, 2);
            $extension = $extension_archivo[1]; //Obtengo la extension del archivo
            $ext_permitida = "";
            //obtener las extensiones permitidas
            $extension_permitidas = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='extension_permitida'");
            if ($extension_permitidas->rowCount() > 0) {
                $extension_permitidas = $extension_permitidas->fetch();
                $ext_permitida = $extension_permitidas['configuracion_valor'];
            }

            $rs_comparacion = strpos($ext_permitida, $extension);
            if ($rs_comparacion === false) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El tipo de documento imagen perfil no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }


            //Verificar que el tamaño del archivo no supere el tamaño maximo permitido
            $tamano_permitido = 0;
            $rs_tamano = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='size_permitido'");
            if ($rs_tamano->rowCount() > 0) {
                $rs_tamano = $rs_tamano->fetch();
                $tamano_permitido = $rs_tamano['configuracion_valor'];
            }
            if (intval($tamano_archivo) > intval($tamano_permitido)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El tamaño del Archivo es: " . $tamano_archivo . " y supera el maximo permitido que es: " . $tamano_permitido . ", intente nuevamente con un archivo menos pesado.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $nombre_archivo = time() . " " . $nombre_archivo;
            //declarar variable con la ruta y el nombre donde se va a colocar el archivo
            $destino = "../multimedia/$nombre_archivo";

            $foto_perfil = $nombre_archivo;
            //Subir el archivo al servidor
            //Subir el archivo al servidor con la imagen del perfil del jugador
            $upload = move_uploaded_file($origen, $destino); //retorna 1 si sube el archivo
            //sleep(2);
            if ($upload != 1) {
                //Mensaje para indicar que no se pudo hacer la carga del archivo al servidor
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No se pudo subir el archivo seleccionado al servidor. Por favor intente nuevamente.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        } else {
            $foto_perfil = $campos['usuario_imagen'];
        }


        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[0-9-]{6,20}", $dni)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El DNI no coincide con el formato solicitado",
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

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}", $apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Apellido no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Telefono no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La Direccion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{5,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de Usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{5,35}", $admin_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Tu Nombre de Usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $admin_clave)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Tu Clave no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $admin_clave = mainModel::encryption($admin_clave);

        //comprobar valores de privilegios
        if ($privilegio < 1 || $privilegio > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Privilegio no corresponde a un valor valido.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //comprobar valores de privilegios
        if ($tipo < 1 || $tipo > 4) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Tipo no corresponde a un valor valido.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($estado != "Activa" && $estado != "Deshabilitada") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El estado de la cuenta no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando DNI ------ */
        if ($dni != $campos['usuario_dni']) {

            $check_dni = mainModel::ejecutar_consulta_simple("SELECT usuario_dni FROM usuario WHERE usuario_dni='$dni'");
            if ($check_dni->rowCount() > 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El DNI ingresado ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /* ------  Comprobando Usuario ------ */
        if ($usuario != $campos['usuario_usuario']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre del Usuario ingresado ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /** Comprobando el correo electronico * */
        if ($email != $campos['usuario_email'] && $email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if ($check_email->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "El nuevo Correo electronico ingresado ya se encuentra registrado en el sistema",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Ha ingresado un correo electronico no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*         * * Comprobando claves ** */
        if ($_POST['usuario_clave_nueva_1'] != "" || $_POST['usuario_clave_nueva_2'] != "") {

            if ($_POST['usuario_clave_nueva_1'] != $_POST['usuario_clave_nueva_2']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Las nuevas claves ingresadas no coinciden",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {

                if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $_POST['usuario_clave_nueva_1']) || mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $_POST['usuario_clave_nueva_2'])) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "Las nuevas claves ingresadas no coinciden con el formato solicitado",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $clave = mainModel::encryption($_POST['usuario_clave_nueva_1']);
            }
        } else {
            $clave = $campos['usuario_clave'];
        }

        /*         * ***  Comprobar credenciales para actualizar los datos *** */
        if ($tipo_cuenta == "Propia") {
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_clave='$admin_clave' AND usuario_id='$id'");
        } else {
            session_start(['name' => 'TOR']);
            if ($_SESSION['privilegio_tor'] != 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No tienes los permisos necesarios para realizar esta operacion",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_clave='$admin_clave'");
        }

        if ($check_cuenta->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El nombre y clave de administrador no valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /** ** Preparando los datos para enviarlos al modelo*** */
        $datos_usuario_up = [
            "DNI" => $dni,
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "Telefono" => $telefono,
            "Direccion" => $direccion,
            "Email" => $email,
            "Usuario" => $usuario,
            "Clave" => $clave,
            "Estado" => $estado,
            "Privilegio" => $privilegio,
            "Tipo" => $tipo,
            "Imagen" => $foto_perfil,
            "Genero" => $genero,
            "Fecha" => $fecha_nacimiento,
            "ID" => $id
        ];

        if (usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador editar usuario */
}
