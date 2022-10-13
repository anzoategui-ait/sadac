<?php
if ($peticionAjax) {
    require_once "../modelos/cubiculoModelo.php";
} else {
    require_once "./modelos/cubiculoModelo.php";
}

class cubiculoControlador extends cubiculoModelo {

    /** Controlador para agregar una cubiculo **/
    public function agregar_cubiculo_controlador() {

        $nombre = mainModel::limpiar_cadena($_POST['cubiculo_nombre_reg']);
        $usuario = mainModel::decryption($_POST['usuario_nombre_reg']);
        $usuario = mainModel::limpiar_cadena($usuario);

        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $usuario == "") {
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
                "Texto" => "El Nombre del cubiculo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{1,11}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* ------  Comprobando que la usuario este registrada en la tabla ------ */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$usuario'");
        if ($check_usuario->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La usuario que acaba de seleccionar no se encuentra registrada en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando que el nombre de la cubiculo sea unica ------ */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT cubiculo_nombre FROM cubiculo WHERE cubiculo_nombre='$nombre' AND usuario_id='$usuario'");
        if ($check_nombre->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre del cubiculo que acaba de ingresar, ya se encuentra registrado en el sistema, por favor cambie el nombre y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_cubiculo_reg = [
            "Nombre" => $nombre,
            "usuario"=>$usuario
        ];

        /* -- Agregar el registro -- */
        $agregar_cubiculo = cubiculoModelo::agregar_cubiculo_modelo($datos_cubiculo_reg);
        if ($agregar_cubiculo->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

           //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nuevo cubiculo: ". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "cubiculo Registrado",
                "Texto" => "Los datos del nuevo cubiculo han sido registrados satisfactoriamente.",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar el siguiente cubiculo:". $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar los datos para este nuevo cubiculo, por favor intente nuevamente.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

    /** Controlador paginar cubiculos **/
    public function paginador_cubiculo_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cubiculo.cubiculo_id, cubiculo.cubiculo_nombre, usuario.usuario_nombre FROM cubiculo INNER JOIN usuario ON cubiculo.usuario_id=usuario.usuario_id WHERE cubiculo.cubiculo_nombre LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' ORDER BY cubiculo.cubiculo_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de cubiculos";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cubiculo.cubiculo_id, cubiculo.cubiculo_nombre, usuario.usuario_nombre FROM cubiculo INNER JOIN usuario ON cubiculo.usuario_id=usuario.usuario_id ORDER BY cubiculo.cubiculo_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de cubiculos";
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
					<th>cubiculo</th>
                    <th>usuario</th>';

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
                                        <td class="text-left">' . $rows['cubiculo_nombre'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'cubiculo-update/' . mainModel::encryption($rows['cubiculo_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/cubiculoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="cubiculo_id_del" value="' . mainModel::encryption($rows['cubiculo_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando cubiculo ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador cubiculo*/

    /** Controlador para mostrar usuario, cubiculo y usuario **/
     /** Controlador paginar cubiculos **/
    public function paginador_usuario_cubiculo_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cubiculo.cubiculo_id, cubiculo.cubiculo_nombre, usuario.usuario_nombre, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario_cubiculo INNER JOIN cubiculo ON cubiculo.cubiculo_id=usuario_cubiculo.cubiculo_id INNER JOIN usuario ON usuario.usuario_id=usuario_cubiculo.usuario_id INNER JOIN usuario ON usuario.usuario_id=cubiculo.usuario_id WHERE cubiculo.cubiculo_nombre LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' ORDER BY cubiculo.cubiculo_nombre ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de usurios cubiculos";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS cubiculo.cubiculo_id, cubiculo.cubiculo_nombre, usuario.usuario_nombre, usuario.usuario_nombre, usuario.usuario_apellido FROM usuario_cubiculo INNER JOIN cubiculo ON cubiculo.cubiculo_id=usuario_cubiculo.cubiculo_id INNER JOIN usuario ON usuario.usuario_id=usuario_cubiculo.usuario_id INNER JOIN usuario ON usuario.usuario_id=cubiculo.usuario_id ORDER BY cubiculo.cubiculo_nombre ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de cubiculos";
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
					<th>cubiculo</th>
                                        <th>usuario</th>';

        
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
                                        <td class="text-left">' . $rows['cubiculo_nombre'] . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . '</td>';

              
                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/cubiculoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="usuario_cubiculo_id_del" value="' . mainModel::encryption($rows['cubiculo_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando cubiculo ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador cubiculo*/

    
    
    /** Controlador para eliminar cubiculo **/
    public function eliminar_cubiculo_controlador($id) {
        /* --- recibiendo id de la cubiculo --- */
        $id = mainModel::decryption($_POST['cubiculo_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la cubiculo en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT cubiculo_id, cubiculo_nombre FROM cubiculo WHERE cubiculo_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El cubiculo que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_cubiculo = $check_nombre['cubiculo_nombre'];
        }

        /* Comprobar que cubiculo no este relacionada a algun usuario... */
        $check_cubiculo = mainModel::ejecutar_consulta_simple("SELECT usuario_cubiculo_id FROM usuario_cubiculo WHERE cubiculo_id='$id' LIMIT 1");
         if ($check_cubiculo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar este cubiculo, porque esta relacionado a un usuario.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar esta cubiculo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_cubiculo = cubiculoModelo::eliminar_cubiculo_modelo($id);

        if ($eliminar_cubiculo->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino el siguiente cubiculo: " . $nombre_cubiculo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "cubiculo Eliminado",
                "Texto" => "El cubiculo ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente cubiculo: " . $nombre_cubiculo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el cubiculo seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador eliminar cubiculo*/

 public function eliminar_usuario_cubiculo_controlador($id) {
        /* --- recibiendo id de la cubiculo --- */
        $id = mainModel::decryption($_POST['usuario_cubiculo_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la cubiculo en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT usuario_cubiculo_id, usuario_id FROM usuario_cubiculo WHERE usuario_cubiculo_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La relacion usuario cubiculo que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_cubiculo = $check_nombre['usuario_id'];
        }

        /* Comprobar que cubiculo no este relacionada a algun usuario... */


        /* Comprobar privilegios del usuario que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar la relacion usuario cubiculo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_cubiculo = cubiculoModelo::eliminar_usuario_cubiculo_modelo($id);

        if ($eliminar_cubiculo->rowCount() == 1) {
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino la siguiente relacion usuario id " . $nombre_cubiculo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Relacion Eliminada",
                "Texto" => "La relacion usuario cubiculo ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar la siguiente relacion usuario: " . $nombre_cubiculo;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el cubiculo seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin Controlador eliminar cubiculo*/


    
    /** Controlador para obtener los datos de la cubiculo **/
    public function datos_cubiculo_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return cubiculoModelo::datos_cubiculo_modelo($tipo, $id);
    } /*Fin Controlador obtener datos*/

    /* Controlador para editar cubiculo */
    public function actualizar_cubiculo_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['cubiculo_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la cubiculo mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM cubiculo WHERE cubiculo_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado la cubiculo en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }


        $nombre = mainModel::limpiar_cadena($_POST['cubiculo_nombre_up']);
        $usuario = mainModel::decryption($_POST['usuario_nombre_up']);
        $usuario = mainModel::limpiar_cadena($usuario);


        /* --------  Comprobar los campos vacios  -------- */
        if ($nombre == "" || $usuario == "") {
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
                "Texto" => "El Nombre del cubiculo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{1,11}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La usuario para el cubiculo no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        //
        if($usuario != $campos['usuario_id']){
        /* ------  Comprobando que la usuario este registrada en la tabla ------ */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$usuario'");
        if ($check_usuario->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La usuario que acaba de seleccionar no se encuentra registrada en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        }

        //Comprobar que el nombre a ingresar no este ya registrador en el sistema
        if ($nombre != $campos['cubiculo_nombre']) {
            $check_user = mainModel::ejecutar_consulta_simple("SELECT cubiculo_nombre FROM cubiculo WHERE cubiculo_nombre='$nombre' AND usuario_id='$usuario'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Nombre del cubiculo ingresado ya se encuentra registrado en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para editar este cubiculo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando los datos para enviarlos al modelo
        $datos_cubiculo_up = [
            "Nombre"=>$nombre,
            "usuario"=>$usuario,
            "ID"=>$id
        ];

        if(cubiculoModelo::actualizar_cubiculo_modelo($datos_cubiculo_up)){

        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo el siguiente cubiculo: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos de la cubiculo fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        }else{
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "No pudo actualizar el siguiente cubiculo: " . $nombre;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos de la cubiculo no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin Controlador editar cubiculo */

}
