<?php
if ($peticionAjax) {
    require_once "../modelos/asignacionModelo.php";
} else {
    require_once "./modelos/asignacionModelo.php";
}

class asignacionControlador extends asignacionModelo {

    /** Controlador para agregar una asignacion **/
    public function agregar_asignacion_controlador() {
    
    //Obtener valores desde el formulario
    $solicitud_actividad = mainModel::decryption($_POST['solicitud_actividad_reg']);
    $solicitud_actividad = mainModel::limpiar_cadena($solicitud_actividad);
    $operador = mainModel::decryption($_POST['solicitud_operador_reg']);
    $operador = mainModel::limpiar_cadena($operador);
    $observacion = mainModel::limpiar_cadena($_POST['asignacion_observacion_reg']);
    //Datos obtenidos desde el sistema
    //Obtener la fecha
    $fecha = mainModel::limpiar_cadena($_POST['fecha_reg']);
    $hora_solicitud = mainModel::crear_fecha();
    $rs_hora = explode (" ", $hora_solicitud);
    $hora = $rs_hora[1];

    $fecha_asignacion = $fecha . ' ' . $hora;






    session_start(['name' => 'TOR']);
    $asignado_por = $_SESSION['id_tor'];

        /* --------  Comprobar los campos vacios  -------- */
        if ($operador == "" || $observacion == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,500}", $observacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La observacion de la asignacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]{1,11}", $operador)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El operador no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ------  Comprobando que el operador este registrados en el sistemas ------ */
        $check_operador = mainModel::ejecutar_consulta_simple("SELECT usuario_id FROM usuario WHERE usuario_id='$operador'");
        if ($check_operador->rowCount() <= 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El operador que acaba de seleccionar no se encuentra registrado en el sistema.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_asignacion_reg = [
            "Solicitud" => $solicitud_actividad,
            "Operador" => $operador,
            "Observacion" => $observacion,
            "Fecha" => $fecha_asignacion,
            "Asignado" => $asignado_por
        ];

        /* -- Agregar el registro -- */
        $agregar_asignacion = asignacionModelo::agregar_asignacion_modelo($datos_asignacion_reg);
        if ($agregar_asignacion->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

            //Editar y cambiar el estatus a asignado
            $cambiar_estado = mainModel::ejecutar_consulta_simple("UPDATE solicitud_actividad SET solicitud_estado='asignado' WHERE sol_act_id='$solicitud_actividad'");

           //Para agregar bitacora
         //  session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Creacion de nueva asignacion: ". $observacion;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "redireccionar",
                "URL" =>  SERVERURL ."asignacion-new/"
            ];
        } else {
        //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error. No se pudo registrar la siguiente asignacion:". $observacion;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

            $alerta = [
                "Alerta" => "redireccionar",
                "URL" =>  SERVERURL ."asignacion-new/"
            ];
        }
        echo json_encode($alerta);
    }
    /*Fin Controlador*/

    /** Controlador paginar asignacions **/
    public function paginador_asignacion_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as
             supervisor_apellido, usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido,
             asignacion.asignacion_id, actividad.actividad_nombre,
             asignacion.asignacion_fecha, asignacion.asignacion_observacion FROM asignacion INNER JOIN solicitud_actividad
             ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON
             solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id
             INNER JOIN usuario as supervisor ON asignacion.asignado_por=supervisor.usuario_id WHERE actividad.actividad_nombre LIKE '%$busqueda%' OR
             supervisor.usuario_nombre LIKE '%$busqueda%' OR supervisor.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%'
             OR asignacion.asignacion_fecha LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%' ORDER BY asignacion.asignacion_fecha DESC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de asignacions";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as supervisor_apellido, usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre, asignacion.asignacion_fecha, asignacion.asignacion_observacion FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id INNER JOIN usuario as supervisor ON asignacion.asignado_por=supervisor.usuario_id ORDER BY asignacion.asignacion_fecha DESC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de asignaciones";
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
					<th>ACTIVIDAD</th>
					<th>FECHA</th>
					<th>OPERADOR</th>
					<th>SUPERVISOR</th>
                    <th>OBSERVACION</th>';

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
                                        <td class="text-left">' . $rows['actividad_nombre'] . '</td>
                                        <td class="text-left">' . $rows['asignacion_fecha'] . '</td>
                                        <td class="text-left">' . $rows['operador_nombre'] .', ' . $rows['operador_apellido'] . '</td>
                                        <td class="text-left">' . $rows['supervisor_nombre'] .', ' . $rows['supervisor_apellido'] .  '</td>
                                        <td class="text-left">' . $rows['asignacion_observacion'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td><a href="' . SERVERURL . 'asignacion-update/' . mainModel::encryption($rows['asignacion_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/asignacionAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="asignacion_id_del" value="' . mainModel::encryption($rows['asignacion_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando asignacion ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador asignacion*/

    /**Seleccionar una asignacion para procesarla **/
     /** Controlador paginar asignacions **/
    public function paginador_procesar_asignacion_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
        
        //Verificar que tipo de usuario es el que esta visualizando las tablas
        if($_SESSION['tipo_tor']==1 || $_SESSION['tipo_tor']==2){

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as
             supervisor_apellido, usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido,
             asignacion.asignacion_id, actividad.actividad_nombre,
             asignacion.asignacion_fecha, asignacion.asignacion_observacion FROM asignacion INNER JOIN solicitud_actividad
             ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON
             solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id
             INNER JOIN usuario as supervisor ON asignacion.asignado_por=supervisor.usuario_id WHERE((solicitud_actividad.solicitud_estado='asignado') AND (actividad.actividad_nombre LIKE '%$busqueda%' OR
             supervisor.usuario_nombre LIKE '%$busqueda%' OR supervisor.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%'
             OR asignacion.asignacion_fecha LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%')) ORDER BY asignacion.asignacion_fecha ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de asignacions";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as supervisor_apellido, "
                    . "usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id INNER JOIN usuario as supervisor "
                    . "ON asignacion.asignado_por=supervisor.usuario_id WHERE solicitud_actividad.solicitud_estado='asignado' ORDER BY asignacion.asignacion_fecha ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de asignaciones";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        }
        
        }//Fin de visualizar
        else{
             if (isset($busqueda) && $busqueda != "") {
            $usuario_bitacora = $_SESSION['id_tor'];
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as
             supervisor_apellido, usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido,
             asignacion.asignacion_id, actividad.actividad_nombre,
             asignacion.asignacion_fecha, asignacion.asignacion_observacion FROM asignacion INNER JOIN solicitud_actividad
             ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON
             solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id
             INNER JOIN usuario as supervisor ON asignacion.asignado_por=supervisor.usuario_id WHERE ((usuario.usuario_id='$usuario_bitacora' AND solicitud_actividad.solicitud_estado='asignado') AND (actividad.actividad_nombre LIKE '%$busqueda%' OR
             supervisor.usuario_nombre LIKE '%$busqueda%' OR supervisor.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%'
             OR asignacion.asignacion_fecha LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%')) ORDER BY asignacion.asignacion_fecha ASC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de asignacions";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $usuario_bitacora = $_SESSION['id_tor'];
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as supervisor_apellido, "
                    . "usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id INNER JOIN usuario as supervisor "
                    . "ON asignacion.asignado_por=supervisor.usuario_id WHERE usuario.usuario_id='$usuario_bitacora' AND solicitud_actividad.solicitud_estado='asignado' ORDER BY asignacion.asignacion_fecha ASC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $accion_bitacora = "Visualizo el listado de asignaciones";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } 
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
					<th>ACTIVIDAD</th>
					<th>FECHA</th>
					<th>OPERADOR</th>
					<th>SUPERVISOR</th>
                    <th>OBSERVACION</th><th>SELECCIONAR</th>';

        
		$tabla .='</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['actividad_nombre'] . '</td>
                                        <td class="text-left">' . $rows['asignacion_fecha'] . '</td>
                                        <td class="text-left">' . $rows['operador_nombre'] .', ' . $rows['operador_apellido'] . '</td>
                                        <td class="text-left">' . $rows['supervisor_nombre'] .', ' . $rows['supervisor_apellido'] .  '</td>
                                        <td class="text-left">' . $rows['asignacion_observacion'] . '</td>';

                  $tabla .= '<td><a href="' . SERVERURL . 'procesar-asignacion/' . mainModel::encryption($rows['asignacion_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-check"></i></a></td>';
               

               


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
            $tabla .= '<p class="text-right">Mostrando asignacion ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador asignacion*/

   
    /* Controlador para paginar solo las actividades procesadas o finalizadas */
      public function paginador_procesadas_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
        
        //Verificar que tipo de usuario es el que esta visualizando las tablas
        if($_SESSION['tipo_tor']==1 || $_SESSION['tipo_tor']==2){

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as
             supervisor_apellido, usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido,
             asignacion.asignacion_id, actividad.actividad_nombre,
             asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad
             ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON
             solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id
             INNER JOIN usuario as supervisor ON asignacion.asignado_por=supervisor.usuario_id WHERE actividad.actividad_nombre LIKE '%$busqueda%' OR
             supervisor.usuario_nombre LIKE '%$busqueda%' OR supervisor.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%'
             OR asignacion.asignacion_fecha LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%' ORDER BY asignacion.asignacion_fecha DESC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de asignacions";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as supervisor_apellido, "
                    . "usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id INNER JOIN usuario as supervisor "
                    . "ON asignacion.asignado_por=supervisor.usuario_id ORDER BY asignacion.asignacion_fecha DESC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de asignaciones";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        }
        
        }//Fin de visualizar
        else{
             if (isset($busqueda) && $busqueda != "") {
            $usuario_bitacora = $_SESSION['id_tor'];
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as
             supervisor_apellido, usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido,
             asignacion.asignacion_id, actividad.actividad_nombre,
             asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad
             ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id INNER JOIN actividad ON
             solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id
             INNER JOIN usuario as supervisor ON asignacion.asignado_por=supervisor.usuario_id WHERE ((usuario.usuario_id='$usuario_bitacora' AND solicitud_actividad.solicitud_estado='finalizado') AND (actividad.actividad_nombre LIKE '%$busqueda%' OR
             supervisor.usuario_nombre LIKE '%$busqueda%' OR supervisor.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%'
             OR asignacion.asignacion_fecha LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%')) ORDER BY asignacion.asignacion_fecha DESC LIMIT $inicio,$registros";
            //Para agregar bitacora
          // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de asignacions";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } else {
            $usuario_bitacora = $_SESSION['id_tor'];
            $consulta = "SELECT SQL_CALC_FOUND_ROWS supervisor.usuario_nombre as supervisor_nombre, supervisor.usuario_apellido as supervisor_apellido, "
                    . "usuario.usuario_nombre as operador_nombre, usuario.usuario_apellido as operador_apellido, asignacion.asignacion_id, actividad.actividad_nombre,"
                    . " asignacion.asignacion_fecha, asignacion.asignacion_observacion, solicitud_actividad.solicitud_fin FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id"
                    . " INNER JOIN actividad ON solicitud_actividad.actividad_id=actividad.actividad_id INNER JOIN usuario ON asignacion.asignado_a=usuario.usuario_id INNER JOIN usuario as supervisor "
                    . "ON asignacion.asignado_por=supervisor.usuario_id WHERE usuario.usuario_id='$usuario_bitacora' AND solicitud_actividad.solicitud_estado='finalizado' ORDER BY asignacion.asignacion_fecha DESC LIMIT $inicio,$registros";
           //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           $accion_bitacora = "Visualizo el listado de asignaciones";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");

        } 
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
					<th>ACTIVIDAD</th>
					<th>FECHA ASIGNACION</th>
                                        <th>FECHA FIN</th>
                                        <th>DURACION</th>
					<th>OPERADOR</th>
					<th>ASIGNADO POR</th>
                    <th>OBSERVACION</th><th>VER</th>';

        
		$tabla .='</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tiempo_transcurrido = mainModel::dias_transcurridos($rows['asignacion_fecha'] , $rows['solicitud_fin']);
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['actividad_nombre'] . '</td>
                                        <td class="text-left">' . $rows['asignacion_fecha'] . '</td>
                                        <td class="text-left">' . $rows['solicitud_fin'] . '</td>
                                            <td class="text-left">'.$tiempo_transcurrido.'</td>
                                        <td class="text-left">' . $rows['operador_nombre'] .', ' . $rows['operador_apellido'] . '</td>
                                        <td class="text-left">' . $rows['supervisor_nombre'] .', ' . $rows['supervisor_apellido'] .  '</td>
                                        <td class="text-left">' . $rows['asignacion_observacion'] . '</td>';

                  $tabla .= '<td>
                                        <form class="form-neon" action="' . SERVERURL . 'reporte/asignacionprocesada.php" method="POST" data-form="save" autocomplete="off">
                                           <input type="hidden" name="asignacion_id" value="' . mainModel::encryption($rows['asignacion_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-warning">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </form>
                                        </td>';

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
            $tabla .= '<p class="text-right">Mostrando asignacion ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } 
    /*Fin Controlador paginador asignacion*/

   /* Controlador para mostrar los anexos de las asignaciones procesadas en el sistema */
   /* ---- Controlador paginar usuarios ----- */

    public function paginador_asignacion_anexo_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);


        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

             $usuario_bitacora = $_SESSION['id_tor'];
            if (isset($busqueda) && $busqueda != "") {
                if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS pdf.pdf_id, pdf.pdf_archivo, asignacion.asignacion_id, asignacion.asignacion_observacion FROM pdf INNER JOIN asignacion ON pdf.asignacion_id = asignacion.asignacion_id WHERE pdf.pdf_archivo LIKE '%$busqueda%' OR asignacion.asignacion_id LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%' ORDER BY asignacion.asignacion_id DESC LIMIT $inicio,$registros";
                }else {
                  $consulta = "SELECT SQL_CALC_FOUND_ROWS pdf.pdf_id, pdf.pdf_archivo, asignacion.asignacion_id, asignacion.asignacion_observacion FROM pdf INNER JOIN asignacion ON pdf.asignacion_id = asignacion.asignacion_id WHERE (pdf.pdf_archivo LIKE '%$busqueda%' OR asignacion.asignacion_id LIKE '%$busqueda%' OR asignacion.asignacion_observacion LIKE '%$busqueda%') AND (asignacion.asignado_a='$usuario_bitacora') ORDER BY asignacion.asignacion_id DESC LIMIT $inicio,$registros";
                  
                }
                // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           
           $accion_bitacora = "Hizo la siguiente busqueda: ". $busqueda . " en el listado de anexo de asignaciones";
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            } else {
                if ($_SESSION['tipo_tor'] == 1 || $_SESSION['tipo_tor'] == 2) {
                $consulta = "SELECT SQL_CALC_FOUND_ROWS pdf.pdf_id, pdf.pdf_archivo, asignacion.asignacion_id, asignacion.asignacion_observacion FROM pdf INNER JOIN asignacion ON pdf.asignacion_id = asignacion.asignacion_id ORDER BY asignacion.asignacion_id DESC LIMIT $inicio,$registros";
                } else {
                   $consulta = "SELECT SQL_CALC_FOUND_ROWS pdf.pdf_id, pdf.pdf_archivo, asignacion.asignacion_id, asignacion.asignacion_observacion FROM pdf INNER JOIN asignacion ON pdf.asignacion_id = asignacion.asignacion_id WHERE asignacion.asignado_a='$usuario_bitacora' ORDER BY asignacion.asignacion_id DESC LIMIT $inicio,$registros";
                 
                }
                 //Para agregar bitacora
           // session_start(['name' => 'TOR']);
           $fecha_bitacora=mainModel::crear_fecha();
           // $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Visualizo el listado de anexo de asignaciones";
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
                    <th>No. Asignacion</th>
                    <th>Observacion</th>
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

                        $tabla .=  $rows['asignacion_id'] . '</td>' .
                          '<td>' . $rows['asignacion_observacion'] . '</td>
                           <td class="text-left">
                            <a href="' . SERVERURL . 'visor-pdf/' . mainModel::encryption($rows['pdf_id']) . '/" class="btn btn-primary" data-toggle="popover" data-trigger="hover" title="' . $rows['pdf_archivo'] . '" data-content="Descripcion">Visualizar Anexo</a>
                           </td>';

                if ($privilegio == 1) {
                    $tabla .= '<td><form class="FormularioAjax" action="' . SERVERURL . 'ajax/asignacionAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="pdf_id_del" value="' . mainModel::encryption($rows['pdf_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando pdf ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* --- Fin Controlador paginador usuario --- */
    
    /** Controlador para eliminar asignacion **/
    public function eliminar_asignacion_controlador($id) {
        /* --- recibiendo id de la asignacion --- */
        $id = mainModel::decryption($_POST['asignacion_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la asignacion en la base de datos */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT asignacion_id, asignacion_observacion, solicitud_actividad FROM asignacion WHERE asignacion_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El asignacion que intenta eliminar no esta registrada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
         $check_nombre = $check_nombre->fetch();
         $nombre_asignacion = $check_nombre['asignacion_observacion'];
         $solicitud_actividad = $check_nombre['solicitud_actividad'];
        }

        /* Comprobar que asignacion no este relacionada a algun usuario... */
        $check_asignacion = mainModel::ejecutar_consulta_simple("SELECT asignacion_id FROM asignacion INNER JOIN solicitud_actividad ON asignacion.solicitud_actividad=solicitud_actividad.sol_act_id WHERE solicitud_actividad.solicitud_estado='finalizado' AND asignacion.asignacion_id='$id' LIMIT 1");
        if ($check_asignacion->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La asignacion que esta intentando eliminar, ya fue procesada y finalizada, y por eso no puede eliminar este registro",
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
                "Texto" => "No tienes los permisos suficientes para eliminar esta asignacion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_asignacion = asignacionModelo::eliminar_asignacion_modelo($id);

        if ($eliminar_asignacion->rowCount() == 1) {
         //actualizar el estado de la solicitud a "sin asignar"
         //Editar y cambiar el estatus a asignado
         $cambiar_estado = mainModel::ejecutar_consulta_simple("UPDATE solicitud_actividad SET solicitud_estado='sin asignar' WHERE sol_act_id='$solicitud_actividad'");

        
         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Elimino el siguiente asignacion: " . $nombre_asignacion;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Asignacion Eliminada",
                "Texto" => "La asignacion ha sido eliminada del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Error al tratar de eliminar el siguiente asignacion: " . $nombre_asignacion;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el asignacion seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*Fin Controlador eliminar asignacion*/


    /** Controlador para obtener los datos de la asignacion **/
    public function datos_asignacion_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return asignacionModelo::datos_asignacion_modelo($tipo, $id);
    } /*Fin Controlador obtener datos*/

    
    /* ------------- Controlador para eliminar anexo ----------------- */

    public function eliminar_anexo_controlador($id) {
        /* --- recibiendo id de la club --- */
        $id = mainModel::decryption($_POST['pdf_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la club en la base de datos */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT pdf_id FROM pdf WHERE pdf_id='$id'");
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

        $eliminar_anexo = asignacionModelo::eliminar_anexo_modelo($id);

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
    
    /* Controlador para editar asignacion */
    public function actualizar_asignacion_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['asignacion_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la asignacion mediante el ID en la BD
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT * FROM asignacion WHERE asignacion_id='$id'");
        if ($check_nombre->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado la asignacion en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_nombre->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

           $observacion = mainModel::limpiar_cadena($_POST['asignacion_observacion_up']);



        /* --------  Comprobar los campos vacios  -------- */
        if ($observacion == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{2,500}", $observacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La observacion de la asignacion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar privilegios del usuario que esta intentado editar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1 && $_SESSION['privilegio_tor'] != 2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para editar este asignacion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando los datos para enviarlos al modelo
        $datos_asignacion_up = [
            "Observacion"=>$observacion,
            "ID"=>$id
        ];

        if(asignacionModelo::actualizar_asignacion_modelo($datos_asignacion_up)){

        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo la siguiente asignacion: " . $observacion;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos de la asignacion fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        }else{
        //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "No pudo actualizar la siguiente asignacion: " . $observacion;
           $rs_bitacora = mainModel::ejecutar_consulta_simple("INSERT INTO bitacora(bitacora_fecha, bitacora_accion, usuario_id) VALUES ('$fecha_bitacora', '$accion_bitacora', '$usuario_bitacora')");


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos de la asignacion no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    /* Fin Controlador editar asignacion */

}
