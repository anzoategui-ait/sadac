<?php

    $usuario = 0;
    $fecha_inicio = "";
    $fecha_fin = "";

//Inicializo los valores en blanco
if (isset($_POST['usuario_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $usuario = $_POST['usuario_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();


if ($usuario == "" || $fecha_inicio == "" || $fecha_fin == "") {
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

    //Inicio de codigo para listar las usuarios
   
                //inicio de municpio diferente
                if ($usuario == 0) { //Todas los usuarios
                    $rs_ciudadanos = $ins_reporte->obtener_turnos_controlador("Turnos", $usuario, $fecha_inicio , $fecha_fin);
                     } else { //usuario especifico
                        $rs_ciudadanos = $ins_reporte->obtener_turnos_controlador("TurnosEspecificos", $usuario, $fecha_inicio , $fecha_fin);
                   }
               
    //Fin de codigo para listar las parroquiaes


    include 'plantilla_horizontal.php';
    $pdf = new PDF('L', 'mm', 'Letter');
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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Ciudadanos con fecha de nacimiento, desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de parroquiaes
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(25, 8, utf8_decode('CEDULA'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('CIUDADANO'), 1, 0, 'C', false);
    $pdf->Cell(85, 8, utf8_decode('MOTIVO'), 1, 0, 'C', false);
    $pdf->Cell(20, 8, utf8_decode('ESTADO'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('OPERADOR'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('FECHA'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    $cont = 0;
    $numero = 1;
    if ($rs_ciudadanos->rowCount() > 0) {
        $rs_ciudadanos=$rs_ciudadanos->fetchAll();

        foreach ($rs_ciudadanos as $rows) {
            $nombre_ciudadano = $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'];
            $nombre_ciudadano = substr($nombre_ciudadano, 0, 28) . "_";

           $nombre_turno = $rows['turno_nombre'];
            $nombre_turno = substr($nombre_turno, 0, 28) . "_";

            $nombre_motivo = $rows['turno_descripcion'];
            $nombre_motivo = substr($nombre_motivo, 0, 60) . ".";

            $pdf->Cell(10, 6, utf8_decode($numero), 1, 0, 'C');
            $pdf->Cell(25, 6, utf8_decode($rows['turno_cedula']), 1, 0, 'L');
            $pdf->Cell(40, 6, utf8_decode($nombre_turno), 1, 0, 'L');
            $pdf->Cell(85, 6, utf8_decode($nombre_motivo), 1, 0, 'L');
            $pdf->Cell(20, 6, utf8_decode($rows['turno_estado']), 1, 0, 'L', false);
            $pdf->Cell(40, 6, utf8_decode($nombre_ciudadano), 1, 0, 'L', false);
            $pdf->Cell(30, 6, utf8_decode($rows['turno_fecha']), 1, 0, 'L', false);
            $pdf->Ln(6);
            $cont++;
            $numero +=1;

        }
    }
    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'B', 10);
    //Total parroquiaes
    $pdf->Cell(50, 8, utf8_decode("TOTAL CIUDADANOS"), 1, 0, 'L');
    $pdf->Cell(70, 8, utf8_decode($cont), 1, 0, 'C');
    $pdf->Ln(8);

    $pdf->Output();
}
?>