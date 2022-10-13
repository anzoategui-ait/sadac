<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['producto_nombre_reg']) || isset($_POST['producto_id_del']) || isset($_POST['imagen_producto_id_del']) || isset($_POST['producto_id_up']) || isset($_POST['imagen_id_up'])){
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/productoControlador.php";
    $ins_producto = new productoControlador();
    
    /*-------- Agregar un producto ----------*/
    if(isset($_POST['producto_nombre_reg'])){
      echo $ins_producto->agregar_producto_controlador();  
    }
    
    /*-------- Eliminar un producto ----------*/
    if(isset($_POST['producto_id_del'])){
      echo $ins_producto->eliminar_producto_controlador(isset($_POST['producto_id_del']));  
    }
    
    /*-------- Eliminar Imagen de un producto ----------*/
    if(isset($_POST['imagen_producto_id_del'])){
      echo $ins_producto->eliminar_imagen_producto_controlador(isset($_POST['imagen_producto_id_del']));  
    }
    
    /*-------  Actualizar Editar un producto-------*/
    if(isset($_POST['producto_id_up'])){
      echo $ins_producto->actualizar_producto_controlador();  
    }
    
    /*-------  Actualizar Editar un producto-------*/
    if(isset($_POST['imagen_id_up'])){
      echo $ins_producto->actualizar_imagen_controlador();  
    }
    
}else{
    session_start(['name'=>'ANZ']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}