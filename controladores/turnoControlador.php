<?php
if ($peticionAjax) {
    require_once "../modelos/turnoModelo.php";
} else {
    require_once "./modelos/turnoModelo.php";
}

class turnoControlador extends turnoModelo
{

    /* ------------- Controlador para agregar ----------------- */
    public function agregar_turno_controlador()
    {
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['turno_nombre_reg']);
        $descripcion = mainModel::limpiar_cadena($_POST['turno_descripcion_reg']);
        $fecha = mainModel::limpiar_cadena($_POST['turno_fecha_reg']);
        $cedula = mainModel::limpiar_cadena($_POST['turno_cedula_reg']);
        $estado = "atender";

        $hora_solicitud = mainModel::crear_fecha();
        $rs_hora = explode (" ", $hora_solicitud);
        $hora = $rs_hora[1];

        $fecha_inicio = $fecha . ' ' . $hora;
       
        

        /* -------- Comprobar los campos vacios -------- */
        if ($nombre == "" || $descripcion == "" || $cedula == ""|| $fecha == "") {
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
                "Texto" => "El Nombre del ciudadano no coincide con el formato solicitado",
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
                "Texto" => "La descripcion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar cedula o pasaporte */
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,30}", $cedula)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La cedula no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        
        
        /* Comprobar nombre de la categoria*/
        if (mainModel::verificar_fechas($fecha)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La fecha no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
      
        /* Comprobar que la categoria si este registrada en la base de datos */
        $check_ciudadano = mainModel::ejecutar_consulta_simple("SELECT turno_id FROM turno WHERE turno_cedula='$cedula' AND turno_fecha_login='$fecha'");
        if ($check_ciudadano->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No puede realizar el registro porque el ciudadano ya ha tomado un turno en este dia, por favor, verifique y vuelva a intentarlo.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
       

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_turno_reg = [
            "Nombre" => $nombre,
            "Descripcion" => $descripcion,
            "Cedula" => $cedula,
            "Fecha" => $fecha_inicio,
            "FechaLogin" => $fecha,
            "Estado" => $estado
        ];

     
        /* -- Agregar el registro -- */
        $agregar_turno = turnoModelo::agregar_turno_modelo($datos_turno_reg);
        if ($agregar_turno->rowCount() == 1) { // rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Turno Registrado",
                "Texto" => "Los datos del turno han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {

          $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar dicho turno, intente mas tarde.",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */


    /* ------------- Controlador para eliminar ----------------- */
    public function eliminar_turno_controlador($id)
    {
        /* --- recibiendo id del posicion --- */
        $id = mainModel::decryption($_POST['turno_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el posicion en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT turno_id FROM turno WHERE turno_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El turno que intenta eliminar no esta registrada en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para eliminar este indicador",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_indicador = turnoModelo::eliminar_turno_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {

        
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Turno Eliminado",
                "Texto" => "El registro correspondiente al nombre de la turno seleccionada, ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el nombre de la turno, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* ------------- Controlador para eliminar ----------------- */
    public function atender_turno_controlador($id)
    {
        /* --- recibiendo id del posicion --- */
        $id = mainModel::decryption($_POST['turno_id_atender']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el posicion en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT turno_id FROM turno WHERE turno_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El turno que intenta procesar no esta registrado en el sistema",
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
        
        $usuario_id = $_SESSION['id_tor'];
        $eliminar_indicador = turnoModelo::atender_turno_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {
            //Agrego la relacion del ciudadano y el usuario que lo atendera
            $agregar_registro = turnoModelo::registrar_turno_usuario_modelo($id, $usuario_id, 0);
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Turno a ser atendido",
                "Texto" => "El ciudadano puede pasar a ser atendido",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido realizar el registro, intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar */

    /* ------------- Controlador para eliminar ----------------- */
    public function finalizar_turno_controlador($id)
    {
        /* --- recibiendo id del posicion --- */
        $id = mainModel::decryption($_POST['turno_id_finalizar']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el posicion en la base de datos */
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT turno_id FROM turno WHERE turno_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El turno que intenta procesar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        /* Dejo para codificar luego, comprobar que este registro no este registrado en otras tablas */
       
        
        $eliminar_indicador = turnoModelo::finalizar_turno_modelo($id);

        if ($eliminar_indicador->rowCount() == 1) {

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Turno Finalizado",
                "Texto" => "El ciudadano fue atendido satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido realizar la operacion, intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar */

    /* * ** Controlador para obtener los datos ******* */
    public function datos_turno_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return turnoModelo::datos_turno_modelo($tipo, $id);
    }

    /* Fin controlador datos */

    /* *** Controlador para editar *** */
    public function actualizar_turno_controlador()
    {// Recibiendo el id
        $id = mainModel::decryption($_POST['turno_id_up']);
        $id = mainModel::limpiar_cadena($id);

        // Comprobar el posicion mediante el ID en la BD
        $check_indicador = mainModel::ejecutar_consulta_simple("SELECT * FROM turno WHERE turno_id='$id'");
        if ($check_indicador->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el turno en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_indicador->fetch(); // se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        /* Inicio de Codigo */
        // Campos obligatorios
        $nombre = mainModel::limpiar_cadena($_POST['turno_nombre_up']);
        $descripcion = mainModel::limpiar_cadena($_POST['turno_descripcion_up']);
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}", $nombre))
         {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre de la turno no coincide con el formato solicitado",
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
                "Texto" => "La descripcion de la turno no coincide con el formato solicitado",
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
                "Texto" => "La categoria de la turno no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[0-9]{1,11}", $indicador)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El indicador de la turno no coincide con el formato solicitado",
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
        if ($nombre != $campos['turno_nombre']) {
            $check_cedula = mainModel::ejecutar_consulta_simple("SELECT turno_id FROM turno WHERE turno_nombre='$nombre'");
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
        $datos_turno_up = [
            "Nombre" => $nombre,
            "Categoria" => $categoria,
            "Imagen" => $imagen,
            "Descripcion" => $descripcion,
            "Indicador" => $indicador,
            "ID" => $id
        ];

        /* Fin de Codigo */

        if (turnoModelo::actualizar_turno_modelo($datos_turno_up)) {

         //Para agregar bitacora
           $fecha_bitacora=mainModel::crear_fecha();
           $usuario_bitacora = $_SESSION['id_tor'];
           $accion_bitacora = "Actualizo la siguiente turno: " . $nombre;
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
           $accion_bitacora = "No puso actualizar la siguiente turno: " . $nombre;
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
    public function paginador_turno_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $fecha = date("Y-m-d");

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS turno_id, turno_cedula, turno_nombre, turno_descripcion, turno_estado FROM turno WHERE (turno_nombre LIKE '%$busqueda%' OR turno_descripcion LIKE '%$busqueda%' OR turno_cedula LIKE '%$busqueda%') AND (turno_fecha_login='$fecha' AND turno_estado!='finalizado') ORDER BY turno_id ASC LIMIT $inicio,$registros";

          

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS turno_id, turno_cedula, turno_nombre, turno_descripcion, turno_estado FROM turno WHERE turno_fecha_login='$fecha' AND turno_estado!='finalizado' ORDER BY turno_id ASC LIMIT $inicio,$registros";

           
          
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
                    <th>Cedula</th>
					<th>Ciudadano</th>
                    <th>Descripcion</th>
                    <th>Estado</th>';

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
                $comprobar_estado = $rows['turno_estado'];
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['turno_cedula'] . '</td>
                                        <td class="text-left">' . $rows['turno_nombre'] . '</td>
                                        <td class="text-left">' . $rows['turno_descripcion'] . '</td>';
                
                                        if ($comprobar_estado == "atender") {
                                           // $tabla .= '<td class="text-left"><a href="' . SERVERURL . 'evaluar-solicitud/' . mainModel::encryption($rows['turno_id']) . '/" class="btn btn-3d btn-success">Atender &nbsp;<i class="fa fa-check"></i></a>';
                                            $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/turnoAjax.php" method="POST" data-form="save" autocomplete="off">
                                           <input type="hidden" name="turno_id_atender" value="' . mainModel::encryption($rows['turno_id']) . '">
                                            <button type="submit" class="btn btn-3d btn-success">
                                               Atender <i class="fa fa-check"></i>
                                            </button>
                                        </form>
                                        </td>';
                                        
                                        }

                                        if ($comprobar_estado == "finalizar") {
                                            //$tabla .= '<td class="text-left"><a href="' . SERVERURL . 'evaluar-solicitud/' . mainModel::encryption($rows['turno_id']) . '/" class="btn btn-3d btn-warning">Finalizar &nbsp;<i class="fa fa-check"></i></a>';
                                            $tabla .= '<td>
                                            <form class="FormularioAjax" action="' . SERVERURL . 'ajax/turnoAjax.php" method="POST" data-form="save" autocomplete="off">
                                               <input type="hidden" name="turno_id_finalizar" value="' . mainModel::encryption($rows['turno_id']) . '">
                                                <button type="submit" class="btn btn-3d btn-warning">
                                                   Finalizar <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            </td>';
                                        }

                if ($privilegio == 1) {
                    $tabla .= '<td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/turnoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="turno_id_del" value="' . mainModel::encryption($rows['turno_id']) . '">
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
            $tabla .= '<p class="text-right">Mostrando turno ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador turno*/

    /** Controlador Proximo turno */
    public function proximo_turno_controlador(){
        $fecha = date("Y-m-d");
        $rs = mainModel::ejecutar_consulta_simple("SELECT turno_cedula, turno_nombre FROM turno WHERE turno_fecha_login='$fecha' AND turno_estado='atender' ORDER BY turno_id ASC LIMIT 0,1");
        return $rs;
    }

    /** Turnos en espera */
    public function turnos_en_espera_controlador(){
        $fecha = date("Y-m-d");
        $rs = mainModel::ejecutar_consulta_simple("SELECT turno_id FROM turno WHERE turno_fecha_login='$fecha' AND turno_estado='atender'");
        return $rs; 
    }

    /** Turno Actual o Llamado */
    public function turno_actual_controlador(){
        $fecha = date("Y-m-d");
        $rs= mainModel::ejecutar_consulta_simple("SELECT turno_usuario.turno_usuario_id, turno.turno_cedula, turno.turno_nombre, cubiculo.cubiculo_nombre FROM turno INNER JOIN turno_usuario ON turno.turno_id=turno_usuario.turno_id INNER JOIN cubiculo ON cubiculo.usuario_id=turno_usuario.usuario_id WHERE turno.turno_fecha_login='$fecha' ORDER BY turno_usuario.turno_usuario_id DESC LIMIT 0,1");
        return $rs;
    }

    /** Mostrar ventana emergente */
    public function mostrar_ventana_emergente_controlador($cubiculo, $ciudadano, $turno){

        $check_ventana = mainModel::ejecutar_consulta_simple("SELECT turno_usuario_id FROM turno_usuario WHERE turno_usuario_id='$turno' AND turno_usuario_mostrar='0'");
        
        return $check_ventana;
       

    }

    public function actualizar_ventana_controlador($turno){

        $check_ventana = mainModel::ejecutar_consulta_simple("UPDATE turno_usuario SET turno_usuario_mostrar='1' WHERE turno_usuario_id='$turno'");
        
        return $check_ventana ;
       

    }

    /** Controlador paginar categorias **/
    public function paginador_turno_public_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $fecha = date("Y-m-d");

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS turno_id, turno_cedula, turno_nombre, turno_descripcion, turno_estado FROM turno WHERE (turno_nombre LIKE '%$busqueda%' OR turno_descripcion LIKE '%$busqueda%' OR turno_cedula LIKE '%$busqueda%') AND (turno_fecha_login='$fecha' AND turno_estado='atender') ORDER BY turno_id ASC LIMIT $inicio,$registros";

          

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS turno_id, turno_cedula, turno_nombre, turno_descripcion, turno_estado FROM turno WHERE turno_fecha_login='$fecha' AND turno_estado='atender' ORDER BY turno_id ASC LIMIT $inicio,$registros";

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
                    <th>LISTA DE ESPERA</th>';

        

		$tabla .='</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $comprobar_estado = $rows['turno_estado'];
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['turno_cedula'] . ' - ' . $rows['turno_nombre'] . '</td>';
                
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
            $tabla .= '<p class="text-right">Mostrando turno ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador turno*/

}
