<?php
if ($peticionAjax) {
    require_once "../modelos/pasoModelo.php";
} else {
    require_once "./modelos/pasoModelo.php";
}

class pasoControlador extends pasoModelo
{
    
    

    /* ------------- Controlador para agregar ----------------- */
    public function agregar_paso_controlador()
    {
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['paso_nombre_reg']);
        $duracion = mainModel::limpiar_cadena($_POST['paso_duracion_reg']);
        $actividad = mainModel::decryption($_POST['actividad_nombre_reg']);
        $actividad = mainModel::limpiar_cadena($actividad);

        /* -------- Comprobar los campos vacios -------- */
        if ($nombre == "" || $duracion == "" || $actividad == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La descripcion de este paso no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar nombre */
        if (mainModel::verificar_datos("[0-9]{1,11}", $duracion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La duracion de este paso no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar nombre */
        if (mainModel::verificar_datos("[0-9]{1,11}", $actividad)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La actividad de la paso no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que la actividad si este registrada en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT actividad_id FROM actividad WHERE actividad_id='$actividad'");
        if ($check_nombre->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque la actividad que acaba de seleccionar no se encuentra registrada en el sistema, por favor, verifique y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que el nombre de la paso no se repita en la base de datos */
        $check_paso = mainModel::ejecutar_consulta_simple("SELECT paso_id FROM paso WHERE paso_nombre='$nombre'");
        if ($check_paso->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Ya hay una descripcion similar, para otro paso, verifique y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_paso_reg = [
            "Nombre" => $nombre,
            "Duracion" => $duracion,
            "Actividad" => $actividad
        ];

        /* -- Agregar el registro -- */
        $agregar_paso = pasoModelo::agregar_paso_modelo($datos_paso_reg);
        if ($agregar_paso->rowCount() == 1) { // rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

              //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de un nuevo paso: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Paso Registrado",
                "Texto" => "Los datos del paso han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {

        //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar el siguiente paso:". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar dicho paso, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */


    /* ------------- Controlador para eliminar ----------------- */
    public function eliminar_paso_controlador($id)
    {
        /* --- recibiendo id del posicion --- */
        $id = mainModel::decryption($_POST['paso_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el posicion en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT paso_id, paso_nombre FROM paso WHERE paso_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El paso que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_indicador = $check_indicador->fetch();
         $nombre_actividad = $check_indicador['paso_nombre'];
        }

        /* Dejo para codificar luego, comprobar que este registro no este registrado en otras tablas */
        $check_paso = mainModel::ejecutar_consulta_simple("SELECT paso_id FROM procesar WHERE paso_id='$id'");
         if ($check_paso->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Este paso no se puede eliminar, porque ya esta relacionado al procesamiento de una solicitud.",
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

        $eliminar_indicador = pasoModelo::eliminar_paso_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {

        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino el siguiente paso: " . $nombre_actividad;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Paso Eliminado",
                "Texto" => "El registro correspondiente al paso seleccionado, ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {

         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente paso: " . $nombre_actividad;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el paso, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar */

    /* Controlador para crear fecha */
    public function obener_fecha_time_controlador(){
        $fecha = mainModel::crear_fecha();
        return $fecha;
    }
    
    /* * ** Controlador para obtener los datos ******* */
    public function datos_paso_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return pasoModelo::datos_paso_modelo($tipo, $id);
    }

    /* Fin controlador datos */

    /* *** Controlador para editar *** */
    public function actualizar_paso_controlador()
    {
        // Recibiendo el id
        $id = mainModel::decryption($_POST['paso_id_up']);
        $id = mainModel::limpiar_cadena($id);

        // Comprobar el posicion mediante el ID en la BD
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT * FROM paso WHERE paso_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el paso en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_indicador->fetch(); // se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        /* Inicio de Codigo */
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['paso_nombre_up']);
        $duracion = mainModel::limpiar_cadena($_POST['paso_duracion_up']);
        $actividad = mainModel::decryption($_POST['actividad_nombre_up']);
        $actividad = mainModel::limpiar_cadena($actividad);

        /* -------- Comprobar los campos vacios -------- */
        if ($nombre == "" || $duracion == "" || $actividad == "") {

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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,500}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la paso no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

           /* Comprobar nombre */
        if (mainModel::verificar_datos("[0-9]{1,11}", $duracion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La duracion de la paso no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar nombre */
        if (mainModel::verificar_datos("[0-9]{1,11}", $actividad)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La actividad de la paso no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar que la actividad si este registrada en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT actividad_id FROM actividad WHERE actividad_id='$actividad'");
        if ($check_nombre->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque la actividad que acaba de seleccionar no se encuentra registrada en el sistema, por favor, verifique y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

           /* ------ Comprobar que el numero de cedula y el numero de pasaporte no se repitan en la bd ------ */
        if ($nombre != $campos['paso_nombre']) {
            $check_cedula = mainModel::ejecutar_consulta_simple("SELECT paso_id FROM paso WHERE paso_nombre='$nombre'");
            if ($check_cedula->rowCount() > 0) { // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La descripcion del paso que intenta registrar, ya se encuentra registrado en el sistema",
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
        $datos_paso_up = [
            "Nombre" => $nombre,
            "Actividad" => $actividad,
            "Duracion" => $duracion,
            "ID" => $id
        ];

        /* Fin de Codigo */

        if (pasoModelo::actualizar_paso_modelo($datos_paso_up)) {

         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo el siguiente paso: " . $nombre;
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
           $accion_bitacora = "No pudo actualizar el siguiente paso: " . $nombre;
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

    /** Controlador paginar actividads **/
    public function paginador_paso_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS paso.paso_id, paso.paso_nombre, paso.paso_duracion, actividad.actividad_nombre FROM paso INNER JOIN actividad ON paso.actividad_id=actividad.actividad_id WHERE paso.paso_nombre LIKE '%$busqueda%' OR paso.paso_duracion LIKE '%$busqueda%' OR actividad.actividad_nombre LIKE '%$busqueda%' ORDER BY paso.paso_id ASC LIMIT $inicio,$registros";

              //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de pasos";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS paso.paso_id, paso.paso_nombre, paso.paso_duracion, actividad.actividad_nombre FROM paso INNER JOIN actividad ON paso.actividad_id=actividad.actividad_id ORDER BY paso.paso_id ASC LIMIT $inicio,$registros";

           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de pasos";
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
					<th>PASO</th>
                    <th>DURACION</th>
                    <th>ACTIVIDAD</th>';

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
                                        <td class="text-left">' . $rows['paso_nombre'] . '</td>
                                        <td class="text-left">' . $rows['paso_duracion'] . '</td>
                                        <td class="text-left">' . $rows['actividad_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'paso-update/' . mainModel::encryption($rows['paso_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/pasoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="paso_id_del" value="' . mainModel::encryption($rows['paso_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando paso ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador paso*/

}
