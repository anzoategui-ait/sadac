<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['nombres_apellidos_solicitante_reg']) || isset($_POST['nombre_familiar_reg']) || isset($_POST['estudio_id_del']) || isset($_POST['familiar_id_del']) || isset($_POST['estudio_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/estudioControlador.php";
    $ins_estudio = new estudioControlador();

    /*-------- Agregar una estudio social ----------*/
    if(isset($_POST['nombres_apellidos_solicitante_reg'])){
      echo $ins_estudio->agregar_estudio_controlador();
    }

    /*-------- Agregar un familiar ----------*/
    if(isset($_POST['nombre_familiar_reg']) && isset($_POST['cedula_familiar_reg'])){
      echo $ins_estudio->agregar_familiar_controlador();
    } 

    /*-------- Eliminar una estudio ----------*/
    if(isset($_POST['estudio_id_del'])){
      echo $ins_estudio->eliminar_estudio_controlador(isset($_POST['estudio_id_del']));
    }

    /*-------- Eliminar un familiar ----------*/
    if(isset($_POST['familiar_id_del'])){
      echo $ins_estudio->eliminar_familiar_controlador(isset($_POST['familiar_id_del']));
    }

    /*-------  Actualizar una estudio-------*/
    if(isset($_POST['estudio_id_up'])){
      echo $ins_estudio->actualizar_estudio_controlador();
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}