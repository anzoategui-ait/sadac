<?php

if ($peticionAjax) {
    require_once "../modelos/imagenModelo.php";
} else {
    require_once "./modelos/imagenModelo.php";
}

class imagenControlador extends imagenModelo {
       
    /* ------------- Controlador para agregar imagen ----------------- */

    public function agregar_imagen_controlador() {
        //Obtener datos del formulario
        $asignacion = mainModel::limpiar_cadena($_POST['imagen_asignacion_id_reg']);
        $origen = $_FILES['imagen_nombre_reg']['tmp_name'];
        $tamano_archivo = $_FILES['imagen_nombre_reg']['size'];
        $nombre_archivo = $_FILES['imagen_nombre_reg']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);

        //Comprobar que los campos obligatorios no esten vacios
        /* --------  Comprobar los campos vacios  -------- */
        if ($asignacion == "" || $nombre_archivo == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre_archivo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El nombre del archivo para la imagen no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Verificar que el nombre dado al archivo no se repita en la base de datos
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT imagen_id FROM imagen WHERE imagen_nombre='$nombre_archivo'");
        if ($check_nombre->rowCount() >= 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El nombre para el archivo que intenta ingresar, ya esta registrado para otro archivo, cambie el nombre he intentelo nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //Chequear que la asignacion este registrada en la base de datos
        $check_asignacion = mainModel::ejecutar_consulta_simple("SELECT asignacion_id FROM asignacion WHERE asignacion_id='$asignacion'");
        if ($check_asignacion->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La asignacion no esta registrada en la base de datos.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
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
                "Texto" => "El tipo de documento no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
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
        $destino = "../imagenes/$nombre_archivo";

        //Hacer el registro en la base de datos
        $datos_imagen_reg = [
            "Nombre" => $nombre_archivo,
            "Asignacion" => $asignacion
        ];

        $check_registro = imagenModelo::agregar_imagen_modelo($datos_imagen_reg);

        if ($check_registro->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudieron guardar los datos en la base de datos. Por favor intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Subir el archivo al servidor
        $upload = move_uploaded_file($origen, $destino); //retorna 1 si sube el archivo

        if ($upload == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Registro Realizado",
                "Texto" => "Se ha subido la imagen al servidor de manera satisfactoria.",
                "Tipo" => "success"
            ];
        } else {
            //Eliminar el registro de la base de datos
            $rs_eliminar = mainModel::ejecutar_consulta_simple("DELETE FROM imagen WHERE imagen_nombre='$nombre_archivo'");
            if ($rs_eliminar->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No se pudo eliminar de la base de datos, el registro correspondiente a este archivo imagen.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            //Mensaje para indicar que no se pudo hacer la carga del archivo al servidor 
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo subir el archivo seleccionado al servidor. Por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */

    /* ---- Controlador paginar usuarios ----- */

    public function paginador_imagen_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM imagen WHERE imagen_nombre LIKE '%$busqueda%' OR imagen_archivo LIKE '%$busqueda%' OR imagen_extension LIKE '%$busqueda%' ORDER BY imagen_nombre ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM imagen ORDER BY imagen_nombre ASC LIMIT $inicio,$registros";
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
					<th>#</th><th>NOMBRE</th><th>ARCHIVO</th>
					<th>EXTENSION</th>';
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
                $tabla .= '<tr class="text-center" >
					<td>' . $contador . '</td>'
                        . '<td>' . $rows['imagen_nombre'] . '</td>
                                        <td>' . $rows['imagen_archivo'] . '</td>'
                        . '<td>' . $rows['imagen_extension'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td>
                                         <a href="' . SERVERURL . 'imagen-update/' . mainModel::encryption($rows['imagen_id']) . '/" class="btn btn-3d btn-success"><span class="fa fa-refresh"></span></a>
                                             </td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td><form class="FormularioAjax" action="' . SERVERURL . 'ajax/imagenAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="imagen_id_del" value="' . mainModel::encryption($rows['imagen_id']) . '"> 
                                            <button type="submit" class="btn btn-3d btn-danger">
                                            <span class="fa fa-trash"></span>
                                            </button>
                                        </form>
                                        </td>';
                }


                $tabla .= ' </tr>';

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
            $tabla .= '<p class="text-right">Mostrando imagen ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* --- Fin Controlador paginador usuario --- */

    /* ------------- Controlador para eliminar imagen ----------------- */

    public function eliminar_imagen_controlador($id) {
        /* --- recibiendo id de la club --- */
        $id = mainModel::decryption($_POST['imagen_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la club en la base de datos */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT imagen_id FROM imagen WHERE imagen_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El archivo imagen que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que esta imagen no este ya relacionada con algun documento */
        /**/
        /**/
        /**/
        /**/
        /**/


        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar este archivo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_imagen = imagenModelo::eliminar_imagen_modelo($id);

        if ($eliminar_imagen->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Archivo Eliminado",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el archivo seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar club */

    /*     * * Controlador para obtener los datos de la club ******* */

    public function datos_imagen_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return imagenModelo::datos_imagen_modelo($tipo, $id);
    }

    /* Fin controlador datos club */

    /*     * ***  Controlador para editar usuario ***** */

    public function actualizar_imagen_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['imagen_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar el club mediante el ID en la BD
        $check_user = mainModel::ejecutar_consulta_simple("SELECT * FROM imagen WHERE imagen_id='$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el archivo imagen seleccionado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        //Obtener datos del formulario
        $nombre = mainModel::limpiar_cadena($_POST['imagen_nombre_up']);
        $origen = $_FILES['imagen_archivo_up']['tmp_name'];
        $tamano_archivo = $_FILES['imagen_archivo_up']['size'];
        $nombre_archivo = $_FILES['imagen_archivo_up']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);

        //Comprobar que los campos obligatorios no esten vacios
        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre para el archivo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($nombre_archivo != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}", $nombre_archivo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "..El nombre del archivo no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        
        if ($nombre_archivo == "") {
            $nombre_archivo = $campos['imagen_archivo'];
            $extension_archivo = explode(".", $nombre_archivo, 2);
            $extension = $extension_archivo[1]; //Obtengo la extension del archivo
        } else {
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
                "Texto" => "El tipo de documento no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
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
        $destino = "../imagen/$nombre_archivo";
           
            
        }

        

        /* ------  Comprobando que el Numero de Telefono a Editar ya no este registrado en el sistema ------ */
        if ($nombre != $campos['imagen_nombre']) {

            $check_nombre = mainModel::ejecutar_consulta_simple("SELECT imagen_nombre FROM imagen WHERE imagen_nombre='$nombre'");
            if ($check_nombre->rowCount() > 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre que intenta ingresar ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*         * ** Preparando los datos para enviarlos al modelo*** */
        $datos_imagen_up = [
            "Nombre" => $nombre,
            "Archivo" => $nombre_archivo,
            "Extension" => $extension,
            "ID" => $id
        ];

        if (imagenModelo::actualizar_imagen_modelo($datos_imagen_up)) {
            
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($nombre_archivo != $campos['imagen_archivo']) {
            //Codigo para subir el archivo
            //Subir el archivo al servidor
            $upload = move_uploaded_file($origen, $destino); //retorna 1 si sube el archivo

            if ($upload == 1) {
                $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Actualizacion Exitosa",
                    "Texto" => "Los datos fueron actualizados satisfactoriamente.",
                    "Tipo" => "success"
                ];
            } else {
                //Mensaje para indicar que no se pudo hacer la carga del archivo al servidor 
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No se pudo subir el archivo seleccionado al servidor. Por favor intente nuevamente.",
                    "Tipo" => "error"
                ];
            }
        } else {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Actualizacion Exitosa",
                "Texto" => "Los datos fueron actualizados satisfactoriamente.",
                "Tipo" => "success"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador editar club */
}

