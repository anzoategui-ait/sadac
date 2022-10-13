<?php
//Inicializo los valores en blanco
if (isset($_POST['municipio_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $municipio_id = $_POST['municipio_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
} else {
    $municipio_id = "";
    $fecha_inicio = "";
    $fecha_fin = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

//Crear instancia para obtener las municipios
require_once '../controladores/municipioControlador.php';
$ins_municipio = new municipioControlador();

require_once '../controladores/homeControlador.php';
$ins_home = new homeControlador();
//Obtener valores estadisticos para las primeras cuatro cajas
$total_solicitudes = $ins_home->datos_solicitud_controlador("Todos", 0);

if ($municipio_id == "" || $fecha_inicio == "" || $fecha_fin == "") {
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

    //Inicio de codigo para listar las municipioes
    $municipio_id = $ins_reporte->descifrar($municipio_id);

    if ($municipio_id == 0) {
        //Todos los estados y todas las municipioes
        $municipios = $ins_municipio->datos_municipio_controlador("Todos", 0);
    } else {
        //Todos los estados para una unica municipio
        $municipios = $ins_municipio->datos_municipio_controlador("Unico", $ins_municipio->encryption($municipio_id));
    }

    //Fin de codigo para listar las municipioes


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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Solicitudes por Municipio desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de municipioes
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(106, 8, utf8_decode('MUNICIPIO'), 1, 0, 'C', false);
    $pdf->Cell(35, 8, utf8_decode('SOLICITUD TOTAL'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('PORCENTAJE'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    $total=0;
    $numero = 1;
    //Filas con los datos (Ciclo para mostrar todos los datos.
    if ($municipios->rowCount() > 0) {
        $municipios = $municipios->fetchAll();

        foreach ($municipios as $rows) {

            $recurrencia_municipio= $ins_home->obtener_recurrencia_fecha_controlador("Municipio", $rows['municipio_id'], $fecha_inicio, $fecha_fin);
            $porcentante_recurrencia_municipio= $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_municipio->rowCount());

            if ($porcentante_recurrencia_municipio!= 0) {
                $total += $recurrencia_municipio->rowCount();
                $pdf->Cell(10, 6, utf8_decode($numero), 1, 0, 'C');
                    $pdf->Cell(106, 6, utf8_decode($rows['municipio_nombre']), 1, 0, 'L');
                    $pdf->Cell(35, 6, utf8_decode($recurrencia_municipio->rowCount()), 1, 0, 'C');
                    $pdf->Cell(30, 6, utf8_decode(number_format($porcentante_recurrencia_municipio, 2, ",", ".") . "%"), 1, 0, 'C');
                    $pdf->Ln(6);
                    $numero +=1;
                }
            }
        }

         $pdf->Ln(8);
    $pdf->SetFont('Arial', 'B', 10);
    //Total Actividades
    $pdf->Cell(116, 8, utf8_decode("TOTAL SOLICITUDES"), 1, 0, 'R');
    $pdf->Cell(35, 8, utf8_decode($total), 1, 0, 'C');
    $pdf->Ln(8);
    
        $pdf->Output();
    }
    ?>