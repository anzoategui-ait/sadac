<?php
$peticionAjax=true;
require_once 'direccionControlador.php';

$ins_direccion = new direccionControlador();

$id_direccion = $_POST['id'];

$direccions = $ins_direccion->datos_direccion_controlador("GabineteDireccion", $id_direccion);
?>
<select class="form-control btn-round" name="direccion_up" id="direccion">
    
    <!-- INICIAR LISTAR CATEGORIA-->
    <?php
    if ($direccions->rowCount() > 0) {
        $direccions = $direccions->fetchAll();
        echo '<option value="" selected="">Seleccione una direccion</option>';
        //Ciclo para recorrer todos los equipos registrados en el sistema
        foreach ($direccions as $rows) {
            echo '<option value="' . $ins_direccion->encryption($rows['direccion_id']) . '">' . $rows['direccion_nombre'] .'</option>';
        }
    }else{
        echo '<option value="" selected="">No hay direcciones relacionadas a este gabinete</option>';
    }
    ?>
</select>