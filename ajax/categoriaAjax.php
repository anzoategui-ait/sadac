<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['categoria_nombre_reg']) || isset($_POST['categoria_id_del']) || isset($_POST['categoria_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/categoriaControlador.php";
    $ins_categoria = new categoriaControlador();
    
    /*-------- Agregar una categoria ----------*/
    if(isset($_POST['categoria_nombre_reg'])){
      echo $ins_categoria->agregar_categoria_controlador();  
    }
    
    /*-------- Eliminar una categoria ----------*/
    if(isset($_POST['categoria_id_del'])){
      echo $ins_categoria->eliminar_categoria_controlador(isset($_POST['categoria_id_del']));  
    }
    
    /*-------  Actualizar una categoria-------*/
    if(isset($_POST['categoria_id_up'])){
      echo $ins_categoria->actualizar_categoria_controlador();  
    }
            
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}