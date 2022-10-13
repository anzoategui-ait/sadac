<?php
if ($peticionAjax) {
    require_once "../modelos/direccionModelo.php";
} else {
    require_once "./modelos/direccionModelo.php";
}

class direccionControlador extends direccionModelo
{

    /* ------------- Controlador para agregar ----------------- */
    public function agregar_direccion_controlador()
    {
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['direccion_nombre_reg']);
        $gabinete = mainModel::decryption($_POST['gabinete_nombre_reg']);
        $gabinete = mainModel::limpiar_cadena($gabinete);
        // La imagen sera opcional
        $origen = $_FILES['multimedia_perfil_reg']['tmp_name'];
        $tamano_archivo = $_FILES['multimedia_perfil_reg']['size'];
        $nombre_archivo = $_FILES['multimedia_perfil_reg']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);

        /* -------- Comprobar los campos vacios -------- */
        if ($nombre == "" || $gabinete == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------ Vrificando integridad de los campos ------- */
        /* Comprobar nombre */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,300}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la direccion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
         if (mainModel::verificar_datos("[0-9]{1,11}", $gabinete)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Gabinete no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que el gabiente a registrar exista en la BD */
        $check_gabinete = mainModel::ejecutar_consulta_simple("SELECT gabinete_id FROM gabinete WHERE gabinete_id='$gabinete' LIMIT 0,1");
        if ($check_gabinete->rowCount() <=0 ) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Gabinete que acaba de seleccionar, no se encuentra registrado en la base de datos, por favor seleccione otro y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Comprobando que el nombre de la direccion sea unico y que no se repita el registro en el sistema */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT direccion_nombre FROM direccion WHERE direccion_nombre='$nombre'");
        if ($check_nombre->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la Direccion que acaba de ingresar, ya se encuentra registrada en el sistema, por favor cambie el nombre y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobando la foto perfil de la direccion*/
        if ($nombre_archivo != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9Ã¡Ã©Ã­Ã³ÃºÃÃ‰ÃÃ“ÃšÃ±Ã‘().,#\-_ ]{2,200}", $nombre_archivo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El nombre de la imagen para la direccion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            
            //Subir el Archivo Con Imagen al Servidor
             /* Subir foto de perfil al servidor */
        // Con respecto a la imagen de perfil dela direccion
        // Verificar que la extension del archivo sea permitida
        $extension_archivo = explode(".", $nombre_archivo, 2);
        $extension = $extension_archivo[1]; // Obtengo la extension del archivo
        $ext_permitida = "";
        // obtener las extensiones permitidas
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
                "Texto" => "El tipo de documento imagen no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Verificar que el tamaño del archivo no supere el tamaño maximo permitido
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
        // declarar variable con la ruta y el nombre donde se va a colocar el archivo
        $destino = "../imagenes/$nombre_archivo";

        $foto_perfil = $nombre_archivo;
        // Subir el archivo al servidor
        // Subir el archivo al servidor con la imagen del perfil del direccion
        $upload = move_uploaded_file($origen, $destino); // retorna 1 si sube el archivo
                                                         // sleep(2);
        if ($upload != 1) {
            // Mensaje para indicar que no se pudo hacer la carga del archivo al servidor
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo subir el archivo seleccionado al servidor. Por favor intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* Fin de subir foto al servidor */
            
        } else {
        //Sino es que viene vacio agregar una imagen default que se registrara en la base de datos
           $foto_perfil="default.jpg";
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_direccion_reg = [
            "Nombre" => $nombre,
            "Gabinete" => $gabinete,
            "Imagen" => $foto_perfil
        ];

        /* -- Agregar el registro -- */
        $agregar_direccion = direccionModelo::agregar_direccion_modelo($datos_direccion_reg);
        if ($agregar_direccion->rowCount() == 1) { // rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

              //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nueva direccion: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Direccion Registrada",
                "Texto" => "Los datos del direccion han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
        
        //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar la siguiente direccion:". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar dicho direccion, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */


    /* ------------- Controlador para eliminar ----------------- */
    public function eliminar_direccion_controlador($id)
    {
        /* --- recibiendo id del posicion --- */
        $id = mainModel::decryption($_POST['direccion_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el posicion en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT direccion_id, direccion_nombre FROM direccion WHERE direccion_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El direccion que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_indicador = $check_indicador->fetch();
         $nombre_categoria = $check_indicador['direccion_nombre'];
        }

         /* Dejo para codificar luego, comprobar que no tenga usuarios registrados y que esten utilizando la direccion que se quiere eliminar */
         $check_direccion = mainModel::ejecutar_consulta_simple("SELECT usuario_cargo.usuario_cargo_id FROM usuario_cargo INNER JOIN cargo ON usuario_cargo.cargo_id = cargo.cargo_id WHERE cargo.direccion_id='$id' LIMIT 1");
         if ($check_direccion->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar esta direccion, porque esta relacionada a un usuario.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* Comprobar privilegios del usuario que esta intentado eliminar */
        session_start([
            'name' => 'TOR'
        ]);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar este indicador",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_indicador = direccionModelo::eliminar_direccion_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {
        
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino la siguiente direccion: " . $nombre_categoria;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Direccion Eliminada",
                "Texto" => "El registro correspondiente al nombre de la direccion seleccionada, ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar la siguiente direccion: " . $nombre_categoria;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el nombre de la direccion, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar */

    /* * ** Controlador para obtener los datos ******* */
    public function datos_direccion_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return direccionModelo::datos_direccion_modelo($tipo, $id);
    }

    /* Fin controlador datos */

    /* *** Controlador para editar *** */
    public function actualizar_direccion_controlador()
    {
        // Recibiendo el id
        $id = mainModel::decryption($_POST['direccion_id_up']);
        $id = mainModel::limpiar_cadena($id);

        // Comprobar el posicion mediante el ID en la BD
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT * FROM direccion WHERE direccion_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el direccion en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_indicador->fetch(); // se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        /* Inicio de Codigo */
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['direccion_nombre_up']);
        
        $gabinete = mainModel::decryption($_POST['gabinete_nombre_up']);
        $gabinete = mainModel::limpiar_cadena($gabinete);

        /* -------- Comprobar los campos vacios -------- */
        if ($nombre == "" || $gabinete == "") {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
         if (mainModel::verificar_datos("[0-9]{1,11}", $gabinete)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Gabinete no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que el gabiente a registrar exista en la BD */
        $check_gabinete = mainModel::ejecutar_consulta_simple("SELECT gabinete_id FROM gabinete WHERE gabinete_id='$gabinete' LIMIT 0,1");
        if ($check_gabinete->rowCount() <=0 ) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Gabinete que acaba de seleccionar, no se encuentra registrado en la base de datos, por favor seleccione otro y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------ Vrificando integridad de los campos ------- */
 /* Comprobar nombre */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,300}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la direccion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        //Agregar para subir el archivo
        $origen = $_FILES['multimedia_perfil_up']['tmp_name'];
        $tamano_archivo = $_FILES['multimedia_perfil_up']['size'];
        $nombre_archivo = $_FILES['multimedia_perfil_up']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);

        /* Comprobando la foto perfil */
        if ($nombre_archivo != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9Ã¡Ã©Ã­Ã³ÃºÃÃ‰ÃÃ“ÃšÃ±Ã‘().,#\-_ ]{2,200}", $nombre_archivo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La foto de perfil no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            //Si llega aqui es porque valido el nombre del archivo, entonces se procede a subir el archivo
            /* Subir foto de perfil al servidor */
            // Con respecto a la imagen de perfil del direccion
            // Verificar que la extension del archivo sea permitida
            $extension_archivo = explode(".", $nombre_archivo, 2);
            $extension = $extension_archivo[1]; // Obtengo la extension del archivo
            $ext_permitida = "";
            // obtener las extensiones permitidas
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
                    "Texto" => "El tipo de documento imagen para el torneo no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            // Verificar que el tamaño del archivo no supere el tamaño maximo permitido
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
            // declarar variable con la ruta y el nombre donde se va a colocar el archivo
            $destino = "../imagenes/$nombre_archivo";

            $imagen = $nombre_archivo;
            // Subir el archivo al servidor
            // Subir el archivo al servidor con la imagen del perfil del direccion
            $upload = move_uploaded_file($origen, $destino); // retorna 1 si sube el archivo
            // sleep(2);
            if ($upload != 1) {
                // Mensaje para indicar que no se pudo hacer la carga del archivo al servidor
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No se pudo subir el archivo seleccionado al servidor. Por favor intente nuevamente.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            /* Fin de subir foto al servidor */

        } else {
            $imagen = $campos['direccion_imagen'];
        }

        /* ------ Comprobar que el numero de cedula y el numero de pasaporte no se repitan en la bd ------ */
        if ($nombre != $campos['direccion_nombre']) {
            $check_cedula = mainModel::ejecutar_consulta_simple("SELECT direccion_id FROM direccion WHERE direccion_nombre='$nombre'");
            if ($check_cedula->rowCount() > 0) { // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre que intenta registrar, ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        /* *** Comprobar credenciales para actualizar los datos *** */
        session_start([
            'name' => 'TOR'
        ]);
        if (($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 2)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos necesarios para realizar esta operacion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_direccion_up = [
            "Nombre" => $nombre,
            "Gabinete" => $gabinete,
            "Imagen" => $imagen,
            "ID" => $id
        ];

        /* Fin de Codigo */

        if (direccionModelo::actualizar_direccion_modelo($datos_direccion_up)) {
        
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo la siguiente direccion: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "No puso actualizar la siguiente direccion: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador editar posicion */

    /** Controlador paginar categorias **/
    public function paginador_direccion_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS direccion.direccion_id, direccion.direccion_nombre, direccion.direccion_imagen, gabinete.gabinete_nombre FROM direccion INNER JOIN gabinete ON direccion.gabinete_id = gabinete.gabinete_id WHERE gabinete.gabinete_nombre LIKE '%$busqueda%' OR direccion.direccion_nombre LIKE '%$busqueda%' OR direccion.direccion_imagen LIKE '%$busqueda%' ORDER BY gabinete.gabinete_nombre, direccion.direccion_nombre ASC LIMIT $inicio,$registros";

              //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de direcciones";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS direccion.direccion_id, direccion.direccion_nombre, direccion.direccion_imagen, gabinete.gabinete_nombre FROM direccion INNER JOIN gabinete ON direccion.gabinete_id = gabinete.gabinete_id ORDER BY gabinete.gabinete_nombre, direccion.direccion_nombre ASC LIMIT $inicio,$registros";
            
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de direcciones";
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
					<th>DIRECCION</th><th>GABINETE</th>
                    <th>IMAGEN</th>';

        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '<th>ACTUALIZAR</th>';
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
                                        <td class="text-left">' . $rows['direccion_nombre'] . '</td>
                                            <td class="text-left">' . $rows['gabinete_nombre'] . '</td>
                                        <td class="text-left">' . $rows['direccion_imagen'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'direccion-update/' . mainModel::encryption($rows['direccion_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/direccionAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="direccion_id_del" value="' . mainModel::encryption($rows['direccion_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando direccion ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador direccion*/

}
