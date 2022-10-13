<?php
$peticionAjax=true;
require_once 'parroquiaControlador.php';

$ins_parroquia = new parroquiaControlador();

$id_parroquia = $_POST['id'];

$parroquias = $ins_parroquia->datos_parroquia_controlador("SectorParroquia", $id_parroquia);
?>
<select class="form-control btn-round" name="sector_nombre_reg" id="sector_nombre_reg" required="">
    
    <!-- INICIAR LISTAR CATEGORIA-->
    <?php
    if ($parroquias->rowCount() > 0) {
        $parroquias = $parroquias->fetchAll();
        echo '<option value="" selected="">Seleccione un sector</option>';
        //Ciclo para recorrer todos los equipos registrados en el sistema
        foreach ($parroquias as $rows) {
            echo '<option value="' . $ins_parroquia->encryption($rows['sector_id']) . '">' . $rows['sector_nombre'] .'</option>';
        }
    }else{
        echo '<option value="" selected="">No hay sectores relacionados a esta parroquia</option>';
    }
    ?>
</select>