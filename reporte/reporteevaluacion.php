<?php
//Inicializo los valores en blanco
if (isset($_POST['tiempo_id']) || isset($_POST['solucion_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $tiempo_id = $_POST['tiempo_id'];
    $solucion_id = $_POST['solucion_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
} else {
    $tiempo_id = "";
    $solucion_id = "";
    $fecha_inicio = "";
    $fecha_fin = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

if ($tiempo_id == "" || $fecha_inicio == "" || $fecha_fin == "" || $solucion_id == "") {
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
    $solucion_id = $ins_reporte->descifrar($solucion_id);
    $tiempo_id = $ins_reporte->descifrar($tiempo_id);

    if ($solucion_id == 0) { //Todos los soluciones
        if ($tiempo_id == 0) { //todos los tiempos
            $rs_actividades = $ins_reporte->obtener_feedback_controlador("tiempoSolucion", $solucion_id, $tiempo_id, $fecha_inicio, $fecha_fin);
        } else {
            //tiempo especifica
            $rs_actividades = $ins_reporte->obtener_feedback_controlador("tiempoEspecifico", $solucion_id, $tiempo_id, $fecha_inicio, $fecha_fin);
      
          //  $rs_actividades = $ins_reporte->obtener_mantenimiento_activo_controlador("ActividadEspecifica", $solucion_id, $tiempo_id, $fecha_inicio, $fecha_fin);
        }
    } else { //solucion especifica
        if ($tiempo_id == 0) {
            //Todas los tiempos
            $rs_actividades = $ins_reporte->obtener_feedback_controlador("SolucionEspecifico", $solucion_id, $tiempo_id, $fecha_inicio, $fecha_fin);
        } else {
            //tiempo especifico
            $rs_actividades = $ins_reporte->obtener_feedback_controlador("TiempoSolucionEspecifico", $solucion_id, $tiempo_id, $fecha_inicio, $fecha_fin);
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
    $pdf->Cell(0, 10, utf8_decode('Fecha de emisión: ' . $fecha_actual), '', 0, 'R');

    //Colocar enunciado del reporte y el rango de fechas 
    $pdf->Ln(15);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(190, 10, utf8_decode(strtoupper("Resultados de las evaluciones de los usuarios")), 0, 0, 'L', false);
    $pdf->Ln(5);
    $pdf->Cell(190, 10, utf8_decode(strtoupper("Desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L', false);

    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 10, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(50, 10, utf8_decode('USUARIO'), 1, 0, 'C', false);
    $pdf->Cell(20, 10, utf8_decode('TIEMPO'), 1, 0, 'C', false);
    $pdf->Cell(20, 10, utf8_decode('SOLUCION'), 1, 0, 'C', false);
    $pdf->Cell(90, 10, utf8_decode('SOLICITUD / EVALUACION'), 1, 0, 'C', false);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 8);

    //Codigo para probar multicell
    /*  $pdf->SetX(17);
      $pdf->Cell(30, 6, utf8_decode("codigo"), 1, 0, 'L');

      $pdf->SetX(117);
      $pdf->Cell(55, 6, utf8_decode("actividad"), 1, 0, 'L');

      $pdf->SetX(172);
      $pdf->Cell(35, 6, utf8_decode("2022-03-05"), 1, 0, 'C');

      $pdf->SetX(47);
      $pdf->Cell(70, 6, utf8_decode("nombre"), 1, 0, 'L');

      $pdf->Ln(6); */


    $cant_tiempo_malo = 0;
    $porc_tiempo_malo = 0.0;
    $cant_tiempo_regular = 0;
    $porc_tiempo_regular = 0.0;
    $cant_tiempo_normal = 0;
    $porc_tiempo_normal = 0.0;
    $cant_tiempo_bueno = 0;
    $porc_tiempo_bueno = 0.0;

    $cant_sol_malo = 0;
    $porc_sol_malo = 0.0;
    $cant_sol_regular = 0;
    $porc_sol_regular = 0.0;
    $cant_sol_normal = 0;
    $porc_sol_normal = 0.0;
    $cant_sol_bueno = 0;
    $porc_sol_bueno = 0.0;

    //Filas con los datos (Ciclo para mostrar todos los datos.



    $cont = 0;
    $numero = 1;
    if ($rs_actividades->rowCount() > 0) {

        $tiempo = "";
        $solucion = "";

        foreach ($rs_actividades as $rows) {

            $usuario = $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'];
            $solicitud = $rows['solicitud_descripcion'];
            $evaluacion = $rows['feedback_descripcion'];

            if ($rows['feedback_tiempo_respuesta'] == 1) {
                $cant_tiempo_malo += 1;
                $tiempo = "malo";
            }
            if ($rows['feedback_tipo_solucion'] == 1) {
                $cant_sol_malo += 1;
                $solucion = "malo";
            }

            if ($rows['feedback_tiempo_respuesta'] == 2) {
                $cant_tiempo_regular += 1;
                $tiempo = "regular";
            }
            if ($rows['feedback_tipo_solucion'] == 2) {
                $cant_sol_regular += 1;
                $solucion = "regular";
            }

            if ($rows['feedback_tiempo_respuesta'] == 3) {
                $cant_tiempo_normal += 1;
                $tiempo = "normal";
            }
            if ($rows['feedback_tipo_solucion'] == 3) {
                $cant_sol_normal += 1;
                $solucion = "normal";
            }

            if ($rows['feedback_tiempo_respuesta'] == 4) {
                $cant_tiempo_bueno += 1;
                $tiempo = "bueno";
            }
            if ($rows['feedback_tipo_solucion'] == 4) {
                $cant_sol_bueno += 1;
                $solucion = "bueno";
            }

            $pdf->SetX(17);
            $pdf->Cell(10, 6, utf8_decode($numero), 1, 0, 'C');
            $pdf->Cell(50, 6, utf8_decode($usuario), 1, 0, 'L');
            $pdf->Cell(20, 6, utf8_decode($tiempo), 1, 0, 'C');
            $pdf->Cell(20, 6, utf8_decode($solucion), 1, 0, 'C');
            $pdf->SetX(117);
            $pdf->MultiCell(90, 6, utf8_decode(' SOLICITUD: ' . $solicitud . ' EVALUACION: ' . $evaluacion), 1, 'L', 0);
            //$pdf->Ln(6);
            
            $cont++;
            $numero +=1;
        }
    }

    //Obtener los porcentajes aqui
    $porcentaje = 0;
    //la cantidad seria igual a 1a actividad escogida
    if ($cont != 0) {
        $porcentaje = (1 * 100) / $cont;
        $porcentaje = round($porcentaje, 2);
    } else {
        $porcentaje = 0;
    }
    $porc_tiempo_malo =  $cant_tiempo_malo * $porcentaje;
    $porc_tiempo_regular = $cant_tiempo_regular * $porcentaje;
       $porc_tiempo_normal = $cant_tiempo_normal * $porcentaje;
         $porc_tiempo_bueno = $cant_tiempo_bueno * $porcentaje;
     $porc_sol_malo = $cant_sol_malo * $porcentaje;
        $porc_sol_regular = $cant_sol_regular * $porcentaje;
         $porc_sol_normal = $cant_sol_normal * $porcentaje;
         $porc_sol_bueno = $cant_sol_bueno * $porcentaje;



    $pdf->Ln(8);
    $pdf->SetFont('Arial', 'B', 10);
    //Total Actividades
    $pdf->Cell(94, 8, utf8_decode("TOTAL EVALUACIONES REALIZADAS"), 1, 0, 'L');
    $pdf->Cell(96, 8, utf8_decode($cont), 1, 0, 'C');
    //encabezado tiempo de respuesta
    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(47, 10, utf8_decode('TIEMPO RESPUESTA MALO'), 1, 0, 'C', false);
    $pdf->Cell(47, 10, utf8_decode('TIEMPO RESPUESTA REGULAR'), 1, 0, 'C', false);
    $pdf->Cell(47, 10, utf8_decode('TIEMPO RESPUESTA NORMAL'), 1, 0, 'C', false);
    $pdf->Cell(49, 10, utf8_decode('TIEMPO RESPUESTA BUENO'), 1, 0, 'C', false);
    $pdf->Ln(10);
    //Datos
    $pdf->Cell(23, 10, utf8_decode($cant_tiempo_malo), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($porc_tiempo_malo . ' %'), 1, 0, 'C', false);
    $pdf->Cell(23, 10, utf8_decode($cant_tiempo_regular), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($porc_tiempo_regular . ' %'), 1, 0, 'C', false);
    $pdf->Cell(23, 10, utf8_decode($cant_tiempo_normal), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($porc_tiempo_normal . ' %'), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($cant_tiempo_bueno), 1, 0, 'C', false);
    $pdf->Cell(25, 10, utf8_decode($porc_tiempo_bueno . ' %'), 1, 0, 'C', false);
    $pdf->Ln(10);

    //encabezado tipo de solucion
    $pdf->Ln(8);
    $pdf->Cell(47, 10, utf8_decode('TIPO SOLUCION MALO'), 1, 0, 'C', false);
    $pdf->Cell(47, 10, utf8_decode('TIPO SOLUCION REGULAR'), 1, 0, 'C', false);
    $pdf->Cell(47, 10, utf8_decode('TIPO SOLUCION NORMAL'), 1, 0, 'C', false);
    $pdf->Cell(49, 10, utf8_decode('TIPO SOLUCION BUENO'), 1, 0, 'C', false);
    $pdf->Ln(10);
    //Datos
    $pdf->Cell(23, 10, utf8_decode($cant_sol_malo), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($porc_sol_malo.' %'), 1, 0, 'C', false);
    $pdf->Cell(23, 10, utf8_decode($cant_sol_regular), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($porc_sol_regular.' %'), 1, 0, 'C', false);
    $pdf->Cell(23, 10, utf8_decode($cant_sol_normal), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($porc_sol_normal.' %'), 1, 0, 'C', false);
    $pdf->Cell(24, 10, utf8_decode($cant_sol_bueno), 1, 0, 'C', false);
    $pdf->Cell(25, 10, utf8_decode($porc_sol_bueno.' %'), 1, 0, 'C', false);
    $pdf->Ln(10);

    $pdf->Output();
}
?>