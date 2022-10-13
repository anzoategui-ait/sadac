<?php

if ($peticionAjax) {
    require_once "../modelos/productoModelo.php";
} else {
    require_once "./modelos/productoModelo.php";
}

class productoControlador extends productoModelo {
    /* Controlador para agregar un producto */

    public function agregar_producto_controlador() {
        /* == Almacenando datos == */
        $codigo = mainModel::limpiar_cadena($_POST['producto_codigo_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['producto_nombre_reg']);
        $unidad = mainModel::limpiar_cadena($_POST['producto_unidad_reg']);

        $precio = mainModel::limpiar_cadena($_POST['producto_precio_reg']);
        $stock = mainModel::limpiar_cadena($_POST['producto_stock_reg']);
        $categoria = mainModel::decryption($_POST['producto_kategoria_reg']);
        $categoria = mainModel::limpiar_cadena($categoria);

        /* == Verificando campos obligatorios == */
        if ($codigo == "" || $nombre == "" || $unidad=="" || $precio == "" || $stock == "" || $categoria == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9- ]{1,70}", $codigo)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El CODIGO de BARRAS no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}", $nombre)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El NOMBRE del producto no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}", $unidad)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El NOMBRE de la UNIDAD de Medida no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9.]{1,30}", $precio)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El PRECIO no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9.]{1,30}", $stock)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El STOCK no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* == Verificando codigo == */
        $check_codigo = mainModel::ejecutar_consulta_simple("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
        if ($check_codigo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_codigo = null;

        /* == Verificando nombre == */
        $check_nombre = mainModel::ejecutar_consulta_simple("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
        if ($check_nombre->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El NOMBRE ingresado ya se encuentra registrado, por favor elija otro",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_nombre = null;

        /* == Verificando categoria == */
        $check_categoria = mainModel::ejecutar_consulta_simple("SELECT kategoria_id FROM kategoria WHERE kategoria_id='$categoria'");
        if ($check_categoria->rowCount() <= 0) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La CATEGORIA seleccionada no existe",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $check_categoria = null;

        /* Directorios de imagenes */
        $img_dir = '../vistas/img/producto/';

        /* == Comprobando si se ha seleccionado una imagen == */
        if ($_FILES['producto_foto_reg']['name'] != "" && $_FILES['producto_foto_reg']['size'] > 0) {

            /* Creando directorio de imagenes */
            if (!file_exists($img_dir)) {
                if (!mkdir($img_dir, 0777)) {

                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ha ocurrido un error inesperado",
                        "Texto" => "Error al crear el directorio de imagenes",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            }

            /* Comprobando formato de las imagenes */
            if (mime_content_type($_FILES['producto_foto_reg']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['producto_foto_reg']['tmp_name']) != "image/png") {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La imagen que ha seleccionado es de un formato que no está permitido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }


            /* Comprobando que la imagen no supere el peso permitido */
            if (($_FILES['producto_foto_reg']['size'] / 1024) > 3072) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La imagen que ha seleccionado supera el límite de peso permitido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }


            /* extencion de las imagenes */
            switch (mime_content_type($_FILES['producto_foto_reg']['tmp_name'])) {
                case 'image/jpeg':
                    $img_ext = ".jpg";
                    break;
                case 'image/png':
                    $img_ext = ".png";
                    break;
            }

            /* Cambiando permisos al directorio */
            chmod($img_dir, 0777);

            /* Nombre de la imagen */
            $img_nombre = mainModel::renombrar_fotos($nombre);

            /* Nombre final de la imagen */
            $foto = $img_nombre . $img_ext;

            /* Moviendo imagen al directorio */
            if (!move_uploaded_file($_FILES['producto_foto_reg']['tmp_name'], $img_dir . $foto)) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No podemos subir la imagen al sistema en este momento, por favor intente nuevamente",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        } else {
            $foto = "";
        }

        /* == Guardando datos == */
        session_start(['name' => 'TOR']);

        $datos_producto_reg = [
            "codigo" => $codigo,
            "nombre" => $nombre,
            "unidad" => $unidad,
            "precio" => $precio,
            "stock" => $stock,
            "foto" => $foto,
            "categoria" => $categoria,
            "usuario" => $_SESSION['id_tor']
        ];

        $guardar_producto = productoModelo::agregar_producto_modelo($datos_producto_reg);

        if ($guardar_producto->rowCount() == 1) {

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "¡PRODUCTO REGISTRADO!",
                "Texto" => "El producto se registro con exito",
                "Tipo" => "success"
            ];
        } else {

            if (is_file($img_dir . $foto)) { //Si hubo un error, consultar si la imagen se cargo para eliminarla del servidor
                chmod($img_dir . $foto, 0777);
                unlink($img_dir . $foto);
            }

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo registrar el producto, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
    }

    /* Fin Controlador */

    /* Controlador para listar y buscar los productos en una tabla */

    public function paginador_producto_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda, $categoria_id) {

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

        $campos = "producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_precio,producto.producto_stock,producto.producto_foto,producto.kategoria_id,producto.usuario_id,kategoria.kategoria_id,kategoria.kategoria_nombre,usuario.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido";

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS $campos FROM producto INNER JOIN kategoria ON producto.kategoria_id=kategoria.kategoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.producto_codigo LIKE '%$busqueda%' OR producto.producto_nombre LIKE '%$busqueda%' OR kategoria.kategoria_nombre LIKE '%$busqueda%' OR kategoria.kategoria_id LIKE '%$busqueda%' OR usuario.usuario_nombre LIKE '%$busqueda%' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
        } elseif ($categoria_id > 0) {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS $campos FROM producto INNER JOIN kategoria ON producto.kategoria_id=kategoria.kategoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.kategoria_id='$categoria_id' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS $campos FROM producto INNER JOIN kategoria ON producto.kategoria_id=kategoria.kategoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
        }

        $conexion = mainModel::conectar(); //creamos nuestra con conexion con el modelo principal
        $datos = $conexion->query($consulta); //ejecutamos la consulta a traves de un query, que se usa para ejecutar la consulta
        $datos = $datos->fetchAll(); //fetchAll para crear un array con todos los datos obtenidos de la base de datos

        $total = $conexion->query("SELECT FOUND_ROWS()"); //Para contar todos los registros de mi consulta a la base de datos, pero en la consulta debe de ir SQL_CALC_FOUND_ROWS despues del SELECT
        $total = (int) $total->fetchColumn(); //luego de la consulta anterior con esto se cuenta cuantos registros hay en la base de datos

        $Npaginas = ceil($total / $registros); //Funcion PHP Para redondear los numeros de paginas que devuelve el llamado a la base de datos a su numero mas proximo

        //Encabezado de la tabla
         $tabla .= '<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<tr class="text-center roboto-medium">
					<th>#</th><th>IMAGEN</th>
					<th>CODIGO</th>
					<th>NOMBRE</th>
                                        <th>PRECIO</th>
					<th>STOCK</th>
					<th>CATEGORIA</th>
                                        <th>REGISTRADO</th><th colspan="3">OPCIONES</th>';
        
        $tabla .= '</tr>
			</thead>
			<tbody>';
        //Fin encabezado de la tabla
        
        
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                //INICIO CICLO TABLA
                $tabla .= '<tr class="text-center" >
					<td>' . $contador . '</td>
                                        <td>';
                if (is_file("./vistas/img/producto/" . $rows['producto_foto'])) {
                    $tabla .= '<img src="' . SERVERURL . 'vistas/img/producto/' . $rows['producto_foto'] . '" class="img-fluid" alt="Avatar" style="width: 45%">';
                    
                                       
                } else {
                    $tabla .= '<img src="'.SERVERURL.'vistas/img/producto.png" class="img-fluid" alt="Avatar" style="width: 50%">';
                }
                                        
                                         
                                        $tabla.='</td>
                                        <td>' . $rows['producto_codigo'] . '</td>
                                        <td>' . $rows['producto_nombre'] . '</td>
                                        <td>' . $rows['producto_precio'] . '</td>
                                        <td>' . $rows['producto_stock'] . '</td>
                                        <td>' . $rows['kategoria_nombre'] . '</td>
                                        <td>' . $rows['usuario_nombre']. ' ' . $rows['usuario_apellido']. '</td>
                                         <td>
                                          <a href="' . SERVERURL . 'producto-imagen/' . mainModel::encryption($rows['producto_id']) . '/"  class="btn btn-3d btn-info"><i class="fa fa-search"></i></a>
                                        </td> 
                                         <td>
                                         <a href="' . SERVERURL . 'producto-update/' . mainModel::encryption($rows['producto_id']) . '/" class="btn btn-3d btn-success"><i class="fa fa-refresh"></i></a>
                                         </td>
                                         <td>
                                         <form class="FormularioAjax" action="' . SERVERURL . 'ajax/productoAjax.php" method="POST" data-form="delete" autocomplete="off">
                                           <input type="hidden" name="producto_id_del" value="' . mainModel::encryption($rows['producto_id']) . '"> 
                                            <button type="submit" class="btn btn-3d btn-danger">
                                                <span class="fa fa-trash"></span></button>
                                        </form>
                                        </td>';

                

                $tabla .= ' </tr>';
                $contador ++;
                //FIN CICLO TABLA
                
                
                
                $contador++;
            }
            
            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="8"><a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Haga clic aca para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="8">No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= '</tbody></table></div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-right">Mostrando producto ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';

            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        }

        return $tabla;
    }

    /* Fin del Controlador */

    /* Controlador para eliminar un producto */

    public function eliminar_imagen_producto_controlador($id) {
        /* --- recibiendo id del producto --- */
        $id = mainModel::decryption($_POST['imagen_producto_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobar que exista el producto en la base de datos */
        $check_producto = mainModel::ejecutar_consulta_simple("SELECT producto_id, producto_foto FROM producto WHERE producto_id='$id'");
        if ($check_producto->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "La imagen del producto que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $check_producto->fetch();
        }

        /* Comprobar si existen otras tablas donde el producto este relacionado */
        /**         * ******************************************************************* * */
     
        /* Comprobar privilegios del producto que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar esta imagen",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /* Directorios de imagenes */
        $img_dir = '../vistas/img/producto/';

        /* Cambiando permisos al directorio */
        chmod($img_dir, 0777);

        /* Eliminando la imagen */
        if (is_file($img_dir . $datos['producto_foto'])) {

            chmod($img_dir . $datos['producto_foto'], 0777);

            if (!unlink($img_dir . $datos['producto_foto'])) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Error al intentar eliminar la imagen del producto, por favor intente nuevamente",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        $datos_imagen_up = [
            "foto" => "",
            "id" => $id
        ];

        if (productoModelo::actualizar_imagen_producto_modelo($datos_imagen_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "¡IMAGEN O FOTO ELIMINADA!",
                "Texto" => "Se ha eliminado satisfactoriamente la imagen de este producto.",
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

    /* Fin del Controlador */


    /* Controlador para eliminar la imagen de un producto */

    public function eliminar_producto_controlador($id) {
        /* --- recibiendo id del producto --- */
        $id = mainModel::decryption($_POST['producto_id_del']);
        $id = mainModel::limpiar_cadena($id);

        /* Comprobando el producto principal */


        /* Comprobar que exista el producto en la base de datos */
        $check_producto = mainModel::ejecutar_consulta_simple("SELECT producto_id, producto_foto FROM producto WHERE producto_id='$id'");
        if ($check_producto->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El producto que intenta eliminar no esta registrado en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $check_producto->fetch();
        }

        /* Comprobar si existen otras tablas donde el producto este relacionado */
        /**         * ******************************************************************* * */
           $check_compra = mainModel::ejecutar_consulta_simple("SELECT compra_id FROM compra WHERE producto_id='$id' LIMIT 0,1");
        if ($check_compra->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar el producto porque esta relacionado con una compra, elimine la compra he intentelo nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
          $check_salida = mainModel::ejecutar_consulta_simple("SELECT salida_detalle_id FROM salida_detalle WHERE producto_id='$id' LIMIT 0,1");
        if ($check_salida->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se puede eliminar el producto porque esta relacionado con una salida, elimine la salida he intentelo nuevamente.",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        /* Comprobar privilegios del producto que esta intentado eliminar  */
        session_start(['name' => 'TOR']);
        if ($_SESSION['privilegio_tor'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No tienes los permisos suficientes para eliminar este producto",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_producto = productoModelo::eliminar_producto_modelo($id);

        if ($eliminar_producto->rowCount() == 1) {

            if (is_file("../vistas/img/producto/" . $datos['producto_foto'])) {
                chmod("../vistas/img/producto/" . $datos['producto_foto'], 0777);
                unlink("../vistas/img/producto/" . $datos['producto_foto']);
            }

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Producto Eliminado",
                "Texto" => "El registro ha sido eliminado del sistema satisfactoriamente",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se ha podido eliminar el producto, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /* Fin del Controlador */

    /* Controlador para obtener los datos del producto */

    public function datos_producto_controlador($tipo, $id) {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return productoModelo::datos_producto_modelo($tipo, $id);
    }

    /* Fin controlador datos producto */

    /* Controlador para actualizar los datos de un producto */

    public function actualizar_producto_controlador() {
        /* == Almacenando id == */
        $id = mainModel::decryption($_POST['producto_id_up']);
        $id = mainModel::limpiar_cadena($id);

        /* == Verificando producto == */

        $check_producto = mainModel::ejecutar_consulta_simple("SELECT * FROM producto WHERE producto_id='$id'");

        if ($check_producto->rowCount() <= 0) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El Producto no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $datos = $check_producto->fetch();
        }
        $check_producto = null;

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


        /* == Almacenando datos == */
        $codigo = mainModel::limpiar_cadena($_POST['producto_codigo_up']);
        $nombre = mainModel::limpiar_cadena($_POST['producto_nombre_up']);
        $unidad = mainModel::limpiar_cadena($_POST['producto_unidad_up']);
        $precio = mainModel::limpiar_cadena($_POST['producto_precio_up']);
        $stock = mainModel::limpiar_cadena($_POST['producto_stock_up']);
        $categoria = mainModel::limpiar_cadena($_POST['producto_kategoria_up']);

        /* == Verificando campos obligatorios == */
        if ($codigo == "" || $nombre == "" || $unidad==""|| $precio == "" || $stock == "" || $categoria == "") {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No has llenado todoslos campos que son obligatorios",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* == Verificando integridad de los datos == */
        if (mainModel::verificar_datos("[a-zA-Z0-9- ]{1,70}", $codigo)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El CODIGO de BARRAS no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}", $nombre)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El NOMBRE no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,50}", $unidad)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El NOMBRE de la UNIDAD de Medida no coincide con el formato solicitado: " . $unidad,
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9.]{1,25}", $precio)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El PRECIO no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[0-9.]{1,30}", $stock)) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "El STOCK no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /* == Verificando codigo == */
        if ($codigo != $datos['producto_codigo']) {
            $check_codigo = mainModel::ejecutar_consulta_simple("SELECT producto_codigo FROM producto WHERE producto_codigo='$codigo'");
            if ($check_codigo->rowCount() > 0) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_codigo = null;
        }


        /* == Verificando nombre == */
        if ($nombre != $datos['producto_nombre']) {
            $check_nombre = mainModel::ejecutar_consulta_simple("SELECT producto_nombre FROM producto WHERE producto_nombre='$nombre'");
            if ($check_nombre->rowCount() > 0) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "El NOMBRE ingresado ya se encuentra registrado, por favor elija otro",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_nombre = null;
        }


        /* == Verificando categoria == */
        if ($categoria != $datos['kategoria_id']) {
            $check_categoria = mainModel::ejecutar_consulta_simple("SELECT kategoria_id FROM kategoria WHERE kategoria_id='$categoria'");
            if ($check_categoria->rowCount() <= 0) {

                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La categoría seleccionada no existe",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_categoria = null;
        }


        /* == Actualizando datos == */

        $datos_producto_up = [
            "codigo" => $codigo,
            "nombre" => $nombre,
            "unidad" => $unidad,
            "precio" => $precio,
            "stock" => $stock,
            "categoria" => $categoria,
            "id" => $id
        ];

        if (productoModelo::actualizar_producto_modelo($datos_producto_up)) {
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

    /* Controlador para actualizar la imagen de un producto */

    public function actualizar_imagen_controlador() {
        /* == Almacenando datos == */
        $product_id = mainModel::decryption($_POST['imagen_id_up']);
        $product_id = mainModel::limpiar_cadena($product_id);

        /* == Verificando producto == */

        $check_producto = mainModel::ejecutar_consulta_simple("SELECT * FROM producto WHERE producto_id='$product_id'");

        if ($check_producto->rowCount() == 1) {
            $datos = $check_producto->fetch();
        } else {
           
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La imagen del PRODUCTO que intenta actualizar no existe",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
        }
        $check_producto = null;
        
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
        
         //fino

        /* == Comprobando si se ha seleccionado una imagen == */
        if ($_FILES['producto_foto']['name'] == "" || $_FILES['producto_foto']['size'] == 0) {
           
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No ha seleccionado ninguna imagen o foto",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
            exit();
        }

       //fino

        /* Directorios de imagenes */
        $img_dir = '../vistas/img/producto/';

        /* Creando directorio de imagenes */
        if (!file_exists($img_dir)) {
            if (!mkdir($img_dir, 0777)) {
             
                 $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "Al crear el directorio de imagenes",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

     //fino

        /* Cambiando permisos al directorio */
        chmod($img_dir, 0777);

        /* Comprobando formato de las imagenes */
        if (mime_content_type($_FILES['producto_foto']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name']) != "image/png") {
         
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La imagen que ha seleccionado es de un formato que no está permitido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
            exit();
        }

           //fino

        /* Comprobando que la imagen no supere el peso permitido */
        if (($_FILES['producto_foto']['size'] / 1024) > 3072) {
          
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "La imagen que ha seleccionado supera el límite de peso permitido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
            exit();
        }

         //fino

        /* extencion de las imagenes */
        switch (mime_content_type($_FILES['producto_foto']['tmp_name'])) {
            case 'image/jpeg':
                $img_ext = ".jpg";
                break;
            case 'image/png':
                $img_ext = ".png";
                break;
        }

        /* Nombre de la imagen */
        $img_nombre = mainModel::renombrar_fotos($datos['producto_nombre']);

        /* Nombre final de la imagen */
        $foto = $img_nombre . $img_ext;

        /* Moviendo imagen al directorio */
        if (!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir . $foto)) {
         
            $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ha ocurrido un error inesperado",
                    "Texto" => "No podemos subir la imagen al sistema en este momento, por favor intente nuevamente",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
            exit();
        }


        /* Eliminando la imagen anterior */
        if (is_file($img_dir . $datos['producto_foto']) && $datos['producto_foto'] != $foto) {

            chmod($img_dir . $datos['producto_foto'], 0777);
            unlink($img_dir . $datos['producto_foto']);
        }


        /* == Actualizando datos == */

        $datos_imagen_up = [
            "foto" => $foto,
            "id" => $product_id
        ];

        if (productoModelo::actualizar_imagen_producto_modelo($datos_imagen_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "¡IMAGEN O FOTO ACTUALIZADA!",
                "Texto" => "La imagen del producto ha sido actualizada exitosamente, pulse Aceptar para recargar los cambios.",
                "Tipo" => "success"
            ];
        } else {
            if (is_file($img_dir . $foto)) {
                chmod($img_dir . $foto, 0777);
                unlink($img_dir . $foto);
            }

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No podemos subir la imagen al sistema en este momento, por favor intente nuevamente",
                "Tipo" => "error"
            ];
        }
        $actualizar_producto = null;
        echo json_encode($alerta);

        
    }

    /* Fin del Controlador */
}
