<?php
if ($peticionAjax) {
    require_once "../modelos/indicadorModelo.php";
} else {
    require_once "./modelos/indicadorModelo.php";
}

class indicadorControlador extends indicadorModelo {

    /** Controlador para agregar una indicador **/
    public function agregar_indicador_controlador() {

        $nombre = mainModel::limpiar_cadena($_POST['indicador_nombre_reg']);

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

        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del indicador no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando que el nombre de la indicador sea unica ------ */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT indicador_nombre FROM indicador WHERE indicador_nombre='$nombre'");
        if ($check_nombre->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del indicador que acaba de ingresar, ya se encuentra registrada en el sistema, por favor cambie el nombre y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_indicador_reg = [
            "Nombre" => $nombre
        ];

        /* -- Agregar el registro -- */
        $agregar_indicador = indicadorModelo::agregar_indicador_modelo($datos_indicador_reg);
        if ($agregar_indicador->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

           //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nuevo indicador: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Indicador Registrado",
                "Texto" => "Los datos del nuevo indicador han sido registrados satisfactoriamente.",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar la siguiente indicador:". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para esta nueva indicador, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

    /** Controlador paginar indicadors **/
    public function paginador_indicador_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM indicador WHERE indicador_nombre LIKE '%$busqueda%' ORDER BY indicador_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de indicador";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM indicador ORDER BY indicador_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de indicador";
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
					<th>INDICADOR</th>';

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
                                        <td class="text-left">' . $rows['indicador_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'indicador-update/' . mainModel::encryption($rows['indicador_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/indicadorAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="indicador_id_del" value="' . mainModel::encryption($rows['indicador_id']) . '">
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
                $tabla .= '<tr class="text-center"><td colspan="4"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="4">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando indicador ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador indicador*/

    /** Controlador para eliminar indicador **/
    public function eliminar_indicador_controlador($id) {
        /* --- recibiendo id de la indicador --- */
        $id = mainModel::decryption($_POST['indicador_id_del']);
        $id = mainModel::limpiar_cadena($id);



        /* Comprobar que exista la indicador en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT indicador_id, indicador_nombre FROM indicador WHERE indicador_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La indicador que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_indicador = $check_nombre['indicador_nombre'];
        }

        /* Comprobar que la indicador no este relacionada a alguna actividad... */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT actividad_id FROM actividad WHERE indicador_id='$id'");
         if ($check_indicador->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Este indicador no se puede eliminar, porque ya esta relacionada a una actividad.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar este indicador",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_indicador = indicadorModelo::eliminar_indicador_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino el siguiente indicador: " . $nombre_indicador;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Indicador Eliminado",
                "Texto" => "El indicador ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente indicador: " . $nombre_indicador;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la indicador seleccionada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador eliminar indicador*/


    /** Controlador para obtener los datos de la indicador **/
    public function datos_indicador_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return indicadorModelo::datos_indicador_modelo($tipo, $id);
    } /*Fin Controlador obtener datos*/

    /* Controlador para editar indicador */
    public function actualizar_indicador_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['indicador_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la indicador mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM indicador WHERE indicador_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el indicador en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        $nombre = mainModel::limpiar_cadena($_POST['indicador_nombre_up']);

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

        /* ------  Vrificando integridad de los campos  ------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre la indicador no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //Comprobar que el nombre a ingresar no este ya registrador en el sistema
        if ($nombre != $campos['indicador_nombre']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT indicador_nombre FROM indicador WHERE indicador_nombre='$nombre'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre de la indicador ingresada ya se encuentra registrada en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para editar este indicador",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando los datos para enviarlos al modelo
        $datos_indicador_up = [
            "Nombre"=>$nombre,
            "ID"=>$id
        ];

        if(indicadorModelo::actualizar_indicador_modelo($datos_indicador_up)){

        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo el siguiente indicador: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos del indicador fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        }else{
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "No pudo actualizar el siguiente indicador: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos del indicador no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin Controlador editar indicador */

}
