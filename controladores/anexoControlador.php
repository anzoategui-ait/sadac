<?php

if ($peticionAjax) {
    require_once "../modelos/anexoModelo.php";
} else {
    require_once "./modelos/anexoModelo.php";
}

class anexoControlador extends anexoModelo {
    /* ------------- Controlador para agregar anexo ----------------- */

    public function agregar_anexo_controlador() {
        //Obtener datos del formulario con respecto al archivo de respaldo a subir
        $origen = $_FILES['anexo_archivo_reg']['tmp_name'];
        $tamano_archivo = $_FILES['anexo_archivo_reg']['size'];
        $nombre_archivo = $_FILES['anexo_archivo_reg']['name'];
        $nombre_archivo = mainModel::limpiar_cadena($nombre_archivo);
        //Obtener el resto de los datos del formulario
        $paso = mainModel::decryption($_POST['anexo_paso_reg']);
        $paso = mainModel::limpiar_cadena($paso);
        $nombre = mainModel::limpiar_cadena($_POST['anexo_nombre_reg']);


        //Comprobar que los campos obligatorios no esten vacios
        /* --------  Comprobar los campos vacios  -------- */
        if ($paso == "" || $nombre_archivo == "" || $nombre == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Verificar que el paso este registrado en el sistema
        $check_paso = mainModel::ejecutar_consulta_simple("SELECT paso_id FROM paso WHERE paso_id='$paso'");
        if($check_paso->rowCount()<=0){
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "El paso seleccionado no se encuetra registrado en el sistema, intente nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre_archivo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El nombre del archivo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El titulo del anexo no coincide con el formato solicitado",
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
        $extension_permitidas = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='extension_pago'");
        if ($extension_permitidas->rowCount() > 0) {
            $extension_permitidas = $extension_permitidas->fetch();
            $ext_permitida = $extension_permitidas['configuracion_valor'];
        }

        $rs_comparacion = strpos($ext_permitida, $extension);
        if ($rs_comparacion === false) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El documento de respaldo no coincide con el formato solicitado. Extension no permitida: " . $extension . " extensiones permitidas: " . $ext_permitida,
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
        $destino = "../anexos/$nombre_archivo";

        //Hacer el registro en la base de datos
        $datos_anexo_reg = [
            "Paso" => $paso,
            "Nombre" => $nombre,
            "Archivo" => $nombre_archivo
        ];

        $check_registro = anexoModelo::agregar_anexo_modelo($datos_anexo_reg);

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
         //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de un nuevo anexo: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Anexo Agregado",
                "Texto" => "Se ha realizado el registro del anexo, en el sistema.",
                "Tipo" => "success"
            ];
        } else {
          //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo agregar el siguiente anexo: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        
            //Eliminar el registro de la base de datos
            $rs_eliminar = mainModel::ejecutar_consulta_simple("DELETE FROM anexo WHERE anexo_archivo='$nombre_archivo'");
            if ($rs_eliminar->rowCount() <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No se pudo eliminar de la base de datos, el registro correspondiente a este archivo anexo.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            //Mensaje para indicar que no se pudo hacer la carga del archivo al servidor
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo subir el archivo de respaldo al servidor. Por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */

    /* ---- Controlador paginar usuarios ----- */

    public function paginador_anexo_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
                $consulta = "SELECT SQL_CALC_FOUND_ROWS anexo.anexo_id, anexo.anexo_nombre, anexo.anexo_archivo, paso.paso_nombre FROM anexo INNER JOIN paso ON anexo.paso_id=paso.paso_id WHERE anexo.anexo_nombre LIKE '%$busqueda%' OR anexo.anexo_archivo LIKE '%$busqueda%' OR paso.paso_nombre LIKE '%$busqueda%' ORDER BY anexo.anexo_id ASC LIMIT $inicio,$registros";

                // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de anexo";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            } else {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS anexo.anexo_id, anexo.anexo_nombre, anexo.anexo_archivo, paso.paso_nombre FROM anexo INNER JOIN paso ON anexo.paso_id=paso.paso_id ORDER BY anexo.anexo_id ASC LIMIT $inicio,$registros";

                 //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de anexos";
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
                    <th>TITULO ANEXO</th>
                    <th>PASO</th>
                    <th>ARCHIVO(ver)</th>';

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
					       <td>' . $contador . '</td>'
                        . '<td class="text-left">';

                        $tabla .=  $rows['anexo_nombre'] . '</td>' .
                          '<td>' . $rows['paso_nombre'] . '</td>
                           <td class="text-left">
                            <a href="' . SERVERURL . 'visor-anexos/' . mainModel::encryption($rows['anexo_id']) . '/" class="btn btn-primary" data-toggle="popover" data-trigger="hover" title="' . $rows['anexo_archivo'] . '" data-content="Descripcion">Visualizar Anexo</a>
                           </td>';

                if ($privilegio == 1) {
                    $tabla .= '<td><form class="FormularioAjax" action="' . SERVERURL . 'ajax/anexoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="anexo_id_del" value="' . mainModel::encryption($rows['anexo_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando anexo ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* --- Fin Controlador paginador usuario --- */

    /* ------------- Controlador para eliminar anexo ----------------- */

    public function eliminar_anexo_controlador($id) {
        /* --- recibiendo id de la club --- */
        $id = mainModel::decryption($_POST['anexo_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la club en la base de datos */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT anexo_id FROM anexo WHERE anexo_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El archivo anexo que intenta eliminar no esta registrado en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para eliminar este archivo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //Antes de eliminar comprobar que no este relacionado en otra tabla.

        $eliminar_anexo = anexoModelo::eliminar_anexo_modelo($id);

        if ($eliminar_anexo->rowCount() == 1) {
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

    public function datos_anexo_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return anexoModelo::datos_anexo_modelo($tipo, $id);
    }

    /* Fin controlador datos club */

}
