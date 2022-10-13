<?php
if ($peticionAjax) {
    require_once "../modelos/cargoModelo.php";
} else {
    require_once "./modelos/cargoModelo.php";
}

class cargoControlador extends cargoModelo {

    /** Controlador para agregar una cargo **/
    public function agregar_cargo_controlador() {

        $nombre = mainModel::limpiar_cadena($_POST['cargo_nombre_reg']);
        $direccion = mainModel::decryption($_POST['direccion_nombre_reg']);
        $direccion = mainModel::limpiar_cadena($direccion);

        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $direccion == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,100}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del cargo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{1,11}", $direccion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La direccion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* ------  Comprobando que la direccion este registrada en la tabla ------ */
        $check_direccion = mainModel::ejecutar_consulta_simple("SELECT direccion_id FROM direccion WHERE direccion_id='$direccion'");
        if ($check_direccion->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La direccion que acaba de seleccionar no se encuentra registrada en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando que el nombre de la cargo sea unica ------ */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT cargo_nombre FROM cargo WHERE cargo_nombre='$nombre' AND direccion_id='$direccion'");
        if ($check_nombre->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del cargo que acaba de ingresar, ya se encuentra registrado en el sistema, por favor cambie el nombre y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_cargo_reg = [
            "Nombre" => $nombre,
            "Direccion"=>$direccion
        ];

        /* -- Agregar el registro -- */
        $agregar_cargo = cargoModelo::agregar_cargo_modelo($datos_cargo_reg);
        if ($agregar_cargo->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

           //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nuevo cargo: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Cargo Registrado",
                "Texto" => "Los datos del nuevo cargo han sido registrados satisfactoriamente.",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar el siguiente cargo:". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para este nuevo cargo, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

    /** Controlador paginar cargos **/
    public function paginador_cargo_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cargo.cargo_id, cargo.cargo_nombre, direccion.direccion_nombre FROM cargo INNER JOIN direccion ON cargo.direccion_id=direccion.direccion_id WHERE cargo.cargo_nombre LIKE '%$busqueda%' OR direccion.direccion_nombre LIKE '%$busqueda%' ORDER BY cargo.cargo_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de cargos";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cargo.cargo_id, cargo.cargo_nombre, direccion.direccion_nombre FROM cargo INNER JOIN direccion ON cargo.direccion_id=direccion.direccion_id ORDER BY cargo.cargo_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de cargos";
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
					<th>CARGO</th>
                    <th>DIRECCION</th>';

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
                                        <td class="text-left">' . $rows['cargo_nombre'] . '</td>
                                        <td class="text-left">' . $rows['direccion_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'cargo-update/' . mainModel::encryption($rows['cargo_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/cargoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="cargo_id_del" value="' . mainModel::encryption($rows['cargo_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando cargo ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador cargo*/

    /** Controlador para mostrar usuario, cargo y direccion **/
     /** Controlador paginar cargos **/
    public function paginador_usuario_cargo_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cargo.cargo_id, cargo.cargo_nombre, direccion.direccion_nombre, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario_cargo INNER JOIN cargo ON cargo.cargo_id=usuario_cargo.cargo_id INNER JOIN usuario ON usuario.usuario_id=usuario_cargo.usuario_id INNER JOIN direccion ON direccion.direccion_id=cargo.direccion_id WHERE cargo.cargo_nombre LIKE '%$busqueda%' OR direccion.direccion_nombre LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' ORDER BY cargo.cargo_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de usurios cargos";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cargo.cargo_id, cargo.cargo_nombre, direccion.direccion_nombre, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario_cargo INNER JOIN cargo ON cargo.cargo_id=usuario_cargo.cargo_id INNER JOIN usuario ON usuario.usuario_id=usuario_cargo.usuario_id INNER JOIN direccion ON direccion.direccion_id=cargo.direccion_id ORDER BY cargo.cargo_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de cargos";
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
					<th>CARGO</th>
                                        <th>DIRECCION</th>';

        
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
                                        <td class="text-left">' . $rows['cargo_nombre'] . '</td>
                                        <td class="text-left">' . $rows['direccion_nombre'] . '</td>';

              
                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/cargoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="usuario_cargo_id_del" value="' . mainModel::encryption($rows['cargo_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando cargo ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador cargo*/

    
    
    /** Controlador para eliminar cargo **/
    public function eliminar_cargo_controlador($id) {
        /* --- recibiendo id de la cargo --- */
        $id = mainModel::decryption($_POST['cargo_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la cargo en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT cargo_id, cargo_nombre FROM cargo WHERE cargo_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El cargo que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_cargo = $check_nombre['cargo_nombre'];
        }

        /* Comprobar que cargo no este relacionada a algun usuario... */
        $check_cargo = mainModel::ejecutar_consulta_simple("SELECT usuario_cargo_id FROM usuario_cargo WHERE cargo_id='$id' LIMIT 1");
         if ($check_cargo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar este cargo, porque esta relacionado a un usuario.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar esta cargo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_cargo = cargoModelo::eliminar_cargo_modelo($id);

        if ($eliminar_cargo->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino el siguiente cargo: " . $nombre_cargo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Cargo Eliminado",
                "Texto" => "El cargo ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente cargo: " . $nombre_cargo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el cargo seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador eliminar cargo*/

 public function eliminar_usuario_cargo_controlador($id) {
        /* --- recibiendo id de la cargo --- */
        $id = mainModel::decryption($_POST['usuario_cargo_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la cargo en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT usuario_cargo_id, usuario_id FROM usuario_cargo WHERE usuario_cargo_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La relacion usuario cargo que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_cargo = $check_nombre['usuario_id'];
        }

        /* Comprobar que cargo no este relacionada a algun usuario... */


        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar la relacion usuario cargo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_cargo = cargoModelo::eliminar_usuario_cargo_modelo($id);

        if ($eliminar_cargo->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino la siguiente relacion usuario id " . $nombre_cargo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Relacion Eliminada",
                "Texto" => "La relacion usuario cargo ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar la siguiente relacion usuario: " . $nombre_cargo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el cargo seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin Controlador eliminar cargo*/


    
    /** Controlador para obtener los datos de la cargo **/
    public function datos_cargo_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return cargoModelo::datos_cargo_modelo($tipo, $id);
    } /*Fin Controlador obtener datos*/

    /* Controlador para editar cargo */
    public function actualizar_cargo_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['cargo_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la cargo mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM cargo WHERE cargo_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado la cargo en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }


        $nombre = mainModel::limpiar_cadena($_POST['cargo_nombre_up']);
        $direccion = mainModel::decryption($_POST['direccion_nombre_up']);
        $direccion = mainModel::limpiar_cadena($direccion);


        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $direccion == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,100}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del cargo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{1,11}", $direccion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La direccion para el cargo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //
        if($direccion != $campos['direccion_id']){
        /* ------  Comprobando que la direccion este registrada en la tabla ------ */
        $check_direccion = mainModel::ejecutar_consulta_simple("SELECT direccion_id FROM direccion WHERE direccion_id='$direccion'");
        if ($check_direccion->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La direccion que acaba de seleccionar no se encuentra registrada en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        }

        //Comprobar que el nombre a ingresar no este ya registrador en el sistema
        if ($nombre != $campos['cargo_nombre']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT cargo_nombre FROM cargo WHERE cargo_nombre='$nombre' AND direccion_id='$direccion'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre del cargo ingresado ya se encuentra registrado en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para editar este cargo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando los datos para enviarlos al modelo
        $datos_cargo_up = [
            "Nombre"=>$nombre,
            "Direccion"=>$direccion,
            "ID"=>$id
        ];

        if(cargoModelo::actualizar_cargo_modelo($datos_cargo_up)){

        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo el siguiente cargo: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos de la cargo fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        }else{
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "No pudo actualizar el siguiente cargo: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos de la cargo no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin Controlador editar cargo */

}
