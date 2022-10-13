<?php

if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo {
    /* ----------- Controlador para iniciar sesion ---------- */

    public function iniciar_sesion_controlador(){
        $usuario = mainModel::limpiar_cadena($_POST['usuario_log']);
        $clave = mainModel::limpiar_cadena($_POST['clave_log']);

        /* -----------  Comprobar los campos vacios ------------ */
        if ($usuario == "" || $clave == "") {
            //como no se usa ajax para el login
            //se crea javascript puro
            echo '<script>'
            . 'Swal.fire({title: "Ha ocurrido un error inesperado", text: "No has llenado todos los campos que son requeridos", type: "error", confirmButtonText: "Aceptar" });'
                    . '</script>';
            exit();
        }

        /* --------- Verificar integridad de los datos ----------- */
        if (mainModel::verificar_datos("[a-zA-Z0-9]{4,35}", $usuario)) {
            echo '<script>
                Swal.fire({
            title: "Ha ocurrido un error inesperado",
            text: "El Nombre de Usuario no coincide con el formato especificado",
            type: "error",
            confirmButtonText: "Aceptar"
        });
        </script>';
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
            echo '<script>
                Swal.fire({
            title: "Ha ocurrido un error inesperado",
            text: "La Clave no coincide con el formato especificado",
            type: "error",
            confirmButtonText: "Aceptar"
        });
        </script>';
            exit();
        }

        $clave = mainModel::encryption($clave);

        /* -------   Crear array de datos   -------- */
        $datos_login = [
            "Usuario" => $usuario,
            "Clave" => $clave
        ];

        $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);
        
        $fecha_login = mainModel::crear_fecha();

        if ($datos_cuenta->rowCount() == 1) {
            $row=$datos_cuenta->fetch();
            
            //Agregar el registro del usuario a la bitacora
            $usuario_id = $row['usuario_id'];
            $datos_bitacora = [
                "Fecha" =>$fecha_login,
                "Accion"=>"Inicio de Sesion",
                "Usuario"=>$usuario_id
            ];
            
            $registro_bitacora = loginModelo::registrar_bitacora_modelo($datos_bitacora);
            
            session_start(['name'=>'TOR']);
            
            $_SESSION['id_tor']=$row['usuario_id'];
            $_SESSION['nombre_tor']=$row['usuario_nombre'];
            $_SESSION['apellido_tor']=$row['usuario_apellido'];
            $_SESSION['usuario_tor']=$row['usuario_usuario'];
            $_SESSION['privilegio_tor']=$row['usuario_privilegio'];
            $_SESSION['tipo_tor']=$row['usuario_tipo'];
            $_SESSION['imagen_tor']=$row['usuario_imagen'];
            $_SESSION['token_tor']=md5(uniqid(mt_rand(),true)); //solamente cierra sesion cuando nosotros le demos clic a cerrar
            
          //  return header("Location: " . SERVERURL . "home/");
           
            if (headers_sent()) { //si es true si se estan enviando encabezados desde php 
                echo "<script> window.location.href='" . SERVERURL . "home/'; </script>";
            } else {
                return header("Location: " . SERVERURL . "home/");
            } 
        } else {
            echo '<script>
                Swal.fire({
            title: "Ha ocurrido un error inesperado",
            text: "El Usuario o Clave son incorrectos",
            type: "error",
            confirmButtonText: "Aceptar"
        });
        </script>';
        }
        
    } /* fin de controlador iniciar sesion */

    /* Inicio de sesion para los club registrados en el sistema */
    public function iniciar_sesion_club_controlador(){
        $usuario = mainModel::limpiar_cadena($_POST['usuario_log']);
        $clave = mainModel::limpiar_cadena($_POST['clave_log']);
        
        /* -----------  Comprobar los campos vacios ------------ */
        if ($usuario == "" || $clave == "") {
            //como no se usa ajax para el login
            //se crea javascript puro
            echo '<script>'
                . 'Swal.fire({title: "Ha ocurrido un error inesperado", text: "No has llenado todos los campos que son requeridos", type: "error", confirmButtonText: "Aceptar" });'
                    . '</script>';
                    exit();
        }
        
        /* --------- Verificar integridad de los datos ----------- */
        if (filter_var($usuario, FILTER_VALIDATE_EMAIL)) {
            
        } else {
            echo '<script>
                Swal.fire({
            title: "Ha ocurrido un error inesperado",
            text: "Ha ingresado un correo no valido",
            type: "error",
            confirmButtonText: "Aceptar"
        });
        </script>';
            exit();
        }
        
        
        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
            echo '<script>
                Swal.fire({
            title: "Ha ocurrido un error inesperado",
            text: "La Clave no coincide con el formato especificado",
            type: "error",
            confirmButtonText: "Aceptar"
        });
        </script>';
            exit();
        }
        
        $clave = mainModel::encryption($clave);
        
        /* -------   Crear array de datos   -------- */
        $datos_login = [
            "Usuario" => $usuario,
            "Clave" => $clave
        ];
        
        $datos_cuenta = loginModelo::iniciar_sesion_club_modelo($datos_login);
        
        if ($datos_cuenta->rowCount() == 1) {
            $row=$datos_cuenta->fetch();
            
            session_start(['name'=>'TOR']);
            
            $_SESSION['id_tor']=$row['club_id'];
            $_SESSION['nombre_tor']=$row['club_nombre'];
            $_SESSION['apellido_tor']="Club";
            $_SESSION['usuario_tor']=$row['club_correo'];
            $_SESSION['privilegio_tor']=4; //El cuatro corresponde a un club
            $_SESSION['tipo_tor']=1;
            $_SESSION['imagen_tor']=$row['club_imagen'];
            $_SESSION['token_tor']=md5(uniqid(mt_rand(),true)); //solamente cierra sesion cuando nosotros le demos clic a cerrar
            
            if (headers_sent()) { //si es true si se estan enviando encabezados desde php
                echo "<script> window.location.href='" . SERVERURL . "home/'; </script>";
            } else {
                return header("Location: " . SERVERURL . "home/");
            }
        } else {
            echo '<script>
                Swal.fire({
            title: "Ha ocurrido un error inesperado",
            text: "Usuario o Clave incorrecta, o su cuenta ha sido bloqueada. Por favor intente nuevamente",
            type: "error",
            confirmButtonText: "Aceptar"
        });
        </script>';
        }
        
    } /* fin de controlador iniciar sesion */
    
    /* Fin Controlador */
    
    /*--------- Controlador para forzar cierre de sesion  --------*/
    public function forzar_cierre_sesion_controlador(){
        session_unset();
        session_destroy();
        if(headers_sent()){ //si es true si se estan enviando encabezados desde php 
            echo "<script> window.location.href='".SERVERURL."login/'; </script>";
         
        }else{
            return header("Location: " . SERVERURL . "login/");
        }
    } /* Fin Controlador forzar cierre de sesion */
    
    /*--------- Controlador cierre de sesion  --------*/
    public function cerrar_sesion_controlador(){
        session_start(['name'=>'TOR']);
        $token = mainModel::decryption($_POST['token']);
        $usuario = mainModel::decryption($_POST['usuario']);
        if($token==$_SESSION['token_tor'] && $usuario==$_SESSION['usuario_tor']){
            session_unset();
            session_destroy();
            $alerta=[
                "Alerta"=>"redireccionar",
                "URL"=>SERVERURL."login/",
            ];
        }else{
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ha ocurrido un error inesperado",
                "Texto" => "No se pudo cerrar la sesion en el sistema",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }/*--- fin Cierre Sesion controlador-----*/
    
}
