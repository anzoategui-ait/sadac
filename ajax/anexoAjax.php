<?php
$peticionAjax=true;
require_once "../config/APP.php";

if(isset($_POST['anexo_nombre_reg']) || isset($_POST['anexo_id_del'])){


    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/anexoControlador.php";
    $ins_anexo = new anexoControlador();

    /*-------- Agregar un anexo ----------*/
    if(isset($_POST['anexo_nombre_reg'])){
      echo $ins_anexo->agregar_anexo_controlador();
    }

    /*-------- Eliminar una anexo ----------*/
    if(isset($_POST['anexo_id_del'])){
      echo $ins_anexo->eliminar_anexo_controlador(isset($_POST['anexo_id_del']));
    }

}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}
