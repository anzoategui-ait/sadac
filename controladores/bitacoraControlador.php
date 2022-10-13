<?php
if ($peticionAjax) {
    require_once "../modelos/bitacoraModelo.php";
} else {
    require_once "./modelos/bitacoraModelo.php";
}

class bitacoraControlador extends bitacoraModelo {

    /** Controlador paginar bitacoras **/
    public function paginador_bitacora_controlador($pagina, $registros, $privilegio, $url, $busqueda) {

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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS bitacora.bitacora_id, bitacora.bitacora_accion, bitacora.bitacora_fecha, usuario.usuario_id, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM bitacora INNER JOIN usuario ON bitacora.usuario_id=usuario.usuario_id WHERE bitacora.bitacora_accion LIKE '%$busqueda%' OR bitacora.bitacora_fecha LIKE '%$busqueda%' OR usuario.usuario_dni LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' OR usuario.usuario_apellido LIKE '%$busqueda%' OR usuario.usuario_id LIKE '%$busqueda%' ORDER BY bitacora.bitacora_fecha ASC LIMIT $inicio,$registros";

        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS bitacora.bitacora_id, bitacora.bitacora_accion, bitacora.bitacora_fecha, usuario.usuario_id, usuario.usuario_dni, usuario.usuario_nombre, usuario.usuario_apellido FROM bitacora INNER JOIN usuario ON bitacora.usuario_id=usuario.usuario_id ORDER BY bitacora.bitacora_fecha DESC LIMIT $inicio,$registros";
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
                    <th>ACCION</th>
                    <th>FECHA</th>';

		$tabla .='</tr>
			</thead>
			<tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr class="text-center">
					<td>' . $contador . '</td>
                                        <td class="text-left">' . $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] .'. (' . $rows['usuario_dni'] . ')</td>
                                        <td class="text-left">' . $rows['bitacora_accion'] . '</td>
                                        <td class="text-left">' . $rows['bitacora_fecha'] . '</td>';

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
            $tabla .= '<p class="text-right">Mostrando bitacora ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    } /*Fin Controlador paginador bitacora*/

}
