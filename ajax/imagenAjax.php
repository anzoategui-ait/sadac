<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['imagen_asignacion_id_reg']) || isset($_POST['imagen_id_del'])){
    
    
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/imagenControlador.php";
    $ins_imagen = new imagenControlador();
    
    /*-------- Agregar un imagen ----------*/
    if(isset($_POST['imagen_asignacion_id_reg'])){
      echo $ins_imagen->agregar_imagen_controlador();  
    }
    
    /*-------- Eliminar una imagen ----------*/
    if(isset($_POST['imagen_id_del'])){
      echo $ins_imagen->eliminar_imagen_controlador(isset($_POST['imagen_id_del']));  
    }
    
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}