<?php
//Inicializo los valores en blanco
//Inicializo los valores en blanco
if (isset($_GET['cedula_id'])) {
    $cedula_id = $_GET['cedula_id'];
}else {
    $cedula_id = "";
}
$peticionAjax = true;
//crear mi instancia de reportes
require_once '../controladores/reporteControlador.php';
$ins_reporte = new reporteControlador();
$fecha_actual = $ins_reporte->crear_fecha_hora(); //impresion de reporte


if ($cedula_id == "") {
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
    //Obtener los datos de los usuarios, sobre todo la direccion y el cargo de quien hace la cedula.
    $estudio_social = $ins_reporte->obtener_estudio_social_controlador($cedula_id);
    $familiares = $ins_reporte->obtener_familiares_controlador($cedula_id);


    
  
     include 'estudio_social_plantilla.php';
    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->SetMargins(7, 17, 17);
    // $pdf->SetAutoPageBreak(true,25); Margen inferior
    $pdf->AddPage();

    //Colocar hora y fecha de emision del reporte
    /*$pdf->Ln(1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->Cell(0, 10, utf8_decode('Fecha de emisión: ' . $fecha_actual), '', 0, 'R');

    //Colocar enunciado del reporte y el rango de fechas 
    $pdf->Ln(15);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 14);
    //$pdf->SetTextColor(0, 107, 181);
    $pdf->Cell(0, 10, utf8_decode("cedula # " . number_format($ins_reporte->descifrar($cedula_id), 0, ",", ".")), 0, 0, 'R');
    $pdf->Ln(10);
    */

    //DATOS DEL INFORME
    if($estudio_social->rowCount()>0){
        $rows = $estudio_social->fetch();
    $pdf->SetFillColor(3, 119, 234);
    $pdf->SetDrawColor(33, 33, 33);
    $pdf->SetTextColor(33, 33, 33);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(108, 4, utf8_decode('FECHA: ' . $rows['estudio_fecha_solicitud']), 1, 0, 'L', false);
    $pdf->Cell(90, 4, utf8_decode('TRAMITE No.: ' . $rows['estudio_id']), 1, 0, 'R', false);
    $pdf->Ln(4);
    $pdf->Cell(198, 4, utf8_decode('DATOS PERSONALES DEL SOLICITANTE: '), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->Cell(198, 4, utf8_decode('NOMBRES Y APELLIDOS: '), 1, 0, 'L', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(198, 4, utf8_decode($rows['estudio_nombre_solicitante']), 1, 0, 'L', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(45, 4, utf8_decode('CEDULA DE IDENTIDAD'), 1, 0, 'L', false);
    $pdf->Cell(55, 4, utf8_decode('NACIONALIDAD'), 1, 0, 'L', false);
    $pdf->Cell(45, 4, utf8_decode('ESTADO CIVIL'), 1, 0, 'L', false);
    $pdf->Cell(53, 4, utf8_decode('TELEFONO / FAX / CELULAR'), 1, 0, 'L', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(45, 4, utf8_decode($rows['estudio_tipo_documento'] . '' .$rows['estudio_cedula_solicitante']), 1, 0, 'L', false);
    $pdf->Cell(55, 4, utf8_decode($rows['estudio_nacionalidad']), 1, 0, 'L', false);
    $pdf->Cell(45, 4, utf8_decode($rows['estudio_estado_civil']), 1, 0, 'L', false);
    $pdf->Cell(53, 4, utf8_decode($rows['estudio_telefono']), 1, 0, 'L', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(77, 4, utf8_decode('LUGAR DE NACIMIENTO'), 1, 0, 'L', false);
    $pdf->Cell(30, 4, utf8_decode('ESTADO'), 1, 0, 'C', false);
    $pdf->Cell(36, 4, utf8_decode('FECHA DE NACIMIENTO'), 1, 0, 'C', false);
    $pdf->Cell(25, 4, utf8_decode('EDAD'), 1, 0, 'C', false);
    $pdf->Cell(30, 4, utf8_decode('SEXO'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(77, 4, utf8_decode($rows['estudio_lugar_nacimiento']), 1, 0, 'L', false);
    $pdf->Cell(30, 4, utf8_decode($rows['estudio_estado_solicitante']), 1, 0, 'C', false);
    $pdf->Cell(36, 4, utf8_decode($rows['estudio_fecha_nacimiento']), 1, 0, 'C', false);
    $pdf->Cell(25, 4, utf8_decode($ins_reporte->obtener_edad_controlador($rows['estudio_fecha_nacimiento'])), 1, 0, 'C', false);
    $pdf->Cell(30, 4, utf8_decode($rows['estudio_genero']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(93, 4, utf8_decode('DIRECCION PERMANENTE'), 1, 0, 'L', false);
    $pdf->Cell(35, 4, utf8_decode('PARROQUIA'), 1, 0, 'C', false);
    $pdf->Cell(35, 4, utf8_decode('MUNICIPIO'), 1, 0, 'C', false);
    $pdf->Cell(35, 4, utf8_decode('ESTADO'), 1, 0, 'C', false);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Ln(4);
    $pdf->Cell(93, 4, utf8_decode($rows['estudio_direccion_permanente']), 1, 0, 'L', false);
    $pdf->Cell(35, 4, utf8_decode($rows['estudio_parroquia']), 1, 0, 'C', false);
    $pdf->Cell(35, 4, utf8_decode($rows['estudio_municipio']), 1, 0, 'C', false);
    $pdf->Cell(35, 4, utf8_decode($rows['estudio_estado_direccion']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('GRADO DE INSTRUCCIÓN'), 1, 0, 'C', false);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Ln(4);
    $pdf->Cell(198, 4, utf8_decode($rows['estudio_grado_instruccion']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('SITUACIÓN SOCIOECONÓMICA'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(16, 4, utf8_decode('TRABAJA'), 1, 0, 'L', false);
    $pdf->Cell(47, 4, utf8_decode('PROFESION'), 1, 0, 'C', false);
    $pdf->Cell(60, 4, utf8_decode('INSTITUCIÓN O EMPRESA'), 1, 0, 'C', false);
    $pdf->Cell(45, 4, utf8_decode('OCUPACIÓN'), 1, 0, 'C', false);
    $pdf->Cell(30, 4, utf8_decode('TELÉFONO'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(16, 4, utf8_decode($rows['estudio_trabaja']), 1, 0, 'C', false);
    $pdf->Cell(47, 4, utf8_decode($rows['estudio_profesion']), 1, 0, 'C', false);
    $pdf->Cell(60, 4, utf8_decode($rows['estudio_institucion_empresa']), 1, 0, 'C', false);
    $pdf->Cell(45, 4, utf8_decode($rows['estudio_ocupacion']), 1, 0, 'C', false);
    $pdf->Cell(30, 4, utf8_decode($rows['estudio_telefono_trabajo']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(91, 4, utf8_decode('DIRECCION LABORAL'), 1, 0, 'L', false);
    $pdf->Cell(32, 4, utf8_decode('INGRESO FAMILIAR'), 1, 0, 'C', false);
    $pdf->Cell(75, 4, utf8_decode('OBSERVACIONES'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(91, 4, utf8_decode($rows['estudio_direccion_laboral']), 1, 0, 'L', false);
    $pdf->Cell(32, 4, utf8_decode($rows['estudio_ingreso_familiar']), 1, 0, 'C', false);
    $pdf->Cell(75, 4, utf8_decode($rows['estudio_observaciones']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('GRUPO FAMILIAR'), 1, 0, 'C', false);

    //AREA PARA EL GRUPO FAMILIAR
    if($familiares->rowCount()>0){
        $familiares = $familiares->fetchAll();
        $cont = 1;
        $pdf->Ln(4);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(6, 4, utf8_decode('No'), 1, 0, 'C', false);
        $pdf->Cell(34, 4, utf8_decode('Nombre y Apellido'), 1, 0, 'C', false);
        $pdf->Cell(21, 4, utf8_decode('Cédula'), 1, 0, 'C', false);
        $pdf->Cell(21, 4, utf8_decode('Nacio'), 1, 0, 'C', false);
        $pdf->Cell(34, 4, utf8_decode('Lugar Nacimiento'), 1, 0, 'C', false);
        $pdf->Cell(14, 4, utf8_decode('Edad'), 1, 0, 'C', false);
        $pdf->Cell(20, 4, utf8_decode('Sexo'), 1, 0, 'C', false);
        $pdf->Cell(24, 4, utf8_decode('Ocupación'), 1, 0, 'C', false);
        $pdf->Cell(24, 4, utf8_decode('Filiación'), 1, 0, 'C', false);
        $pdf->Ln(4);
        $pdf->SetFont('Arial', '', 8);

        foreach($familiares as $row){
        $pdf->Cell(6, 4, utf8_decode($cont), 1, 0, 'C', false);
        $pdf->Cell(34, 4, utf8_decode($row['familiar_nombre']), 1, 0, 'L', false);
        $pdf->Cell(21, 4, utf8_decode($row['familiar_cedula']), 1, 0, 'C', false);
        $pdf->Cell(21, 4, utf8_decode($row['familiar_fecha_nacimiento']), 1, 0, 'C', false);
        $pdf->Cell(34, 4, utf8_decode($row['familiar_lugar_nacimiento']), 1, 0, 'L', false);
        $pdf->Cell(14, 4, utf8_decode($ins_reporte->obtener_edad_controlador($row['familiar_fecha_nacimiento'])), 1, 0, 'C', false);
        $pdf->Cell(20, 4, utf8_decode($row['familiar_genero']), 1, 0, 'C', false);
        $pdf->Cell(24, 4, utf8_decode($row['familiar_ocupacion']), 1, 0, 'C', false);
        $pdf->Cell(24, 4, utf8_decode($row['familiar_filiacion']), 1, 0, 'C', false);
        $pdf->Ln(4);
        $cont+=1;

        }

        }

    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(99, 4, utf8_decode('TIPO DE VIVIENDA'), 1, 0, 'C', false);
    $pdf->Cell(99, 4, utf8_decode('TENENCIA DE VIVIENDA'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(99, 4, utf8_decode($rows['estudio_tipo_vivienda']), 1, 0, 'C', false);
    $pdf->Cell(99, 4, utf8_decode($rows['estudio_tenencia_vivienda']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('INDIQUE EL TIPO DE AYUDA REQUERIDA'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(198, 4, utf8_decode($rows['estudio_tipo_ayuda']), 'LRB', 'L', false);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('SÍNTESIS DEL CASO'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(198, 4, utf8_decode($rows['estudio_sintesis']), 'LRB', 'L', false);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('ÁREA SOCIO-ECONÓMICA'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(198, 4, utf8_decode($rows['estudio_area_socioeconomica']), 'LRB', 'L', false);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('CONCLUSIÓN Y RECOMENDACIÓN'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(198, 4, utf8_decode($rows['estudio_conclusion']), 'LRB', 'L', false);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(198, 4, utf8_decode('DOCUMENTOS ANEXOS'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->Cell(51, 4, utf8_decode('PLANILLA DE SOLICITUD'), 1, 0, 'C', false);
    $pdf->Cell(47, 4, utf8_decode('COPIA CEDULA DE IDENTIDAD'), 1, 0, 'C', false);
    $pdf->Cell(51, 4, utf8_decode('INFORME MEDICO'), 1, 0, 'C', false);
    $pdf->Cell(49, 4, utf8_decode('RIF'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(51, 4, utf8_decode($rows['estudio_planilla_solicitud']), 1, 0, 'C', false);
    $pdf->Cell(47, 4, utf8_decode($rows['estudio_copia_cedula']), 1, 0, 'C', false);
    $pdf->Cell(51, 4, utf8_decode($rows['estudio_informe_medico']), 1, 0, 'C', false);
    $pdf->Cell(49, 4, utf8_decode($rows['estudio_rif']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(51, 4, utf8_decode('PRESUPUESTO'), 1, 0, 'C', false);
    $pdf->Cell(47, 4, utf8_decode('ORDEN MEDICA'), 1, 0, 'C', false);
    $pdf->Cell(51, 4, utf8_decode('CARTA DIRIGIDA AL GOBERNADOR'), 1, 0, 'C', false);
    $pdf->Cell(49, 4, utf8_decode('ACTA DE NACIMIENTO'), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(51, 4, utf8_decode($rows['estudio_presupuesto']), 1, 0, 'C', false);
    $pdf->Cell(47, 4, utf8_decode($rows['estudio_orden_medica']), 1, 0, 'C', false);
    $pdf->Cell(51, 4, utf8_decode($rows['estudio_carta_gobernador']), 1, 0, 'C', false);
    $pdf->Cell(49, 4, utf8_decode($rows['estudio_acta_nacimiento']), 1, 0, 'C', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(198, 4, utf8_decode('Declaro que los datos plasmados, en la presente formulación son fieles y exactos a los suministrados por el ciudadano(a) entrevistado. En tal sentido, autorizo que los mismos sean revisados y constatados, asumiendo la responsabilidad legal que pudiera derivarse por el suministro de datos falsos o incorrectos y las sanciones que resultaran aplicables según la legislación venezolana vigente.'), 'LRB', 'L', false);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(66, 4, utf8_decode('ELABORADO POR: '), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode('SUPERVISADO POR: '), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode('APROBADO POR:'), 'LR', 0, 'L', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_elaborado']), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_supervisado']), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_aprobado']), 'LR', 0, 'L', false);
    
    
    $pdf->Ln(4);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_nombre_elaborado']), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_nombre_supervisado']), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_nombre_aprobado']), 'LR', 0, 'L', false);
    
    $pdf->Ln(4);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_cedula_elaborado']), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_cedula_supervisado']), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode($rows['estudio_cedula_aprobado']), 'LR', 0, 'L', false);
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(66, 4, utf8_decode('FIRMA: ___________________ '), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode('FIRMA: ___________________ '), 'L', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode('FIRMA: ___________________'), 'LR', 0, 'L', false);
    $pdf->Ln(4);
    $pdf->Cell(66, 4, utf8_decode(''), 'LB', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode(''), 'LB', 0, 'L', false);
    $pdf->Cell(66, 4, utf8_decode(''), 'LRB', 0, 'L', false);
    $pdf->Ln(4);
    

     }
  

    $pdf->Output();
}
?>