<?php
//Inicializo los valores en blanco
if (isset($_POST['actividad_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $actividad_id = $_POST['actividad_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
    $estado = $_POST['actividad_estado'];
} else {
    $actividad_id = "";
    $fecha_inicio = "";
    $fecha_fin = "";
    $estado = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();

//Crear instancia para obtener las actividades
require_once '../controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
    
require_once '../controladores/homeControlador.php';
$ins_home = new homeControlador();
//Obtener valores estadisticos para las primeras cuatro cajas
$total_solicitudes = $ins_home->datos_solicitud_controlador("Todos", 0);


if ($actividad_id == "" || $fecha_inicio == "" || $fecha_fin == "" || $estado == "") {
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
    $estado = $ins_reporte->descifrar($estado);
    $actividad_id = $ins_reporte->descifrar($actividad_id);
    $mensaje = "";
    if($estado=="todos"){
        $mensaje = " solicitadas ";
    }
    if($estado=="sin asignar"){
        $mensaje = " pendientes ";
    }
    if($estado=="asignado"){
        $mensaje = " en proceso ";
    }
    if($estado=="finalizado"){
        $mensaje = " finalizadas ";
    }
    
    if($actividad_id==0){
            //Todos los estados y todas las actividades
            $actividades = $ins_actividad->datos_actividad_controlador("Todos", 0);
            
        }else{
            //Todos los estados para una unica actividad
            $actividades = $ins_actividad->datos_actividad_controlador("Unico", $ins_actividad->encryption($actividad_id));
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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Actividades".$mensaje."desde el " . $fecha_inicio . " hasta el " . $fecha_fin)), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    
    //$pdf->SetDrawColor(3, 119, 234); color de lineas de la tabla
    
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 8, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(111, 8, utf8_decode('ACTIVIDAD'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('TOTAL'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('PORCENTAJE'), 1, 0, 'C', false);
    $pdf->Ln(8);

    
    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    if ($actividades->rowCount() > 0) {
    $actividades = $actividades->fetchAll();
    
    $total_actividades = 0; 
    $cont = 1;
    foreach ($actividades as $rows) {
    if($estado=="todos"){
        $recurrencia = $ins_home->obtener_recurrencia_fecha_controlador("Actividades", $rows['actividad_id'], $fecha_inicio, $fecha_fin);
    }
    elseif($estado=="sin asignar"){
       $recurrencia = $ins_home->obtener_recurrencia_fecha_controlador("ActividadesSinAsignar", $rows['actividad_id'], $fecha_inicio, $fecha_fin);
    }
    elseif($estado=="asignado"){
        $recurrencia = $ins_home->obtener_recurrencia_fecha_controlador("ActividadesAsignadas", $rows['actividad_id'], $fecha_inicio, $fecha_fin);
    }
    elseif($estado=="finalizado"){
        $recurrencia = $ins_home->obtener_recurrencia_fecha_controlador("ActividadesFinalizadas", $rows['actividad_id'], $fecha_inicio, $fecha_fin);
    }    
    
    $porcentante_recurrencia = $ins_home->obtener_porcentaje_controlador($total_solicitudes->rowCount(), $recurrencia->rowCount());
          
    if($porcentante_recurrencia!=0){ 
    $total_actividades += $recurrencia->rowCount();
    $pdf->Cell(10, 6, utf8_decode($cont), 1, 0, 'C');
    $pdf->Cell(111, 6, utf8_decode($rows['actividad_nombre']), 1, 0, 'L');
    $pdf->Cell(30, 6, utf8_decode($recurrencia->rowCount()), 1, 0, 'R');
    $pdf->Cell(30, 6, utf8_decode(number_format($porcentante_recurrencia, 2, ",", ".")."%" ), 1, 0, 'R');
    $pdf->Ln(6);
    $cont += 1;
    }
    
    }
     
    $pdf->Ln(6);
     $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(91, 8, utf8_decode('ACTIVIDADES ' . $fecha_inicio . " - " . $fecha_fin), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('TOTAL: '), 1, 0, 'R', false);
    $pdf->Cell(30, 8, utf8_decode($total_actividades), 1, 0, 'R', false);
    
    }

    $pdf->Output();
}
?>