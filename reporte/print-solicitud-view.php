<?php
//Inicializo los valores en blanco
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
}else {
    /* Inicio de Codigo */
    //Obtener los datos de los usuarios, sobre todo la direccion y el cargo de quien hace la solicitud.
    $detalle_solicitud = $ins_reporte->datos_solicitud_controlador("DetalleSolicitudCiudadano", $solicitud_id);
    
    $solicitante = "";
    $cargo = "";
    $direccion = "";
    $descripcion = "";
    $estado_solicitud = "";
    
    if($detalle_solicitud->rowCount()>0){
        $detalle_solicitud=$detalle_solicitud->fetch();
        $solicitante = $detalle_solicitud['usuario_nombre'] . ', ' . $detalle_solicitud['usuario_apellido'] . ' C.I: ' . $detalle_solicitud['usuario_dni'];
        $solicitante =substr($solicitante, 0, 55) . ".";
        $telefono = $detalle_solicitud['usuario_telefono'];
        $telefono = substr($telefono, 0, 30);
        $correo = $detalle_solicitud['usuario_email'];
        $correo = substr($correo, 0, 30);
        $estado_solicitud = $detalle_solicitud['solicitud_estado'];
       $descripcion = $detalle_solicitud['solicitud_descripcion'] . ". Fecha de la Solicitud: " . $detalle_solicitud['solicitud_inicio'];
    }
    
    //Obtener todas las actividades relacionadas a una solicitud
    $res_solicitudes = $ins_reporte->datos_solicitud_controlador("ActividadesSolicitud", $solicitud_id);
    /* Fin de codigo */

     include 'solicitud_plantilla.php';
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
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 14);
    //$pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(0, 10, utf8_decode("Solicitud # " . number_format($ins_reporte->descifrar($solicitud_id), 0, ",", ".")), 0, 0, 'R');
    $pdf->Ln(10);
    
    //DATOS DEL SOLICITANTE
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(82, 6, utf8_decode("CIUDADANO: "), 0, 0, 'L');
    $pdf->Ln(6);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(82, 6, utf8_decode($solicitante), 1, 0, 'L');
    $pdf->Ln(6);
    $pdf->Cell(82, 6, utf8_decode("Telefono: " . $telefono), 1, 0, 'L');
    $pdf->Ln(6);
    $pdf->Cell(82, 6, utf8_decode("Correo: " . $correo), 1, 0, 'L');
    $pdf->Ln(10);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
  
    $pdf->Ln(5);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    
    $pdf->Cell(182, 10, utf8_decode('DESCRIPCION DE LA SOLICITUD: '), 1, 0, 'L', false);
    $pdf->Ln(10);
    
    $pdf->SetTextColor(33, 33, 33);
     $pdf->SetFont('Arial', '', 10);
     
     $pdf->MultiCell(182, 5, utf8_decode($descripcion . '. Estado de la Solicitud: ' . $estado_solicitud), 1, 'L');
    

    //$pdf->Ln(5);
     $pdf->Ln(10);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    
    $pdf->Cell(182, 10, utf8_decode('DESCRIPCION DE LA ACTIVIDAD:'), 1, 0, 'L', false);
    $pdf->SetFont('Arial', '', 10);

     $pdf->Ln(10);
    //Titulos de cada columna de la tabla de actividades
    

    if ($res_solicitudes->rowCount() > 0) {

        $res_solicitudes = $res_solicitudes->fetchAll();
        $pdf->SetFont('Arial', '', 10);
        foreach ($res_solicitudes as $rows) {
            $nombre_actividad = $rows['actividad_nombre'];
           // $nombre_actividad = substr($nombre_actividad, 0, 50) . ".";
            
            
            $pdf->MultiCell(182, 6, utf8_decode($nombre_actividad . ". Estado Actividad: " . $rows['solicitud_estado'] . ". Fecha de Inicio: " . $rows['solicitud_inicio'] . " - Fecha Fin: " . $rows['solicitud_fin']), 1, 'L');

        }
    } else {
           // $pdf->Cell(50, 10, utf8_decode(''), 0, 0, 'L');
            $pdf->MultiCell(182, 6, utf8_decode("Su solicitud fue enviada satisfactoriamente, espere que pronto nos comunicaremos con usted, gracias por utilizar nuestra plataforma tecnologica."), 1, 'L');

    }

    $pdf->Output();
}
?>