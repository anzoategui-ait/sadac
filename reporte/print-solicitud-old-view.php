<?php
//Inicializo los valores en blanco
if (isset($_GET['solicitud_id'])) {
    $solicitud_id = $_GET['solicitud_id'];
}else {
    $solicitud_id = "";
}

$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

if ($solicitud_id == "") {
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
    /* Inicio de Codigo */
    //Obtener los datos de los usuarios, sobre todo la direccion y el cargo de quien hace la solicitud.
    $detalle_solicitud = $ins_reporte->datos_solicitud_controlador("DetalleSolicitud", $solicitud_id);
    
    $solicitante = "";
    $cargo = "";
    $direccion = "";
    $descripcion = "";
    
    if($detalle_solicitud->rowCount()>0){
        $detalle_solicitud=$detalle_solicitud->fetch();
        $solicitante = $detalle_solicitud['usuario_nombre'] . ', ' . $detalle_solicitud['usuario_apellido'];
        $solicitante =substr($solicitante, 0, 55) . ".";
        $cargo = $detalle_solicitud['cargo_nombre'];
        $cargo = substr($cargo, 0, 30) . ".";
        $direccion = $detalle_solicitud['direccion_nombre'];
        $direccion = substr($direccion, 0, 30) . ".";
    $descripcion = $detalle_solicitud['solicitud_descripcion'];
    }
    
    //Obtener todas las actividades relacionadas a una solicitud
    $res_solicitudes = $ins_reporte->datos_solicitud_controlador("ActividadesSolicitud", $solicitud_id);
    /* Fin de codigo */

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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Solicitud No.: " . $ins_reporte->descifrar($solicitud_id))), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(3, 119, 234);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(82, 10, utf8_decode('SOLICITANTE'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, utf8_decode('CARGO'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, utf8_decode('DIRECCION'), 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(82, 8, utf8_decode($solicitante), 1, 0, 'L');
    $pdf->Cell(50, 8, utf8_decode($cargo), 1, 0, 'C');
    $pdf->Cell(50, 8, utf8_decode($direccion), 1, 0, 'C');
    $pdf->Ln(8);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(182, 10, utf8_decode('DESCRIPCION DE LA SOLICITUD'), 1, 0, 'C', true);
    $pdf->Ln(10);
     $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 8, utf8_decode($descripcion), 'LRB', 'L', false);
    

    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(3, 119, 234);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(92, 10, utf8_decode('ACTIVIDAD'), 1, 0, 'C', true);
    $pdf->Cell(20, 10, utf8_decode('ESTADO'), 1, 0, 'C', true);
    $pdf->Cell(35, 10, utf8_decode('INICIO'), 1, 0, 'C', true);
    $pdf->Cell(35, 10, utf8_decode('FIN'), 1, 0, 'C', true);
    $pdf->Ln(10);

    if ($res_solicitudes->rowCount() > 0) {

        $res_solicitudes = $res_solicitudes->fetchAll();
        $pdf->SetFont('Arial', '', 10);
        foreach ($res_solicitudes as $rows) {
            $nombre_actividad = $rows['actividad_nombre'];
            $nombre_actividad = substr($nombre_actividad, 0, 50) . ".";

            $pdf->Cell(92, 8, utf8_decode($nombre_actividad), 1, 0, 'L');
            $pdf->Cell(20, 8, utf8_decode($rows['solicitud_estado']), 1, 0, 'C');
            $pdf->Cell(35, 8, utf8_decode($rows['solicitud_inicio']), 1, 0, 'C');
            $pdf->Cell(35, 8, utf8_decode($rows['solicitud_fin']), 1, 0, 'C');
            $pdf->Ln(8);
        }
    }




    $pdf->Output();
}
?>