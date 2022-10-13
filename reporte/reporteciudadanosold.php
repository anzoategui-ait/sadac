<?php

    $parroquia = 0;
    $municipio= 0;
    $sector= 0;
    $genero= 0;
    $fecha_inicio = "";
    $fecha_fin = "";

//Inicializo los valores en blanco
if (isset($_POST['genero_id']) || isset($_POST['sector_id']) || isset($_POST['parroquia_id']) || isset($_POST['municipio_id']) || isset($_POST['fecha_inicio']) || isset($_POST['fecha_final'])) {
    $parroquia = $_POST['parroquia_id'];
    $municipio= $_POST['municipio_id'];
    $sector= $_POST['sector_id'];
    $genero= $_POST['genero_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_final'];
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora();


if ($parroquia == "" || $fecha_inicio == "" || $fecha_fin == "" || $municipio== "") {
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

    //Inicio de codigo para listar las parroquiaes
   
    if ($municipio == 0) { //Todos los municipios
        if ($parroquia == 0) { //Todas las parroquias
            if ($sector == 0) { //Todos los sectores
                if ($genero == 0) {  //Todos los generos
                    $rs_ciudadanos = $ins_reporte->obtener_ciudadanos_controlador("Ciudadanos", $municipio, $parroquia, $sector, $genero, $fecha_inicio, $fecha_fin);
       
                      } else { //un genero especifico
                        $rs_ciudadanos = $ins_reporte->obtener_ciudadanos_controlador("CiudadanosGenero", $municipio, $parroquia, $sector, $genero, $fecha_inicio, $fecha_fin);
       
                      }
                  } else { //Un sector en especifico
                    //Verificar el el genero
                    if ($genero == 0) {  //Todos los generos
                        $rs_ciudadanos = $ins_reporte->obtener_ciudadanos_controlador("CiudadanosSector", $municipio, $parroquia, $sector, $genero, $fecha_inicio, $fecha_fin);
                   
                          } else { //un genero especifico
                             $rs_ciudadanos = $ins_reporte->obtener_ciudadanos_controlador("CiudadanosSectorGenero", $municipio, $parroquia, $sector, $genero, $fecha_inicio, $fecha_fin);
                   
                          }
                  }
              } else { //Una parroquia especifica
                        $rs_ciudadanos = $ins_reporte->obtener_ciudadanos_controlador("CiudadanosParroquia", $municipio, $parroquia, $sector, $genero, $fecha_inicio, $fecha_fin);
           
              }
          } else { //Un municipio en especifico
            if ($parroquia == 0) { //Todas las parroquias
                if ($sector == 0) { //Todos los sectores
                    if ($genero == 0) {  //Todos los generos
                        //Un municipio en especifico
                        $rs_ciudadanos = $ins_reporte->obtener_ciudadanos_controlador("CiudadanosMunicipio", $municipio, $parroquia, $sector, $genero, $fecha_inicio, $fecha_fin);
           
                    }
                }
            }
                      

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
    $pdf->Cell(25, 8, utf8_decode('CEDULA'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('CIUDADANO'), 1, 0, 'C', false);
    $pdf->Cell(25, 8, utf8_decode('TELEFONO'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('MUNICIPIO'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('PARROQUIA'), 1, 0, 'C', false);
    $pdf->Cell(40, 8, utf8_decode('SECTOR'), 1, 0, 'C', false);
    $pdf->Cell(20, 8, utf8_decode('GENERO'), 1, 0, 'C', false);
    $pdf->Cell(25, 8, utf8_decode('FECHA'), 1, 0, 'C', false);
    $pdf->Ln(8);

    $pdf->SetFont('Arial', '', 8);
    //Filas con los datos (Ciclo para mostrar todos los datos.
    $cont = 0;
    if ($rs_ciudadanos->rowCount() > 0) {


        foreach ($rs_ciudadanos as $rows) {
            $nombre_ciudadano = $rows['usuario_nombre'] . ', ' . $rows['usuario_apellido'];
            $nombre_ciudadano = substr($nombre_ciudadano, 0, 28) . "_";

            $nombre_municipio = $rows['municipio_nombre'];
            $nombre_municipio = substr($nombre_municipio, 0, 28) . "_";

            $nombre_parroquia = $rows['parroquia_nombre'];
            $nombre_parroquia = substr($nombre_parroquia, 0, 28) . "_";

            $nombre_sector = $rows['usuario_direccion'];
            $nombre_sector = substr($nombre_sector, 0, 28) . "_";

            $pdf->Cell(25, 6, utf8_decode($rows['usuario_dni']), 1, 0, 'L');
            $pdf->Cell(40, 6, utf8_decode($nombre_ciudadano), 1, 0, 'L');
            $pdf->Cell(25, 6, utf8_decode($rows['usuario_telefono']), 1, 0, 'C');
            $pdf->Cell(40, 6, utf8_decode($nombre_municipio), 1, 0, 'L', false);
            $pdf->Cell(40, 6, utf8_decode($nombre_parroquia), 1, 0, 'L', false);
            $pdf->Cell(40, 6, utf8_decode($nombre_sector), 1, 0, 'L', false);
            $pdf->Cell(20, 6, utf8_decode($rows['usuario_genero']), 1, 0, 'C', false);
            $pdf->Cell(25, 6, utf8_decode($rows['usuario_fecha_nacimiento']), 1, 0, 'C');
            $pdf->Ln(6);
            $cont++;
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