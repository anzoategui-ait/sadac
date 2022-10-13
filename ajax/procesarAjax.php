<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['equipo_codigo_reg']) || isset($_POST['finalizar_asignacion_id_reg']) || isset($_POST['procesar_observacion_reg']) || isset($_POST['procesar_id_del']) || isset($_POST['procesar_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/procesarControlador.php";
    $ins_procesar = new procesarControlador();
    
    /* Finalizar asignacion */
    if(isset($_POST['finalizar_asignacion_id_reg'])){
      echo $ins_procesar->finalizar_asignacion_controlador();  
    }
    
    /* Agregar equipo a actividad realizada */
    if(isset($_POST['equipo_codigo_reg'])){
      echo $ins_procesar->vincular_equipo_controlador();  
    }
    
    /*-------- Agregar una procesar ----------*/
    if(isset($_POST['procesar_observacion_reg'])){
      echo $ins_procesar->agregar_procesar_controlador();  
    }
    
    /*-------- Eliminar una procesar ----------*/
    if(isset($_POST['procesar_id_del'])){
      echo $ins_procesar->eliminar_procesar_controlador(isset($_POST['procesar_id_del']));  
    }
    
    /*-------  Actualizar una procesar-------*/
    if(isset($_POST['procesar_id_up'])){
      echo $ins_procesar->actualizar_procesar_controlador();  
    }
            
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}