<?php
//Inicializo los valores en blanco
if (isset($_POST['gabinete_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $gabinete_id = $_POST['gabinete_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
} else {
    $gabinete_id = "";
    $fecha_inicio = "";
    $fecha_fin = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

//Crear instancia para obtener las gabinetes
require_once '../controladores/gabineteControlador.php';
$ins_gabinete = new gabineteControlador();

require_once '../controladores/homeControlador.php';
$ins_home = new homeControlador();
//Obtener valores estadisticos para las primeras cuatro cajas
$total_solicitudes = $ins_home->datos_solicitud_controlador("Todos", 0);

if ($gabinete_id == "" || $fecha_inicio == "" || $fecha_fin == "") {
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

    //Inicio de codigo para listar las gabinetees
    $gabinete_id = $ins_reporte->descifrar($gabinete_id);

    if ($gabinete_id == 0) {
        //Todos los estados y todas las gabinetees
        $gabinetes = $ins_gabinete->datos_gabinete_controlador("Todos", 0);
    } else {
        //Todos los estados para una unica gabinete
        $gabinetes = $ins_gabinete->datos_gabinete_controlador("Unico", $ins_gabinete->encryption($gabinete_id));
    }

    //Fin de codigo para listar las gabinetees


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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Solicitudes por Gabinete desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de gabinetees
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(106, 8, utf8_decode('GABINETE'), 1, 0, 'C', false);
    $pdf->Cell(35, 8, utf8_decode('SOLICITUDES'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('PORCENTAJE'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    $total = 0;
    $cont = 1;
    if ($gabinetes->rowCount() > 0) {
        $gabinetes = $gabinetes->fetchAll();

        foreach ($gabinetes as $rows) {

            $recurrencia_gabinete = $ins_home->obtener_recurrencia_fecha_controlador("Gabinete", $rows['gabinete_id'], $fecha_inicio, $fecha_fin);
            $porcentante_recurrencia_gabinete = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_gabinete->rowCount());

            if ($porcentante_recurrencia_gabinete != 0) {
                $total += $recurrencia_gabinete->rowCount();
                $pdf->Cell(10, 6, utf8_decode($cont), 1, 0, 'C');
                $pdf->Cell(106, 6, utf8_decode($rows['gabinete_nombre']), 1, 0, 'L');
                $pdf->Cell(35, 6, utf8_decode($recurrencia_gabinete->rowCount()), 1, 0, 'R');
                $pdf->Cell(30, 6, utf8_decode(number_format($porcentante_recurrencia_gabinete, 2, ",", ".") . "%"), 1, 0, 'R');
                $pdf->Ln(6);
                $cont +=1;
            }
        }
    }

    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(81, 8, utf8_decode('SOLICITUDES ' . $fecha_inicio .' - '. $fecha_fin), 1, 0, 'C', false);
    $pdf->Cell(35, 8, utf8_decode('TOTAL'), 1, 0, 'R', false);
    $pdf->Cell(35, 8, utf8_decode($total), 1, 0, 'R', false);
    $pdf->Ln(8);

    $pdf->Output();
}
?>