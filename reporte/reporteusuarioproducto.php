<?php
//Inicializo los valores en blanco
if (isset($_POST['producto_id']) || isset($_POST['usuario_id'])) {
    $producto_id = $_POST['producto_id'];
    $usuario_id = $_POST['usuario_id'];
} else {
    $producto_id = "";
    $usuario_id = "";
}

$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

//Obtener Operadores
require_once "../controladores/usuarioControlador.php";
$ins_usuario = new usuarioControlador();

//Crear instancia para obtener las productoes
require_once '../controladores/productoControlador.php';
$ins_producto = new productoControlador();



if ($producto_id == "" ||  $usuario_id == "") {
    ?>
    <!DOCTYPE html>

    <html>
        <head>
            <title>Error en reporte</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo COMPANY; ?></title>
            <?php include "../vistas/inc/Link.php"; ?>
        </head>
        <body>
            <div class="col-md-12">

                <!-- start: Content -->
                <center>
                    <div class="page-404 animated flipInX">
                        <img src="../vistas/asset/img/404.png" class="img-responsive"/>
                        <br>
                        <a href="../reporte-activo-usuario/"> Ha ocurrido un error inesperado, clic aqui para regresar
                            </br>
                            <span class="icons icon-arrow-down"></span>
                        </a>
                    </div>
                </center>
                <!-- end: content -->
            </div>
            <?php include "../vistas/inc/Script.php"; ?>
        </body>
    </html>
    <?php
} else {

    //Inicio de codigo para listar las productoes
    $usuario_id = $ins_reporte->descifrar($usuario_id);
    $producto_id = $ins_reporte->descifrar($producto_id);

    if ($usuario_id == 0) { //Todos los operadores
        if ($producto_id == 0) {
            $rs_productoes = $ins_reporte->obtener_activo_controlador("ActivosUsuarios", $usuario_id, $producto_id);
        } else {
            //Actividad especifica
            $rs_productoes = $ins_reporte->obtener_activo_controlador("ActivoEspecifico", $usuario_id, $producto_id);
        
        }
    } else { //Operador en especifico
        if ($producto_id == 0) {
            //Todas las productoes
            $rs_productoes = $ins_reporte->obtener_activo_controlador("UsuarioEspecifico", $usuario_id, $producto_id);
        
        } else {
            //Actividad especifica
            $rs_productoes = $ins_reporte->obtener_activo_controlador("ActivoUsuarioEspecifico", $usuario_id, $producto_id);
        
        }
    }

    //Fin de codigo para listar las productoes


    include 'plantilla_reporte.php';
    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->SetMargins(17, 17, 17);
    // $pdf->SetAutoPageBreak(true,25); Margen inferior
    $pdf->AddPage();

    //Colocar hora y fecha de emision del reporte
    $pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->Cell(0, 10, utf8_decode('Fecha de emisión: ' . $fecha_actual), '', 0, 'R');

    //Colocar enunciado del reporte y el rango de fechas 
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Relacion entre activos y usuarios ")), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de productoes
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('CODIGO'), 1, 0, 'C', false);
    $pdf->Cell(70, 8, utf8_decode('ACTIVO'), 1, 0, 'C', false);
    $pdf->Cell(70, 8, utf8_decode('RESPONSABLE'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    $cont = 0;
    $numero = 1;
    if ($rs_productoes->rowCount() > 0) {


        foreach ($rs_productoes as $rows) {
            $codigo_producto = $rows['producto_codigo'];
            $nombre_producto = $rows['producto_nombre'];
            $nombre_usuario = $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'] . ' (' .  $rows['usuario_dni'] .')';
            $pdf->Cell(10, 6, utf8_decode($numero), 1, 0, 'C');
            $pdf->Cell(40, 6, utf8_decode($codigo_producto), 1, 0, 'L');
            $pdf->Cell(70, 6, utf8_decode($nombre_producto), 1, 0, 'L');
            $pdf->Cell(70, 6, utf8_decode($nombre_usuario), 1, 0, 'L');
            $pdf->Ln(6);
            $cont++;
            $numero +=1;
        }
    }
    $pdf->Ln(6);
    //Total Actividades
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(80, 8, utf8_decode("TOTAL ACTIVOS VINCULADOS"), 1, 0, 'L');
    $pdf->Cell(40, 8, utf8_decode($cont), 1, 0, 'C');
    $pdf->Ln(8);

    $pdf->Output();
}
?>