<?php

if ($peticionAjax) {
    require_once "../modelos/configuracionModelo.php";
} else {
    require_once "./modelos/configuracionModelo.php";
}

class configuracionControlador extends configuracionModelo {

    /** Controlador para agregar configuracion * */
    public function agregar_configuracion_controlador() {

        $descripcion = mainModel::limpiar_cadena($_POST['configuracion_descripcion_reg']);
        $valor = mainModel::limpiar_cadena($_POST['configuracion_valor_reg']);


        /* --------  Comprobar los campos vacios  -------- */
        if ($descripcion == "" || $valor == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{4,190}", $descripcion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Descripcion no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_: ]{1,190}", $valor)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Valor no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        
        /* ------  Comprobando que la descripcion de la configuracion sea unica ------ */
        $check_user = mainModel::ejecutar_consulta_simple("SELECT configuracion_descripcion FROM configuracion WHERE configuracion_descripcion='$descripcion'");
        if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Descripcion que intenta registrar ya se encuentra almacenada en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_configuracion_reg = [
            "Descripcion" => $descripcion,
            "Valor" => $valor
        ];

        /* -- Agregar el registro -- */
        $agregar_usuario = configuracionModelo::agregar_configuracion_modelo($datos_configuracion_reg);
        if ($agregar_usuario->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Configuracion Registrada",
                "Texto" => "Los datos de la configuracion han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar dicha configuracion ",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

/* Fin Controlador */

    /** Controlador paginar configuracion * */
    public function paginador_configuracion_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM configuracion WHERE configuracion_descripcion LIKE '%$busqueda%' OR configuracion_valor LIKE '%$busqueda%' ORDER BY configuracion_descripcion ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM configuracion ORDER BY configuracion_descripcion ASC LIMIT $inicio,$registros";
        }

        $conexion = mainModel::conectar(); //creamos nuestra con conexion con el modelo principal
        $datos = $conexion->query($consulta); //ejecutamos la consulta a traves de un query, que se usa para ejecutar la consulta
        $datos = $datos->fetchAll(); //fetchAll para crear un array con todos los datos obtenidos de la base de datos

        $total = $conexion->query("SELECT FOUND_ROWS()"); //Para contar todos los registros de mi consulta a la base de datos, pero en la consulta debe de ir SQL_CALC_FOUND_ROWS despues del SELECT
        $total = (int) $total->fetchColumn(); //luego de la consulta anterior con esto se cuenta cuantos registros hay en la base de datos

        $Npaginas = ceil($total / $registros); //Funcion PHP Para redondear los numeros de paginas que devuelve el llamado a la base de datos a su numero mas proximo

        $tabla .= '<div class="table-responsive">
		<table class="table table-dark table-sm">
			<thead>
				<tr class="text-center roboto-medium">
					<th>#</th>
					<th>DESCRIPCION</th>
					<th>VALOR</th>
					<th>ACTUALIZAR</th>
					<th>ELIMINAR</th>
				</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center" >
					<td>' . $contador . '</td>
                                        <td>' . $rows['configuracion_descripcion'] . '</td>
                                        <td>' . $rows['configuracion_valor'] . '</td>
                                        
                                        <td><a href="' . SERVERURL . 'configuracion-update/' . mainModel::encryption($rows['configuracion_id']) . '/" class="btn btn-success"><i class="fa fa-refresh"></i></a></td>
                                        <td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/configuracionAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="configuracion_id_del" value="' . mainModel::encryption($rows['configuracion_id']) . '"> 
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        </td>
				</tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="9"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="9">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando registro ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

/* Fin Controlador paginador configuracion */

    /** Controlador para eliminar configuracion * */
    public function eliminar_configuracion_controlador($id) {
        /* --- recibiendo id del configuracion --- */
        $id = mainModel::decryption($_POST['configuracion_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el usuario en la base de datos */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT configuracion_id FROM configuracion WHERE configuracion_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La Configuracion que intenta eliminar no esta registrada en el sistema",
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
                "Texto" => "No tienes los permisos suficientes para eliminar esta configuracion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_usuario = configuracionModelo::eliminar_configuracion_modelo($id);

        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Configuracion Eliminada",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la configuracion deseada, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

/* Fin Controlador eliminar usuario */

    /** Controlador para obtener los datos del configuracion * */
    public function datos_configuracion_controlador($id) {
       
        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return configuracionModelo::datos_configuracion_modelo($id);
    }

/* Fin Controlador obtener datos */

    /** Controlador para editar configuracion * */
    public function actualizar_configuracion_controlador() {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['configuracion_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar la configuracion mediante el ID en la BD
        $check_user = mainModel::ejecutar_consulta_simple("SELECT * FROM configuracion WHERE configuracion_id='$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado esta configuracion en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }



        if (isset($_POST['configuracion_descripcion_up'])) {
            $descripcion = mainModel::limpiar_cadena($_POST['configuracion_descripcion_up']);
        } else {
            $descripcion = $campos['configuracion_descripcion'];
        }
        
        if (isset($_POST['configuracion_valor_up'])) {
            $valor = mainModel::limpiar_cadena($_POST['configuracion_valor_up']);
        } else {
            $valor = $campos['configuracion_valor'];
        }

        
        /* --------  Comprobar los campos vacios  -------- */
        if ($descripcion == "" || $valor == "") {
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
       if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{4,190}", $descripcion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La Descripcion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        
       if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\-_ ]{1,190}", $valor)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El Valor no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        
        

        /* ------  Comprobando descripcion ------ */
            if($descripcion!=$campos['configuracion_descripcion']){
            $check_user = mainModel::ejecutar_consulta_simple("SELECT configuracion_descripcion FROM configuracion WHERE configuracion_descripcion='$descripcion'");
            if ($check_user->rowCount() > 0) {  // ->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La Descripcion para esta configuracion ya se encuentra registrado en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            }
        /**** Preparando los datos para enviarlos al modelo****/
        $datos_configuracion_up = [
            "Descripcion" => $descripcion,
            "Valor" => $valor,
            "ID" => $id
        ];

        if (configuracionModelo::actualizar_configuracion_modelo($datos_configuracion_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos Actualizados",
                "Texto" => "Los datos fueron actualizados satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "Los datos no se pudieron actualizar en el sistema, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

/* Fin Controlador editar configuracion */
    
    
     /** Obtener color del menu lateral * */
    public function obtener_color_menu_lateral() {

        $color_menu = "dark";
        $sql_color = mainModel::ejecutar_consulta_simple("SELECT configuracion_valor FROM configuracion WHERE configuracion_descripcion='color-menu-lateral'");
        if ($sql_color->rowCount() > 0) {
            $campos = $sql_color->fetch();
            $color_menu = $campos['configuracion_valor'];
        } else {
             $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo obtener el color del menu de la configuracion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            //exit();
        }
        
        return $color_menu;
    }
    
    
}
