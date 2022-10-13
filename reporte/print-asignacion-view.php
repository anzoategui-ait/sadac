<?php
//Inicializo los valores en blanco
if (isset($_GET['asignacion_id'])) {
    $asignacion_id = $_GET['asignacion_id'];
} else {
    $asignacion_id = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

if ($asignacion_id == "") {
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

    //Obtener los datos de los detalles de la asignacion.
    $detalle_asignacion = $ins_reporte->datos_solicitud_controlador("DetalleAsignacion", $asignacion_id);

    $operador = "";
    $supervisor = "";
    $actividad = "";
    $fecha_asignacion = "";
    $fecha_finalizacion = "";
    $observacion_supervisor = "";
    $descripcion_solicitud = "";
    $solicitud_actividad_id = 0;

    if ($detalle_asignacion->rowCount() > 0) {
        $detalle_asignacion = $detalle_asignacion->fetch();
        $operador = $detalle_asignacion['operador_nombre'] . ', ' . $detalle_asignacion['operador_apellido'];
        $supervisor = $detalle_asignacion['supervisor_nombre'] . ', ' . $detalle_asignacion['supervisor_apellido'];
        $actividad = $detalle_asignacion['actividad_nombre'];
        $fecha_asignacion = $detalle_asignacion['asignacion_fecha'];
        $fecha_finalizacion = $detalle_asignacion['solicitud_fin'];
        $observacion_supervisor = $detalle_asignacion['asignacion_observacion'];
        $solicitud_actividad_id = $detalle_asignacion['solicitud_actividad'];
        //Obtener la descripcion de la solicitud realizada
        $detalle_descrip_solicitud = $ins_reporte->datos_solicitud_controlador("DescripcionSolicitud", $ins_reporte->encryption($solicitud_actividad_id));
        if($detalle_descrip_solicitud->rowCount()>0){
            $detalle_descrip_solicitud = $detalle_descrip_solicitud->fetch();
            $descripcion_solicitud = $detalle_descrip_solicitud['solicitud_descripcion'];
        }
    }

    //Obtener los datos de los detalles de la persona solicitante de la actividad.
    $detalle_solicitante = $ins_reporte->datos_solicitud_controlador("DetalleSolicitante", $asignacion_id);
    $solicitante = "";

    if ($detalle_solicitante->rowCount() > 0) {
        $detalle_solicitante = $detalle_solicitante->fetch();
        $solicitante = $detalle_solicitante['usuario_nombre'] . ', ' . $detalle_solicitante['usuario_apellido'] . ' (' . $detalle_solicitante['usuario_dni'] . ')';
    }

    //Obtener todos los paso realizados por actividad
    $pasos = $ins_reporte->datos_solicitud_controlador("PasosActividad", $asignacion_id);

    //Obtener las imagenes asociadas a la realizacion de esta asignacion
    $imagenes = $ins_reporte->datos_solicitud_controlador("ImagenesActividad", $asignacion_id);

    /* Fin de codigo */

    include 'plantilla_reporte.php';
    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->SetMargins(17, 10, 17);
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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Asignacion # " . $ins_reporte->descifrar($asignacion_id))), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(62, 8, utf8_decode('SOLICITANTE'), 1, 0, 'C', false);
    $pdf->Cell(60, 8, utf8_decode('OPERADOR'), 1, 0, 'C', false);
    $pdf->Cell(60, 8, utf8_decode('SUPERVISOR'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(62, 6, utf8_decode($solicitante), 1, 0, 'L');
    $pdf->Cell(60, 6, utf8_decode($operador), 1, 0, 'C');
    $pdf->Cell(60, 6, utf8_decode($supervisor), 1, 0, 'C');
    $pdf->Ln(6);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(182, 8, utf8_decode('DESCRIPCION DE LA SOLICITUD'), 1, 0, 'L', false);
    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(0, 6, utf8_decode($descripcion_solicitud), 'LRB', 'L', false);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(182, 8, utf8_decode('ACTIVIDAD'), 1, 0, 'L', false);
    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(0, 6, utf8_decode($actividad. " / Actividad Asignada: " .$fecha_asignacion . " - Actividad Finalizada: " . $fecha_finalizacion), 'LRB', 'L', false);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(182, 8, utf8_decode('OBSERVACION SUPERVISOR'), 1, 0, 'L', false);
    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(0, 6, utf8_decode($observacion_supervisor), 'LRB', 'L', false);

    $pdf->Ln(10);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', '', 10);

    $cont = 1;
    if ($pasos->rowCount() > 0) {
        $pasos = $pasos->fetchAll();
        foreach ($pasos as $rows) {
            $pdf->MultiCell(0, 8, utf8_decode("PASO " . $cont . ": " . $rows['paso_nombre']), 'LRBT', 'L', false);
            $pdf->MultiCell(0, 8, utf8_decode("OBSERVACION: " . $rows['procesar_observacion']), 'LRB', 'L', false);
            $cont++;
        }
    }
    $cont = 0;

    $pdf->Ln(5);
    $pdf->AddPage();
    
    //RESPALDO FOTOGRAFICO
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(0, 10, utf8_decode("RESPALDO FOTOGRAFICO, ASIGNACION No: " . $ins_reporte->descifrar($asignacion_id)), 0, 0, 'L');
    $pdf->Ln(15);

   
    if ($imagenes->rowCount() > 0) {
        $imagenes = $imagenes->fetchAll();
        $salto=1;
        foreach ($imagenes as $imagen) {
            $pdf->Cell(90, 60, $pdf->Image("../imagenes/" . $imagen['imagen_nombre'], $pdf->GetX(), $pdf->GetY(), 90), 0, 0, 'L', false);
            if($salto == 2){
              $pdf->Ln(70);  
              $salto=0;
            } 
            $salto++;
             
        }
    }
    $pdf->Ln(10);

    $pdf->Output();
}
?>