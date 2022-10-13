<?php
//Inicializo los valores en blanco
if (isset($_POST['direccion_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $direccion_id = $_POST['direccion_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
} else {
    $direccion_id = "";
    $fecha_inicio = "";
    $fecha_fin = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

//Crear instancia para obtener las direcciones
require_once '../controladores/direccionControlador.php';
$ins_direccion = new direccionControlador();

require_once '../controladores/homeControlador.php';
$ins_home = new homeControlador();
//Obtener valores estadisticos para las primeras cuatro cajas
$total_solicitudes = $ins_home->datos_solicitud_controlador("Todos", 0);

if ($direccion_id == "" || $fecha_inicio == "" || $fecha_fin == "") {
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

    //Inicio de codigo para listar las direcciones
    $direccion_id = $ins_reporte->descifrar($direccion_id);

    if ($direccion_id == 0) {
        //Todos los estados y todas las direcciones
        $direcciones = $ins_direccion->datos_direccion_controlador("Todos", 0);
    } else {
        //Todos los estados para una unica direccion
        $direcciones = $ins_direccion->datos_direccion_controlador("Unico", $ins_direccion->encryption($direccion_id));
    }

    //Fin de codigo para listar las direcciones


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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Solicitudes por Direccion desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de direcciones
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(3, 119, 234);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 10, utf8_decode('#'), 1, 0, 'C', true);
    $pdf->Cell(106, 10, utf8_decode('DIRECCION'), 1, 0, 'C', true);
    $pdf->Cell(35, 10, utf8_decode('SOLICITUD TOTAL'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, utf8_decode('PORCENTAJE'), 1, 0, 'C', true);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 10);

    $numero = 1;
    //Filas con los datos (Ciclo para mostrar todos los datos.
    if ($direcciones->rowCount() > 0) {
        $direcciones = $direcciones->fetchAll();


        foreach ($direcciones as $rows) {

            $recurrencia_direccion = $ins_home->obtener_recurrencia_fecha_controlador("Direccion", $rows['direccion_id'], $fecha_inicio, $fecha_fin);
            $porcentante_recurrencia_direccion = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia_direccion->rowCount());

            if ($porcentante_recurrencia_direccion != 0) {
                    $pdf->Cell(116, 8, utf8_decode($numero), 1, 0, 'C');
                    $pdf->Cell(116, 8, utf8_decode($rows['direccion_nombre']), 1, 0, 'L');
                    $pdf->Cell(35, 8, utf8_decode($recurrencia_direccion->rowCount()), 1, 0, 'C');
                    $pdf->Cell(30, 8, utf8_decode(number_format($porcentante_recurrencia_direccion, 2, ",", ".") . "%"), 1, 0, 'C');
                    $pdf->Ln(8);
                    $numero +=1;
                }
            }
        }

        $pdf->Output();
    }
    ?>