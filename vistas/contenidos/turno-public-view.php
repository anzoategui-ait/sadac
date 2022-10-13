<?php
//crear listado de municipios y listado de oficios 
require_once './controladores/turnoControlador.php';
$ins_turno = new turnoControlador();

//Obtener proximo turno
$proximo_turno = $ins_turno->proximo_turno_controlador();
$rs_proximo_turno = "";
if($proximo_turno->rowCount()>0){
  $proximo_turno=$proximo_turno->fetch();
  $rs_proximo_turno = $proximo_turno['turno_cedula'] . ' - ' . $proximo_turno['turno_nombre'];
}
//Obtener cuantos turnos faltan por atender
$turnos_en_espera = $ins_turno->turnos_en_espera_controlador();
$rs_turnos_en_espera = 0;
if($turnos_en_espera->rowCount()>0){
  $rs_turnos_en_espera = $turnos_en_espera->rowCount();
}

//Obtener usuario en turno actual, el que es llamado.
$turno_actual = $ins_turno->turno_actual_controlador();
$rs_turno_actual ="";
$rs_cubiculo = "";
$rs_turno_usuario_id = 0;
if($turno_actual->rowCount()>0){
  $turno_actual=$turno_actual->fetch();
  $rs_turno_actual = $turno_actual['turno_nombre'] . ' - '. $turno_actual['turno_cedula'];
  $rs_cubiculo = $turno_actual['cubiculo_nombre'];
  $rs_turno_usuario_id = $turno_actual['turno_usuario_id'];
}

//Mostrar ventana emergente



?>

<div class="container-fluid">
  <!-- Turno actual, proximo turno, y total en espera-->
 <div class="row">
  <div class="col-sm-4">
  <div class="panel">
  <div class="panel-body">

  <?php 
      $check_ventana = $ins_turno->mostrar_ventana_emergente_controlador($rs_cubiculo, $rs_turno_actual, $rs_turno_usuario_id);
  if($check_ventana->rowCount()>0){
    //Actualizo el valor para que no se vuelva a mostrar la ventana

    $update_turno_usuario = $ins_turno->actualizar_ventana_controlador($rs_turno_usuario_id);

//mostrar HTML Con los datos grandes por primera vez

      echo '<h2>'.  $rs_turno_actual  .'</h2><h2>'.  $rs_cubiculo .'</h2>';
      $num = 5;
  
}
else {
   $num = rand(1,4);
  //Cuando recarga la pagina volver al estado normal
  ?>
<h4>TURNO ACTUAL</h4> &nbsp; <?php 
      echo $rs_cubiculo . ' | ' . $rs_turno_actual;
   ?>

  <?php 
}
  ?>

  



  
                      
  </div>
</div>
  </div>
  <div class="col-sm-4">
    
  <div class="panel">
  <div class="panel-body">
  <h4> PROXIMO TURNO</h4>  
  <?php 
      echo $rs_proximo_turno;
   ?>
  </div>
</div>

  </div>
  <div class="col-sm-4">
  
  <div class="panel">
  <div class="panel-body">
  <h4> TURNOS EN ESPERA  </h4>

  <?php 
      echo $rs_turnos_en_espera;
   ?>
  </div>
</div>

  </div>
</div>
  <!-- Content interfaz principal y lista de espera-->
  <div class="row">
  <div class="col-sm-8">
  <div class="panel">
  <div class="panel-body">
  
  <img SRC="<?php echo SERVERURL; ?>videos/fondo<?php echo $num; ?>.png" aling=center width=690 heigth=345 >
<!--
  <div class="embed-responsive embed-responsive-16by9">

  <iframe width="560" height="315" src="https://www.youtube.com/embed/Yd0saYHyRpI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; muted; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

</div> -->

  </div>
</div>

  </div>
  <div class="col-sm-4">
  <div class="panel">
  <div class="panel-body">
  <?php
  echo $ins_turno->paginador_turno_public_controlador($pagina[1], 6, 1, $pagina[0], "");
  ?>
  </div>
</div>


  </div>
</div>

</div>


<!-- Recargar la pagina de home  cada 3 minutos -->
<script src="<?php echo SERVERURL; ?>vistas/asset/js/recargar_turno_digital.js"></script>
