<?php
if ($_SESSION['privilegio_tor'] < 1 || $_SESSION['privilegio_tor'] > 3) {
    $lc->forzar_cierre_sesion_controlador();
    exit();
}

require_once './controladores/solicitudControlador.php';
$ins_solicitud = new solicitudControlador();
/*
for($i=0 ; $i<500 ; $i++){
    $rs = $ins_solicitud->solicitudes();
     sleep(1);
}
*/

//$rs = $ins_solicitud->agregar_gabinete_actividad();


$rs = $ins_solicitud->agregar_asignacion_script();
