<?php
require_once './controladores/reporteControlador.php';
require_once "./phpoffice_excel/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$ins_reporte = new reporteControlador();

$fecha_inicio = $_POST['encuesta_fecha_inicio'];
$fecha_fin = $_POST['encuesta_fecha_final'];

if ($fecha_inicio == "" || $fecha_fin == "") {
    ?>
    <p></p>
    <br>
    <a class="collapse-item"  href="<?php echo SERVERURL; ?>totalizacion-gestion/"><i class="fa fa-clipboard-list fa-fw"></i> &nbsp; Ha ocurrido un error inesperado, intente nuevamente. Volver a reporte de totalización de gestión</a>
    <?php
}
else {
    $documento = new Spreadsheet();
    $documento
            ->getProperties()
            ->setCreator("SISTEMA AUTOMATIZADO DE LA DIRECCION DE ATENCION AL CIUDADANO. (SADAC)")
            ->setLastModifiedBy('WWW.SOFTWARECRISTINA.COM')
            ->setTitle('Archivo exportado desde tu sistema en linea SADAC by www.softwarecristina.com')
            ->setDescription('www.softwarecristina.com desarrolladores de sistemas automatizados de informacion, que se adaptan a tus necesidades.');

# Como ya hay una hoja por defecto, la obtenemos, no la creamos
    $hojaDeProductos = $documento->getActiveSheet();
    $hojaDeProductos->setTitle("Totalizacion Gestion (SADAC)");

# Escribir encabezado del documento en excel

    $encabezado = ["FECHA SOLICITUD", "NOMBRES Y APELLIDOS", "CEDULA", "FECHA NACIMIENTO", "EDAD", "GENERO", "TELEFONO", "GABINETE", "UNIDAD ADMINISTRATIVA", "DESCRIPCION SOLICITUD", "ESTADO SOLICITUD", "CATEGORIA", "ACTIVIDAD", "ESTADO ACTIVIDAD",
                    "MUNICIPIO", "PARROQUIA", "SECTOR", "FECHA ASIGNACION", "PROCESADO POR", "CEDULA", "TELEFONO"];
# El último argumento es por defecto A1 pero lo pongo para que se explique mejor
    $hojaDeProductos->fromArray($encabezado, null, 'A1');

    $numeroDeFila = 2;
     
      
      //echo "<br><br>Pregunta que pertenecen a esta encuesta";
      $totalizacion = $ins_reporte->obtener_totalizacion_gestion($fecha_inicio, $fecha_fin);
      if($totalizacion->rowCount()>0){
         $datos_totalizacion = $totalizacion->fetchAll();
         foreach($datos_totalizacion as $rows){

                    $edad = $ins_reporte->obtener_edad_controlador($rows['usuario_fecha_nacimiento']);
            
                     $hojaDeProductos->setCellValueByColumnAndRow(1, $numeroDeFila, $rows['solicitud_inicio']);
                     $hojaDeProductos->setCellValueByColumnAndRow(2, $numeroDeFila, $rows['usuario_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(3, $numeroDeFila, $rows['usuario_dni']);
                     $hojaDeProductos->setCellValueByColumnAndRow(4, $numeroDeFila, $rows['usuario_fecha_nacimiento']);
                     $hojaDeProductos->setCellValueByColumnAndRow(5, $numeroDeFila, $edad);
                     $hojaDeProductos->setCellValueByColumnAndRow(6, $numeroDeFila, $rows['usuario_genero']);
                     $hojaDeProductos->setCellValueByColumnAndRow(7, $numeroDeFila, $rows['usuario_telefono']);
                     $hojaDeProductos->setCellValueByColumnAndRow(8, $numeroDeFila, $rows['gabinete_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(9, $numeroDeFila, $rows['direccion_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(10, $numeroDeFila, $rows['solicitud_descripcion']);
                     $hojaDeProductos->setCellValueByColumnAndRow(11, $numeroDeFila, $rows['solicitud_estado']);
                     $hojaDeProductos->setCellValueByColumnAndRow(12, $numeroDeFila, $rows['categoria_nombre']);

                     $hojaDeProductos->setCellValueByColumnAndRow(13, $numeroDeFila, $rows['actividad_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(14, $numeroDeFila, $rows['actividad_estado']);
                     $hojaDeProductos->setCellValueByColumnAndRow(15, $numeroDeFila, $rows['municipio_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(16, $numeroDeFila, $rows['parroquia_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(17, $numeroDeFila, $rows['sector_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(18, $numeroDeFila, $rows['asignacion_fecha']);
                     $hojaDeProductos->setCellValueByColumnAndRow(19, $numeroDeFila, $rows['analista_nombre']);
                     $hojaDeProductos->setCellValueByColumnAndRow(20, $numeroDeFila, $rows['analista_cedula']);
                     $hojaDeProductos->setCellValueByColumnAndRow(21, $numeroDeFila, $rows['analista_telefono']);
                    $numeroDeFila++;
                
         }
         $nombreDelDocumento = "reportes/".time()."-Totalizacion-Gestion-Sadac.xlsx";
    $writer = new Xlsx($documento);
    $writer->save($nombreDelDocumento);
    echo "<meta http-equiv='refresh' content='0;url=" . SERVERURL . $nombreDelDocumento . "'/>";
     
      }
      
       
}
?>
<!-- Agregar encabezado para la vista -->
<div class="panel box-shadow-none content-header">
    <div class="panel-body">
        <div class="col-md-12">
            <h3 class="animated fadeInLeft">Reportes / Totalizacion de Gestion</h3>
            <p class="animated fadeInDown">
                Espere unos minutos mientras se procesa la información que será descargada en un archivo en excel. Este archivo contiene la totalizacion de las solicitudes, dentro de un rango especifico.
            </p>
        </div>
    </div>
</div>
<!-- Fin agregar encabezado para la vista -->