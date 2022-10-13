<?php

if ($peticionAjax) {
    require_once "../config/SERVER.php";
} else {
    require_once "./config/SERVER.php";
}

class mainModel {
    /* ----- Modelo para conectar con la base de datos ------- */

    protected static function conectar() {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    /* ----- Funcion para ejecutar consultas simples --------- */

    protected static function ejecutar_consulta_simple($consulta) {
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    /* ----- Funcion para encriptar una cadena --------- */

    public function encryption($string) {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    /* ----- Funcion para desencriptar una cadena --------- */

    protected static function decryption($string) {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    /* ----- Generar Codigos Aleatorios ------ */

    protected static function generar_codigo_aleatorio($letra, $longitud, $numero) {
        for ($i = 1; $i <= $longitud; $i++) {
            $aleatorio = rand(0, 9);
            $letra .= $aleatorio;
        }
        return $letra . "-" . $numero;
    }

    /* -------- Funcion para limpiar injercion sql en cadenas ----- */

    protected static function limpiar_cadena($cadena) {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);
        $cadena = stripslashes($cadena);
        $cadena = trim($cadena);
        return $cadena;
    }

    /* ------ Modelo para verificar datos ------- */

    protected static function verificar_datos($filtro, $cadena) {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }

    /* ------ Modelo para verificar fechas ------- */

    protected static function verificar_fechas($fecha) {
        $valores = explode("-", $fecha);
        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return false;
        } else {
            return true;
        }
    }

    /* -------- Funcion paginador de tablas --------- */

    protected static function paginador_tablas($pagina, $Npaginas, $url, $botones) {
        $tabla = '<nav aria-label="Page navigation example" class="text-center"><ul class="pagination justify-content-center">';
        if ($pagina == 1) {
            $tabla .= '<li class="page-item disabled"><a class="page-link"><i class="fa-angle-double-left fa"></i></a></li>';
        } else {
            $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . '1/"><i class="fa-angle-double-left fa"></i></a></li>'
                    . '<li class="page-item"><a class="page-link" href="' . $url . ($pagina - 1) . '/">Anterior</a></li>';
        }

        $ci = 0;
        for ($i = $pagina; $i <= $Npaginas; $i++) {
            if ($ci >= $botones) {
                break;
            }

            if ($pagina == $i) {
                $tabla .= '<li class="page-item"><a class="page-link active" href="' . $url . $i . '/">' . $i . '</a></li>';
            } else {
                $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            }

            $ci++;
        }


        if ($pagina == $Npaginas) {
            $tabla .= '<li class="page-item disabled"><a class="page-link"><i class="fa-angle-double-right fa"></i></a></li>';
        } else {
            $tabla .= '<li class="page-item"><a class="page-link" href="' . $url . ($pagina + 1) . '/">Siguiente</a></li>'
                    . '<li class="page-item"><a class="page-link" href="' . $url . $Npaginas . '/"><i class="fa-angle-double-right fa"></i></a></li>';
        }

        $tabla .= '</ul></nav>';
        return $tabla;
    }

    /*     * ***-----  Modelo para crear la fecha con la hora exacta  -----**** */

    protected static function crear_fecha() {
        date_default_timezone_set("America/Caracas");
        return strftime("%Y-%m-%d %H:%M:%S", time());
    }

    /*     * *--- Modelo Para Obtener la Fecha solamente sin la hora ---** */

    protected static function solo_fecha() {
        date_default_timezone_set("America/Caracas");
        $fecha = date('Y-m-d');
        return $fecha;
    }

    /*     * *--- Modelo Para Obtener la Hora, solamente hora y minutos ---** */

    protected static function solo_hora() {
        date_default_timezone_set("America/Caracas");
        return strftime("%H:%M:%S", time());
    }

    # Funcion renombrar fotos #

    function renombrar_fotos($nombre) {
        $nombre = str_ireplace(" ", "_", $nombre);
        $nombre = str_ireplace("/", "_", $nombre);
        $nombre = str_ireplace("#", "_", $nombre);
        $nombre = str_ireplace("-", "_", $nombre);
        $nombre = str_ireplace("$", "_", $nombre);
        $nombre = str_ireplace(".", "_", $nombre);
        $nombre = str_ireplace(",", "_", $nombre);
        $nombre = $nombre . "_" . rand(0, 100);
        return $nombre;
    }


     /* -- Obtener la edad -- */
        protected static function obtener_edad($fecha1, $fecha2) {
        
        if($fecha2 == "0000-00-00 00:00:00"){
        date_default_timezone_set("America/Caracas");
        $fecha2 = strftime("%Y-%m-%d %H:%M:%S", time());
        }
        
        $firstDate = new DateTime($fecha1);
        $secondDate = new DateTime($fecha2);
        $intvl = $firstDate->diff($secondDate);

        $cad =  $intvl->y;
        
        return $cad;
    }

    /* -- Obtener dias transcurridos -- */

    protected static function dias_transcurridos($fecha1, $fecha2) {
        
        if($fecha2 == "0000-00-00 00:00:00"){
        date_default_timezone_set("America/Caracas");
        $fecha2 = strftime("%Y-%m-%d %H:%M:%S", time());
        }
        
        
        $firstDate = new DateTime($fecha1);
        $secondDate = new DateTime($fecha2);
        $intvl = $firstDate->diff($secondDate);

        $cad = "Ha transcurrido " . $intvl->y . " años, " . $intvl->m . " meses y " . $intvl->d . " dias. ";
        $cad .= " Total: " . $intvl->days . " dias. Tiempo: " . $intvl->h . " Horas y " . $intvl->i . " Minutos";

//output: 1 year, 2 months and 1 day
//        428 days
        return $cad;
    }
    
     /* -- Obtener dias transcurridos antiguo codigo -- */

    protected static function dias_transcurridos_old($fecha1, $fecha2) {
        $rsPrimero = explode(" ", $fecha1);
        $primera_fecha = $rsPrimero[0]; 
        
        
        if($fecha2 != "0000-00-00 00:00:00"){
        $rsSegundo = explode(" ", $fecha2);
        $segunda_fecha = $rsSegundo[0]; 
        }else{
           $segunda_fecha = date("Y-m-d"); 
        }
        
        
        $firstDate = new DateTime($primera_fecha);
        $secondDate = new DateTime($segunda_fecha);
        $intvl = $firstDate->diff($secondDate);

        $cad = "Ha transcurrido " . $intvl->y . " años, " . $intvl->m . " meses y " . $intvl->d . " dias. ";
        $cad .= " Total: " . $intvl->days . " dias ";

//output: 1 year, 2 months and 1 day
//        428 days
        return $cad;
    }

}
