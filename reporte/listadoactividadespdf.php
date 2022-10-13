<?php

$peticionAjax = true;


//Crear instancia para obtener las actividades
require_once '../controladores/actividadControlador.php';
$ins_actividad = new actividadControlador();
$fecha_actual = date("Y-m-d");

$actividades = $ins_actividad->datos_actividad_controlador("TodosReporte", 0);
       
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
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Listado de Actividades registradas en el sistema.")), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(3, 119, 234);
    
    //$pdf->SetDrawColor(3, 119, 234); color de lineas de la tabla
    
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 8, utf8_decode('ID'), 1, 0, 'C', false);
    $pdf->Cell(106, 8, utf8_decode('ACTIVIDAD'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('DESCRIPCION'), 1, 0, 'C', false);
    $pdf->Cell(30, 8, utf8_decode('INDICADOR'), 1, 0, 'C', false);
    $pdf->Ln(8);

    
    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    if ($actividades->rowCount() > 0) {
    $actividades = $actividades->fetchAll();
    
    $pdf->SetDrawColor(33, 33, 33);

    $total_actividades = 0; 
    $cont = 1; 
    foreach ($actividades as $rows) {
    
    $pdf->MultiCell(181, 6, utf8_decode('# '. $cont .' ID: '. $rows['actividad_id'] . '. Actividad: ' . $rows['actividad_nombre'] . '. Descripcion: ' . $rows['actividad_descripcion'] . '. Indicador: ' . $rows['indicador_nombre']), 1, 'L', 0);
    $total_actividades += 1; 
    $cont +=1;
    
    }
    $pdf->Ln(6);
    $pdf->SetDrawColor(33, 33, 33);
   $pdf->SetTextColor(33, 33, 33);
   $pdf->SetFont('Arial', 'B', 10);
   $pdf->Cell(121, 8, utf8_decode('TOTAL ACTIVIDADES: '), 1, 0, 'C', false);
   $pdf->Cell(60, 8, utf8_decode($total_actividades), 1, 0, 'C', false);
     }

    $pdf->Output();

?>