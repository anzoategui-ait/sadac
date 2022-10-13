<?php
/*
session_start();
if ($_SESSION['privilegio_anz'] < 1 || $_SESSION['privilegio_anz'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}
if ($_SESSION['tipo_anz'] != 1 && $_SESSION['tipo_anz'] != 2) {
    $lc->redireccionar_pagina_controlador();
    exit();
}
*/

$peticionAjax = true;
//crear mi instancia de reportes
    require_once '../controladores/productoControlador.php';
    $ins_producto = new productoControlador();
    
   /* require_once '../controladores/salidaControlador.php';
    $ins_salida = new salidaControlador();*/

    $productos = $ins_producto->datos_producto_controlador("TodosCantidad", 0);
    
    //$fecha_actual = $ins_salida->crear_fecha_hora();
    date_default_timezone_set("America/Caracas");
        $fecha_actual = strftime("%Y-%m-%d %H:%M:%S", time());  // arreglar que en vez de cantidad salga codigo
    
    //VISUALIZACION DEL PDF
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
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(0, 10, utf8_decode(strtoupper("Inventario de Activos Informaticos")), 0, 0, 'L');
    $pdf->Ln(15);

    //Titulos de cada columna de la tabla de actividades
    $pdf->SetFillColor(33, 33, 33);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 7, utf8_decode('#'), 1, 0, 'C', false);
    $pdf->Cell(121, 7, utf8_decode('PRODUCTO'), 1, 0, 'C', false);
    $pdf->Cell(40, 7, utf8_decode('CODIGO'), 1, 0, 'C', false);
    $pdf->Ln(7);

    $cont = 1;
    $articulos = 0;
    if ($productos->rowCount() > 0) {
        $productos = $productos->fetchAll();

        $pdf->SetFont('Arial', '', 8);
        foreach ($productos as $rows){
        $pdf->Cell(20, 5, utf8_decode($cont), 1, 0, 'C');
        $pdf->Cell(121, 5, utf8_decode($rows['producto_nombre']), 1, 0, 'L');
        $pdf->Cell(40, 5, utf8_decode($rows['producto_codigo']), 1, 0, 'L');
        $pdf->Ln(5);
        
        $cont++;
        }
        
        
      
        
         
    }


    $pdf->Output();