<?php
if ($peticionAjax) {
    require_once "../modelos/activoUsuarioModelo.php";
} else {
    require_once "./modelos/activoUsuarioModelo.php";
}

class activoUsuarioControlador extends activoUsuarioModelo
{

    /* ------------- Controlador para agregar ----------------- */
    public function agregar_activo_usuario_controlador()
    {
        
        
            
            
        // Campos obligatorios
        $codigo = mainModel::limpiar_cadena($_POST['codigo_equipo_reg']);
        $cedula = mainModel::limpiar_cadena($_POST['cedula_usuario_reg']);
        $concepto = mainModel::limpiar_cadena($_POST['descripcion_reg']);
        $tipo = mainModel::limpiar_cadena($_POST['tipo_reg']);
        $fecha = mainModel::solo_fecha();
        
      

        /* -------- Comprobar los campos vacios -------- */
        if ($codigo == "" || $cedula == "" || $concepto == ""|| $tipo == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
         if (mainModel::verificar_datos("[a-zA-Z0-9- ]{1,70}", $codigo)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El CODIGO de BARRAS no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
         if (mainModel::verificar_datos("[0-9-]{6,20}", $cedula)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Cedula no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar nombre */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}", $concepto)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La descripcion de la activoUsuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Comprobar nombre de la categoria*/
        if ($tipo!=1 && $tipo != 2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El tipo de relacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
         
        
   
      
        /* Comprobar que sea una cedula valida */
        $check_cedula = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_dni='$cedula'");
        if ($check_cedula->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque la cedula ingresada no pertenece a ningun usuario registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Comprobar que la indicador si este registrada en la base de datos */
        $check_codigo = mainModel::ejecutar_consulta_simple("SELECT producto_id FROM producto WHERE producto_codigo='$codigo'");
        if ($check_codigo->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque el codigo ingresado no pertenece a ningun activo registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Comprobar que la relacion activo usuario no se repita en el sistema 
        $check_activoUsuario = mainModel::ejecutar_consulta_simple("SELECT activo_usuario_status_id FROM activo_usuario_status WHERE producto_codigo='$codigo' AND usuario_cedula='$cedula' AND estado='$tipo'");
        if ($check_activoUsuario->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Para hacer este cambio primero debe cambiar el estado de vinculado a desvinculado o viceversa",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } */
        
        /* -- Comprobar que el activo no este relacionado a otro usuario -- */
        if($tipo==1){
        $check_activo = mainModel::ejecutar_consulta_simple("SELECT activo_usuario_status_id FROM activo_usuario_status WHERE producto_codigo='$codigo' AND estado='1'");
        if($check_activo->rowCount()>0){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede hacer la siguiente relacion, porque el activo que intenta relacionar esta vinculado a un usuario.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        }
        
        if($tipo==2){
        $check_activoUsuario = mainModel::ejecutar_consulta_simple("SELECT activo_usuario_status_id FROM activo_usuario_status WHERE producto_codigo='$codigo' AND usuario_cedula='$cedula' AND estado='$tipo'");
        if ($check_activoUsuario->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Para hacer este cambio primero debe cambiar el estado de desvinculado a vinculado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        }
            

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_activoUsuario_reg = [
            "Codigo" => $codigo,
            "Cedula" => $cedula,
            "Concepto" => $concepto,
            "Tipo" => $tipo,
            "Fecha" => $fecha
        ];

        /* -- Agregar el registro -- */
        $agregar_activoUsuario = activoUsuarioModelo::agregar_activo_usuario_modelo($datos_activoUsuario_reg);
        
        /*--- agregar relacion usuario estado ---*/
        $datos_relacion_reg = [
            "Codigo" => $codigo,
            "Cedula" => $cedula,
            "Tipo" => $tipo
        ];
        //chequear si existe la relacion activo -  usuario
        $check_rel = mainModel::ejecutar_consulta_simple("SELECT activo_usuario_status_id FROM activo_usuario_status WHERE usuario_cedula='$cedula' AND producto_codigo='$codigo'");
        
        if($check_rel->rowCount() <= 0){
            //respuesta es si, agregar
            $agregar = activoUsuarioModelo::activo_usuario_modelo($datos_relacion_reg);
            
        }else{
            //respuesta si es no, actualizar
            $actualizar = activoUsuarioModelo::actualizar_activo_usuario_modelo($datos_relacion_reg);
        }
       
   
        
        
        if ($agregar_activoUsuario->rowCount() == 1) { // rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

              //Para agregar bitacora
          /* session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nueva activoUsuario: ". $codigo . ' - ' . $cedula;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

*/
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Relacion Registrada",
                "Texto" => "Los datos de la relacion han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {

        //Para agregar bitacora
       /*    session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar la siguiente activoUsuario:". $codigo . ' - ' . $cedula;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");
*/

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar dicha relacion, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */


    /* ------------- Controlador para eliminar ----------------- */
    public function eliminar_activo_usuario_controlador($id)
    {
        /* --- recibiendo id del posicion --- */
        $id = mainModel::decryption($_POST['relacion_activo_usuario_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el posicion en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT activo_usuario_status_id FROM activo_usuario_status WHERE activo_usuario_status_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La relacion que intenta eliminar no se encuentra almacenada en el sistema, por favor, intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } 

        /* Dejo para codificar luego, comprobar que este registro no este registrado en otras tablas */
       
        /* Comprobar privilegios del usuario que esta intentado eliminar */
        session_start([
            'name' => 'TOR'
        ]);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar esta relacion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_indicador = activoUsuarioModelo::eliminar_activo_usuario_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {

        
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Relacion Eliminada",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el registro, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar */

    /* * ** Controlador para obtener los datos ******* */
    public function datos_activoUsuario_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return activoUsuarioModelo::datos_activoUsuario_modelo($tipo, $id);
    }

    /* Fin controlador datos */

    /* *** Controlador para editar *** */
    public function actualizar_activoUsuario_controlador()
    {
        // Recibiendo el id
        $id = mainModel::decryption($_POST['activoUsuario_id_up']);
        $id = mainModel::limpiar_cadena($id);

        // Comprobar el posicion mediante el ID en la BD
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT * FROM activoUsuario WHERE activoUsuario_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el activoUsuario en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_indicador->fetch(); // se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        /* Inicio de Codigo */
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['activoUsuario_nombre_up']);
        $descripcion = mainModel::limpiar_cadena($_POST['activoUsuario_descripcion_up']);
        $categoria = mainModel::decryption($_POST['categoria_nombre_up']);
        $categoria = mainModel::limpiar_cadena($categoria);
        $indicador = mainModel::decryption($_POST['indicador_nombre_up']);
        $indicador = mainModel::limpiar_cadena($indicador);

        /* -------- Comprobar los campos vacios -------- */
        if ($nombre == "" || $descripcion == "" || $categoria == ""|| $indicador == "") {

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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la activoUsuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
           /* Comprobar nombre */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La descripcion de la activoUsuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar nombre */
        if (mainModel::verificar_datos("[0-9]{1,11}", $categoria)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La categoria de la activoUsuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[0-9]{1,11}", $indicador)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El indicador de la activoUsuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que la categoria si este registrada en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
        if ($check_nombre->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque la categoria que acaba de seleccionar no se encuentra registrada en el sistema, por favor, verifique y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT indicador_id FROM indicador WHERE indicador_id='$indicador'");
        if ($check_indicador->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque el indicador que acaba de seleccionar no se encuentra registrada en el sistema, por favor, verifique y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
           /* ------ Comprobar que el numero de cedula y el numero de pasaporte no se repitan en la bd ------ */
        if ($nombre != $campos['activoUsuario_nombre']) {
            $check_cedula = mainModel::ejecutar_consulta_simple("SELECT activoUsuario_id FROM activoUsuario WHERE activoUsuario_nombre='$nombre'");
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
            // Con respecto a la imagen de perfil del activoUsuario
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
            // Subir el archivo al servidor con la imagen del perfil del activoUsuario
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
            $imagen = $campos['activoUsuario_imagen'];
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
        $datos_activoUsuario_up = [
            "Nombre" => $nombre,
            "Categoria" => $categoria,
            "Imagen" => $imagen,
            "Descripcion" => $descripcion,
            "Indicador" => $indicador,
            "ID" => $id
        ];

        /* Fin de Codigo */

        if (activoUsuarioModelo::actualizar_activoUsuario_modelo($datos_activoUsuario_up)) {

         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo la siguiente activoUsuario: " . $nombre;
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
           $accion_bitacora = "No puso actualizar la siguiente activoUsuario: " . $nombre;
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
    public function paginador_activo_usuario_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS usuario.usuario_nombre, usuario.usuario_apellido, producto.producto_nombre, producto.producto_codigo, activo_usuario_status.activo_usuario_status_id, activo_usuario_status.estado FROM activo_usuario_status INNER JOIN usuario ON usuario.usuario_dni = activo_usuario_status.usuario_cedula INNER JOIN producto ON activo_usuario_status.producto_codigo = producto.producto_codigo WHERE producto.producto_nombre LIKE '%$busqueda%' OR producto.producto_codigo LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR activo_usuario_status.estado LIKE '%$busqueda%' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

         

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS usuario.usuario_nombre, usuario.usuario_apellido, producto.producto_codigo, producto.producto_nombre, activo_usuario_status.activo_usuario_status_id, activo_usuario_status.estado FROM activo_usuario_status INNER JOIN usuario ON usuario.usuario_dni = activo_usuario_status.usuario_cedula INNER JOIN producto ON activo_usuario_status.producto_codigo = producto.producto_codigo ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";

         

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
                    <th>USUARIO</th>
                    <th>ACTIVO</th>
                    <th>CODIGO</th>
                    <th>ESTADO</th>';

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
                if($rows['estado']==1){$estado_es="VINCULADO";}
                if($rows['estado']==2){$estado_es="DESVINCULADO";}
                
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ',' . $rows['usuario_apellido'] . '</td>
                                        <td class="text-left">' . $rows['producto_nombre'] . '</td>
                                            <td class="text-left">' . $rows['producto_codigo'] . '</td>
                                        <td class="text-left">' . $estado_es  . '</td>';
                                       

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/activoUsuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="relacion_activo_usuario_id_del" value="' . mainModel::encryption($rows['activo_usuario_status_id']) . '">
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
                $tabla .= '<tr class="text-center"><td colspan="7"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="7">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando activoUsuario ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador activoUsuario*/

}
