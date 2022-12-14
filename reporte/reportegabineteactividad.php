<?php
//Inicializo los valores en blanco
if (isset($_POST['actividad_id']) || isset($_POST['gabinete_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $actividad_id = $_POST['actividad_id'];
    $gabinete_id = $_POST['gabinete_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
} else {
    $actividad_id = "";
    $fecha_inicio = "";
    $fecha_fin = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

//Obtener Operadores
require_once "../controladores/gabineteControlador.php";
$ins_gabinete = new gabineteControlador();

//Crear instancia para obtener las actividades
require_once '../controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();

require_once '../controladores/homeControlador.php';
$ins_home = new homeControlador();
//Obtener valores estadisticos para las primeras cuatro cajas
$total_solicitudes = $ins_home->datos_solicitud_controlador("Todos", 0);

if ($actividad_id == "" || $fecha_inicio == "" || $fecha_fin == "" || $gabinete_id == "") {
    ?>
    <!DOCTYPE html>

    <html>
        <head>
            <title>TODO supply a title</title>
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
                        <a href="../reporte-porcentaje/"> Ha ocurrido un error inesperado, clic aqui para regresar
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

    //Inicio de codigo para listar las actividades
    $gabinete_id = $ins_reporte->descifrar($gabinete_id);
    $actividad_id = $ins_reporte->descifrar($actividad_id);

    if ($gabinete_id == 0) { //Todos los operadores
        if ($actividad_id == 0) {
            $rs_actividades = $ins_reporte->obtener_actividad_operador_controlador("ActividadesGabinete", $gabinete_id, $actividad_id, $fecha_inicio, $fecha_fin);
        } else {
            //Actividad especifica
            $rs_actividades = $ins_reporte->obtener_actividad_operador_controlador("ActividadesEspecificaGabinete", $gabinete_id, $actividad_id, $fecha_inicio, $fecha_fin);
        
        }
    } else { //Operador en especifico
        if ($actividad_id == 0) {
            //Todas las actividades
            $rs_actividades = $ins_reporte->obtener_actividad_operador_controlador("ActividadesGabineteEspecifico", $gabinete_id, $actividad_id, $fecha_inicio, $fecha_fin);
        
        } else {
            //Actividad especifica
            $rs_actividades = $ins_reporte->obtener_actividad_operador_controlador("ActividadyGabineteEspecificos", $gabinete_id, $actividad_id, $fecha_inicio, $fecha_fin);
        
        }
    }

    //Fin de codigo para listar las actividades


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
    $pdf->Cell(0, 10, utf8_decode('Fecha de emisi??n: ' . $fecha_actual), '', 0, 'R');

    //Colocar enunciado del reporte y el rango de fechas 
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Actividades por Gabinete desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(50, 8, utf8_decode('GABINETE'), 1, 0, 'C', false);
    $pdf->Cell(70, 8, utf8_decode('ACTIVIDAD'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('INICIO'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('FIN'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    $cont = 0;
    $numero = 1;
    if ($rs_actividades->rowCount() > 0) {


        foreach ($rs_actividades as $rows) {
            $nombre_actividad = $rows['actividad_nombre'];
            $nombre_actividad = substr($nombre_actividad, 0, 45) . "-";
            $pdf->Cell(10, 6, utf8_decode($numero), 1, 0, 'C');
            $pdf->Cell(50, 6, utf8_decode($rows['gabinete_nombre']), 1, 0, 'L');
            $pdf->Cell(70, 6, utf8_decode($nombre_actividad), 1, 0, 'L');
            $pdf->Cell(30, 6, utf8_decode($rows['asignacion_fecha']), 1, 0, 'C');
            $pdf->Cell(30, 6, utf8_decode($rows['solicitud_fin']), 1, 0, 'C');
            $pdf->Ln(6);
            $cont++;
            $numero +=1;
        }
    }
    $pdf->Ln(8);
    //Total Actividades
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 8, utf8_decode("TOTAL ACTIVIDADES"), 1, 0, 'L');
    $pdf->Cell(70, 8, utf8_decode($cont), 1, 0, 'C');
    $pdf->Ln(8);

    $pdf->Output();
}
?>