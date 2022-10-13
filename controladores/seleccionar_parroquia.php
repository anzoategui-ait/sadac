<?php
$peticionAjax=true;
require_once 'parroquiaControlador.php';

$ins_parroquia = new parroquiaControlador();

$id_parroquia = $_POST['id'];

$parroquias = $ins_parroquia->datos_parroquia_controlador("MunicipioParroquia", $id_parroquia);
?>
<select class="form-control btn-round" name="parroquia_nombre_reg" id="parroquia_nombre_reg" onchange="seleccionar_sector($('#parroquia_nombre_reg').val());return false;" required="">
    
    <!-- INICIAR LISTAR CATEGORIA-->
    <?php
    if ($parroquias->rowCount() > 0) {
        $parroquias = $parroquias->fetchAll();
        echo '<option value="" selected="">Seleccione una parroquia</option>';
        //Ciclo para recorrer todos los equipos registrados en el sistema
        foreach ($parroquias as $rows) {
            echo '<option value="' . $ins_parroquia->encryption($rows['parroquia_id']) . '">' . $rows['parroquia_nombre'] .'</option>';
        }
    }else{
        echo '<option value="" selected="">No hay parroquias relacionadas a este municipio</option>';
    }
    ?>
</select>