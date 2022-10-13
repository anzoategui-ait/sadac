<?php
if ($peticionAjax) {
    require_once "../modelos/parroquiaModelo.php";
} else {
    require_once "./modelos/parroquiaModelo.php";
}

class parroquiaControlador extends parroquiaModelo {

    /** Controlador para agregar una parroquia **/
    public function agregar_parroquia_controlador() {

        $nombre = mainModel::limpiar_cadena($_POST['parroquia_nombre_reg']);
        $municipio = mainModel::decryption($_POST['municipio_nombre_reg']);
        $municipio = mainModel::limpiar_cadena($municipio);

        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $municipio == "") {
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
                "Texto" => "El Nombre de la parroquia no coincide con el formato solicitado",
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

        /* ------  Comprobando que el nombre de la parroquia sea unica ------ */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT parroquia_nombre FROM parroquia WHERE parroquia_nombre='$nombre' AND municipio_id='$municipio'");
        if ($check_nombre->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la parroquia que acaba de ingresar, ya se encuentra registrado en el sistema, por favor cambie el nombre y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_parroquia_reg = [
            "Nombre" => $nombre,
            "Municipio"=>$municipio
        ];

        /* -- Agregar el registro -- */
        $agregar_parroquia = parroquiaModelo::agregar_parroquia_modelo($datos_parroquia_reg);
        if ($agregar_parroquia->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

           //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nueva parroquia: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Parroquia Registrada",
                "Texto" => "Los datos de la nueva parroquia han sido registrados satisfactoriamente.",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar la siguiente parroquia:". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para este nueva parroquia, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

    /** Controlador paginar parroquias **/
    public function paginador_parroquia_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS parroquia.parroquia_id, parroquia.parroquia_nombre, municipio.municipio_nombre FROM parroquia INNER JOIN municipio ON parroquia.municipio_id=municipio.municipio_id WHERE parroquia.parroquia_nombre LIKE '%$busqueda%' OR municipio.municipio_nombre LIKE '%$busqueda%' ORDER BY municipio.municipio_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de parroquias";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS parroquia.parroquia_id, parroquia.parroquia_nombre, municipio.municipio_nombre FROM parroquia INNER JOIN municipio ON parroquia.municipio_id=municipio.municipio_id ORDER BY municipio.municipio_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de parroquias";
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
					<th>PARROQUIA</th>
                    <th>MUNICIPIO</th>';

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
                                        <td class="text-left">' . $rows['parroquia_nombre'] . '</td>
                                        <td class="text-left">' . $rows['municipio_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'parroquia-update/' . mainModel::encryption($rows['parroquia_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/parroquiaAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="parroquia_id_del" value="' . mainModel::encryption($rows['parroquia_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando parroquia ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador parroquia*/

    /** Controlador para mostrar usuario, parroquia y municipio **/
     /** Controlador paginar parroquias **/
    public function paginador_usuario_parroquia_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS parroquia.parroquia_id, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario_parroquia INNER JOIN parroquia ON parroquia.parroquia_id=usuario_parroquia.parroquia_id INNER JOIN usuario ON usuario.usuario_id=usuario_parroquia.usuario_id INNER JOIN municipio ON municipio.municipio_id=parroquia.municipio_id WHERE parroquia.parroquia_nombre LIKE '%$busqueda%' OR municipio.municipio_nombre LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' ORDER BY parroquia.parroquia_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de usurios parroquias";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS parroquia.parroquia_id, parroquia.parroquia_nombre, municipio.municipio_nombre, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario_parroquia INNER JOIN parroquia ON parroquia.parroquia_id=usuario_parroquia.parroquia_id INNER JOIN usuario ON usuario.usuario_id=usuario_parroquia.usuario_id INNER JOIN municipio ON municipio.municipio_id=parroquia.municipio_id ORDER BY parroquia.parroquia_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de parroquias";
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
                                        <th>USUARIO</th>
					<th>PARROQUIA</th>
                                        <th>MUNICIPIO</th>';

        
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
                                            <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . '</td>
                                        <td class="text-left">' . $rows['parroquia_nombre'] . '</td>
                                        <td class="text-left">' . $rows['municipio_nombre'] . '</td>';

              
                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/parroquiaAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="usuario_parroquia_id_del" value="' . mainModel::encryption($rows['parroquia_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando parroquia ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador parroquia*/

    
    
    /** Controlador para eliminar parroquia **/
    public function eliminar_parroquia_controlador($id) {
        /* --- recibiendo id de la parroquia --- */
        $id = mainModel::decryption($_POST['parroquia_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la parroquia en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT parroquia_id, parroquia_nombre FROM parroquia WHERE parroquia_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El parroquia que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_parroquia = $check_nombre['parroquia_nombre'];
        }

        /* Comprobar que parroquia no este relacionada a algun usuario... */
        $check_parroquia = mainModel::ejecutar_consulta_simple("SELECT usuario_parroquia_id FROM usuario_parroquia WHERE parroquia_id='$id' LIMIT 1");
         if ($check_parroquia->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar esta parroquia, porque esta relacionada a un usuario.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar esta parroquia",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_parroquia = parroquiaModelo::eliminar_parroquia_modelo($id);

        if ($eliminar_parroquia->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino la siguiente parroquia: " . $nombre_parroquia;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Parroquia Eliminada",
                "Texto" => "La parroquia ha sido eliminada del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente parroquia: " . $nombre_parroquia;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la parroquia seleccionada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador eliminar parroquia*/

 public function eliminar_usuario_parroquia_controlador($id) {
        /* --- recibiendo id de la parroquia --- */
        $id = mainModel::decryption($_POST['usuario_parroquia_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la parroquia en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT usuario_parroquia_id, usuario_id FROM usuario_parroquia WHERE usuario_parroquia_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La relacion usuario parroquia que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_parroquia = $check_nombre['usuario_id'];
        }

        /* Comprobar que parroquia no este relacionada a algun usuario... */


        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar la relacion usuario parroquia",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_parroquia = parroquiaModelo::eliminar_usuario_parroquia_modelo($id);

        if ($eliminar_parroquia->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino la siguiente relacion usuario id " . $nombre_parroquia;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Relacion Eliminada",
                "Texto" => "La relacion usuario parroquia ha sido eliminada del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar la siguiente relacion usuario: " . $nombre_parroquia;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar relacion usuario parroquia seleccionada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin Controlador eliminar parroquia*/


    
    /** Controlador para obtener los datos de la parroquia **/
    public function datos_parroquia_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return parroquiaModelo::datos_parroquia_modelo($tipo, $id);
    } /*Fin Controlador obtener datos*/

    /* Controlador para editar parroquia */
    public function actualizar_parroquia_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['parroquia_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la parroquia mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM parroquia WHERE parroquia_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado la parroquia en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }


        $nombre = mainModel::limpiar_cadena($_POST['parroquia_nombre_up']);
        $municipio = mainModel::decryption($_POST['municipio_nombre_up']);
        $municipio = mainModel::limpiar_cadena($municipio);


        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $municipio == "") {
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
                "Texto" => "El Nombre de la parroquia no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{1,11}", $municipio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El municipio para la parroquia no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //
        if($municipio != $campos['municipio_id']){
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
        }

        //Comprobar que el nombre a ingresar no este ya registrador en el sistema
        if ($nombre != $campos['parroquia_nombre']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT parroquia_nombre FROM parroquia WHERE parroquia_nombre='$nombre' AND municipio_id='$municipio'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre de la parroquia ingresado ya se encuentra registrado en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para editar esta parroquia",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando los datos para enviarlos al modelo
        $datos_parroquia_up = [
            "Nombre"=>$nombre,
            "Municipio"=>$municipio,
            "ID"=>$id
        ];

        if(parroquiaModelo::actualizar_parroquia_modelo($datos_parroquia_up)){

        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo la siguiente parroquia: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos de la parroquia fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        }else{
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "No pudo actualizar la siguiente parroquia: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos de la parroquia no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin Controlador editar parroquia */

}