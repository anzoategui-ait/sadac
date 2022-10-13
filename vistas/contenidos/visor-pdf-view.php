<?php
 if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3 || $_SESSION['tipo_tor']==4) {
        echo $lc->forzar_cierre_sesion_controlador();
        exit();
    }
//Obtener el nombre del archivo
require_once "./controladores/pdfControlador.php";
$ins_pdf = new pdfControlador();

$datos_pdf = $ins_pdf->datos_pdf_controlador("Unico", $pagina[1]);

if($datos_pdf->rowCount()==1){
    $campos = $datos_pdf->fetch();
    $nombre_file = $campos['pdf_archivo'];


echo '<embed src="'.SERVERURL.'pdf/' . $nombre_file . '" type="application/pdf" width="100%" height="600px"/>';
}
?>
<p class="text-center" style="margin-top: 40px;">
<a href="<?php echo SERVERURL;?>asignacion-anexo-list/" class="btn btn-3d btn-info"><span class="fa fa-refresh"></span> volver</a>

</p>