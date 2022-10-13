<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['evaluacion_id_del']) || isset($_POST['evaluar_solicitud_id_up']) || isset($_POST['usuario_solicitud_reg']) || isset($_POST['solicitud_descripcion_reg']) || isset($_POST['solicitud_id_del']) || isset($_POST['solicitud_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/solicitudControlador.php";
    $ins_solicitud = new solicitudControlador();

    /*-------- Ciudadano agrega una nueva solicitud ----------*/
    if(isset($_POST['usuario_solicitud_reg'])){
      echo $ins_solicitud->agregar_ciudadano_solicitud_controlador();
    }
    
    /*---- Agregar un nuevo registro de evaluacion y actualizar la solicitud ----*/
     if(isset($_POST['evaluar_solicitud_id_up'])){
      echo $ins_solicitud->agregar_evaluacion_solicitud_controlador();
    }
    
    /*-------- Agregar una solicitud ----------*/
    if(isset($_POST['solicitud_descripcion_reg'])){
      echo $ins_solicitud->agregar_solicitud_controlador();
    }

    /*-------- Eliminar una solicitud ----------*/
    if(isset($_POST['solicitud_id_del'])){
      echo $ins_solicitud->eliminar_solicitud_controlador(isset($_POST['solicitud_id_del']));
    }
    
    /*-------- Eliminar una evaluacion ----------*/
    if(isset($_POST['evaluacion_id_del'])){
      echo $ins_solicitud->eliminar_evaluacion_controlador(isset($_POST['evaluacion_id_del']));
    }

    /*-------  Actualizar una solicitud-------*/
    if(isset($_POST['solicitud_id_up'])){
      echo $ins_solicitud->actualizar_solicitud_controlador();
    }
    
     /* Inscripcion automatica de un usuario en el sistema */
    if(isset($_POST['solicitud_reg'])){
      //echo $ins_inscripcion->agregar_autoregistro_usuario_controlador();  
        $ins_solicitud->auto_solicitud_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
