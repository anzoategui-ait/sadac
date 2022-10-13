<?php

if ($peticionAjax) {
    require_once "../modelos/kategoriaModelo.php";
} else {
    require_once "./modelos/kategoriaModelo.php";
}

class kategoriaControlador extends kategoriaModelo {
    /* Controlador para agregar un kategoria */

    public function agregar_kategoria_controlador() {

        /* == Almacenando datos == */
        $nombre = mainModel::limpiar_cadena($_POST['kategoria_nombre_reg']);
        $ubicacion = mainModel::limpiar_cadena($_POST['kategoria_ubicacion_reg']);

        /* == Verificando campos obligatorios == */
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


        /* == Verificando integridad de los datos == */
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($ubicacion != "") {
            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,150}", $ubicacion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La ubicacion no coincide con el formato solicitado.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }




        /* == Verificando kategoria == */
        $check_kategoria = mainModel::ejecutar_consulta_simple("SELECT kategoria_nombre FROM kategoria WHERE kategoria_nombre='$nombre' LIMIT 0,1");
        if ($check_kategoria->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El nombre de la kategoria ya se encuentra registrado, por favor elija otro.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_kategoria = null;

        /* == Guardando datos == */
        $datos_kategoria_reg = [
            "Nombre" => $nombre,
            "Ubicacion" => $ubicacion
        ];

        /* -- Agregar el registro -- */
        $agregar_kategoria = kategoriaModelo::agregar_kategoria_modelo($datos_kategoria_reg);
        if ($agregar_kategoria->rowCount() == 1) {  //rowCount() en este caso cuenta cuantos registros fueron realizados satisfactoriamente
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Categoria Registrada",
                "Texto" => "Los datos de la categoria han sido registrados con exito",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos podido registrar la categoria",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin Controlador */

    /* Controlador para listar y buscar los kategorias en una tabla */

    public function paginador_kategoria_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda) {

        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);

        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM kategoria WHERE kategoria_nombre LIKE '%$busqueda%' OR kategoria_ubicacion LIKE '%$busqueda%' ORDER BY kategoria_nombre ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM kategoria ORDER BY kategoria_nombre ASC LIMIT $inicio,$registros";
        }

        $conexion = mainModel::conectar(); //creamos nuestra con conexion con el modelo principal
        $datos = $conexion->query($consulta); //ejecutamos la consulta a traves de un query, que se usa para ejecutar la consulta
        $datos = $datos->fetchAll(); //fetchAll para crear un array con todos los datos obtenidos de la base de datos

        $total = $conexion->query("SELECT FOUND_ROWS()"); //Para contar todos los registros de mi consulta a la base de datos, pero en la consulta debe de ir SQL_CALC_FOUND_ROWS despues del SELECT
        $total = (int) $total->fetchColumn(); //luego de la consulta anterior con esto se cuenta cuantos registros hay en la base de datos

        $Npaginas = ceil($total / $registros); //Funcion PHP Para redondear los numeros de paginas que devuelve el llamado a la base de datos a su numero mas proximo

        $tabla .= '
            <div class="table-responsive"><table class="table table-striped table-bordered">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Productos</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
            ';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center roboto-medium" >
					<td>' . $contador . '</td>
                                        <td>' . $rows['kategoria_nombre'] . '</td>
                                        <td>' . $rows['kategoria_ubicacion'] . '</td>'
                        . '<td><a href="' . SERVERURL . 'producto-categoria/' . mainModel::encryption($rows['kategoria_id']) . '/" class="btn btn-3d btn-info"><i class="fa fa-folder"></i></a></td>
                                        
                                        <td><a href="' . SERVERURL . 'kategoria-update/' . mainModel::encryption($rows['kategoria_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a></td>
                                        <td>
                                        <form class="FormularioAjax" action="' . SERVERURL . 'ajax/kategoriaAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="kategoria_id_del" value="' . mainModel::encryption($rows['kategoria_id']) . '"> 
                                            <button type="submit" class="btn btn-3d btn-danger">
                                                <span class="fa fa-trash"></span></button>
                                        </form>
                                        </td>
				</tr>';
                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center roboto-medium"><td colspan="7"><a href="' . $url . '" class="button is-link is-rounded is-small mt-4 mb-4">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center roboto-medium"><td colspan="7">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando categoria ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin del Controlador */

    /* Controlador para eliminar un kategoria */

    public function eliminar_kategoria_controlador($id) {
        /* --- recibiendo id del kategoria --- */
        $id = mainModel::decryption($_POST['kategoria_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el kategoria en la base de datos */
        $check_kategoria = mainModel::ejecutar_consulta_simple("SELECT kategoria_id FROM kategoria WHERE kategoria_id='$id'");
        if ($check_kategoria->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La categoria que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Comprobar si existen otras tablas donde el kategoria este relacionado */
        /*         * ******************************************************************** */

        /* Comprobar privilegios del kategoria que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar esta categoria",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_kategoria = kategoriaModelo::eliminar_kategoria_modelo($id);

        if ($eliminar_kategoria->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Categoria Eliminada",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar la categoria, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin del Controlador */

    /* Controlador para obtener los datos del kategoria */

    public function datos_kategoria_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return kategoriaModelo::datos_kategoria_modelo($tipo, $id);
    }

    /* Fin controlador datos kategoria */

    /* Controlador para actualizar los datos de un kategoria */

    public function actualizar_kategoria_controlador() {
        /* == Almacenando id == */
        $id = mainModel::decryption($_POST['kategoria_id_up']);
        $id = mainModel::limpiar_cadena($id);

        /* == Verificando kategoria == */
        $check_kategoria = mainModel::ejecutar_consulta_simple("SELECT * FROM kategoria WHERE kategoria_id='$id'");

        if ($check_kategoria->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No hemos encontrado la categoria en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $check_kategoria->fetch();
        }
        $check_kategoria = null;

        /* == Verificando el administrador en DB == */
        session_start(['name' => 'TOR']);
        /* Verificar que tenga los permisos suficientes para editar un usuario */
        if ($_SESSION['privilegio_tor'] != 1 && $_SESSION['privilegio_tor'] != 2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos necesarios para realizar esta operacion",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* == Almacenando datos del kategoria == */
        $nombre = mainModel::limpiar_cadena($_POST['kategoria_nombre_up']);
        $ubicacion = mainModel::limpiar_cadena($_POST['kategoria_ubicacion_up']);

        /* Caso privilegio si viene en blanco colocar el dato que trae de la base de datos */
        if ($ubicacion == "") {
            $ubicacion = $datos['kategoria_ubicacion'];
        }

        /* == Verificando campos obligatorios del kategoria == */
        if ($nombre == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* == Verificando integridad de los datos (kategoria) == */
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,50}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "el NOMBRE no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,150}", $ubicacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "la UBICACION no coincide con el formato solicitado.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }




        /* == Verificando kategoria == */
        if ($nombre != $datos['kategoria_nombre']) {

            $check_kategoria = mainModel::ejecutar_consulta_simple("SELECT kategoria_nombre FROM kategoria WHERE kategoria_nombre='$nombre'");
            if ($check_kategoria->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "el NOMBRE ya esta regitrado, elija otro.",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_kategoria = null;
        }


        /* == Actualizar datos == */

        $datos_kategoria_up = [
            "nombre" => $nombre,
            "ubicacion" => $ubicacion,
            "id" => $id
        ];

        if (kategoriaModelo::actualizar_kategoria_modelo($datos_kategoria_up)) {
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

    /* Fin controlador */
}
