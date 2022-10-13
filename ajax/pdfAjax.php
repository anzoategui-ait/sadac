<?php
$peticionAjax=true;
require_once "../config/APP.php"; 

if(isset($_POST['pdf_asignacion_id_reg']) || isset($_POST['pdf_id_del']) || isset($_POST['pdf_id_up'])){
    
    
    /*------------- Instancia al controlador -----------------*/
    require_once "../controladores/pdfControlador.php";
    $ins_pdf = new pdfControlador();
      
    /*-------- Agregar un pdf ----------*/
    if(isset($_POST['pdf_asignacion_id_reg'])){
      echo $ins_pdf->agregar_pdf_controlador();  
    }
    
    /*-------- Eliminar una pdf ----------*/
    if(isset($_POST['pdf_id_del'])){
      echo $ins_pdf->eliminar_pdf_controlador(isset($_POST['pdf_id_del']));  
    }
    
     
    
}else{
    session_start(['name'=>'TOR']);
    session_unset(); //vacia sesion
    session_destroy();//cerrar sesion
    header("Location: ".SERVERURL."login/");//redirigir a otra pagina
    exit();//salir del script
}