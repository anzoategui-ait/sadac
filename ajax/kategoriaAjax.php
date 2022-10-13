<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['kategoria_nombre_reg']) || isset($_POST['kategoria_id_del']) || isset($_POST['kategoria_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/kategoriaControlador.php";
    $ins_kategoria = new kategoriaControlador();
    
    /*-------- Agregar un kategoria ----------*/
    if(isset($_POST['kategoria_nombre_reg'])){
      echo $ins_kategoria->agregar_kategoria_controlador();  
    }
    
    /*-------- Eliminar un kategoria ----------*/
    if(isset($_POST['kategoria_id_del'])){
      echo $ins_kategoria->eliminar_kategoria_controlador(isset($_POST['kategoria_id_del']));  
    }
    
    /*-------  Actualizar Editar un kategoria-------*/
    if(isset($_POST['kategoria_id_up'])){
      echo $ins_kategoria->actualizar_kategoria_controlador();  
    }
    
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}