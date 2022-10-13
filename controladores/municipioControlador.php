<?php

if ($peticionAjax) {
    require_once "../modelos/municipioModelo.php";
} else {
    require_once "./modelos/municipioModelo.php";
}

class municipioControlador extends municipioModelo {
    /* ------------- Controlador para agregar municipio ----------------- */

    public function agregar_municipio_controlador() {
        $nombre = mainModel::limpiar_cadena($_POST['municipio_nombre_reg']);
        
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre para la municipio no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    
        /* ------  Comprobando que el nombre no se repita ------ */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT municipio_nombre FROM municipio WHERE municipio_nombre='$nombre'");
        if ($check_nombre->rowCount() > 0) {  //->rowCount() se utiliza para saber cuantos registros regreso esa consulta a la base de datos
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre que intenta ingresar ya pertenece a otro municipio",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* ---- crear el array con los datos para el registro en la base de datos ----- */
        $datos_municipio_reg = [
            "Nombre" => $nombre
        ];

        /* -- Agregar el registro -- */
        $agregar_municipio = municipioModelo::agregar_municipio_modelo($datos_municipio_reg);
        if ($agregar_municipio->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Municipio registrado",
                "Texto" => "Los datos del municipio han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar el municipio",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* --- Fin Controlador --- */

    /* ---- Controlador paginar usuarios ----- */

    public function paginador_municipio_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM municipio WHERE municipio_nombre LIKE '%$busqueda%' ORDER BY municipio_nombre ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM municipio ORDER BY municipio_nombre ASC LIMIT $inicio,$registros";
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
					<th>#</th><th>ID</th>
					<th>TITULO</th>';
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
					<td>' . $contador . '</td><td>' . $rows['municipio_id'] . '</td>
                                        <td>' . $rows['municipio_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td>
                                         <a href="' . SERVERURL . 'municipio-update/' . mainModel::encryption($rows['municipio_id']) . '/" class="btn btn-3d btn-success"><span class="fa fa-refresh"></span></a>
                                             </td>';
                }

                if ($privilegio == 1) {
                    $tabla .= '<td><form class="FormularioAjax" action="' . SERVERURL . 'ajax/municipioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="municipio_id_del" value="' . mainModel::encryption($rows['municipio_id']) . '"> 
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
                $tabla .= '<tr class="text-center"><td colspan="4"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="4">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando municipio ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* --- Fin Controlador paginador usuario --- */
    
    //Seleccionar municipio
    public function paginador_municipio_seleccionar_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM municipio WHERE municipio_nombre LIKE '%$busqueda%' ORDER BY municipio_nombre ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM municipio ORDER BY municipio_nombre ASC LIMIT $inicio,$registros";
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
					<th>TITULO</th>';
        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '<th>SELECCIONAR</th>';
        }
       
        $tabla .= '</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center" >
					<td>' . $contador . '</td>
                                        <td>' . $rows['municipio_nombre'] . '</td>';

                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= '<td>
                                         <a href="' . SERVERURL . 'muestra-relacionar/' . mainModel::encryption($rows['municipio_id']) . '/" class="btn btn-3d btn-success"><span class="fa fa-refresh"></span></a>
                                             </td>';
                }

                $tabla .= ' </tr>';

                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="3"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="3">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando municipio ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* ------------- Controlador para eliminar municipio ----------------- */

    public function eliminar_municipio_controlador($id) {
        /* --- recibiendo id de la muestra --- */
        $id = mainModel::decryption($_POST['municipio_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista la muestra en la base de datos */
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT municipio_id FROM municipio WHERE municipio_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El municipio que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Comprobar que esta municipio no este ya relacionada con alguna muestra */
         $check_municipio = mainModel::ejecutar_consulta_simple("SELECT usuario_parroquia.usuario_parroquia_id FROM usuario_parroquia INNER JOIN parroquia ON usuario_parroquia.parroquia_id = parroquia.parroquia_id WHERE parroquia.municipio_id='$id' LIMIT 1");
         if ($check_municipio->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar este municipio, porque esta relacionado a un usuario.",
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
                "Texto" => "No tienes los permisos suficientes para eliminar este municipio",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_municipio = municipioModelo::eliminar_municipio_modelo($id);

        if ($eliminar_municipio->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Municipio Eliminado",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el municipio seleccionado, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador eliminar muestra */
    
    /*** Controlador para obtener los datos de la muestra ******* */
    public function datos_municipio_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return municipioModelo::datos_municipio_modelo($tipo, $id);
    }
    /* Fin controlador datos muestra */
    
    /*****  Controlador para editar usuario ***** */
    public function actualizar_municipio_controlador()
    {
        //Recibiendo el id
        $id = mainModel::decryption($_POST['municipio_id_up']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar el muestra mediante el ID en la BD
        $check_user = mainModel::ejecutar_consulta_simple("SELECT * FROM municipio WHERE municipio_id='$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado el municipio seleccionado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch(); //se utiliza fetch para que la variable campos se convierta en un array de datos
        }

        $nombre = mainModel::limpiar_cadena($_POST['municipio_nombre_up']);
       
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
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{2,150}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Nombre para la municipio no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
       

        /* ------  Comprobando que el Numero de Telefono a Editar ya no este registrado en el sistema ------ */
        if ($nombre != $campos['municipio_nombre']) {

            $check_nombre = mainModel::ejecutar_consulta_simple("SELECT municipio_nombre FROM municipio WHERE municipio_nombre='$nombre'");
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

           
        /**** Preparando los datos para enviarlos al modelo****/
        $datos_municipio_up = [
            "Nombre" => $nombre,
            "ID"=>$id
        ];
        
        if(municipioModelo::actualizar_municipio_modelo($datos_municipio_up)){
             $alerta = [
                    "Alerta" => "recargar",
                    "Titulo" => "Datos Actualizados",
                    "Texto" => "Los datos fueron actualizados satisfactoriamente",
                    "Tipo" => "success"
                ];
        }else{
             $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Los datos no se pudieron actualizar en el sistema, por favor intente nuevamente",
                    "Tipo" => "error"
                ];
        }
        echo json_encode($alerta);
    } /* Fin Controlador editar muestra */
 
}