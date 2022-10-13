<?php

require_once "mainModel.php";

class procesarModelo extends mainModel {

    /** Modelo para agregar procesar * */
    protected static function agregar_procesar_modelo($datos) {
        $sql = mainModel::conectar()->prepare("INSERT INTO procesar (asignacion_id, paso_id, procesar_observacion, fecha_inicio, fecha_fin) VALUES (:Asignacion, :Paso, :Observacion, :Inicio, :Fin)");
        //Agregar los marcadores
        $sql->bindParam(":Asignacion", $datos['Asignacion']);
        $sql->bindParam(":Paso", $datos['Paso']);
        $sql->bindParam(":Observacion", $datos['Observacion']);
        $sql->bindParam(":Inicio", $datos['Inicio']);
        $sql->bindParam(":Fin", $datos['Fin']);
        $sql->execute();
        return $sql;
    }

    /* Fin Modelo agregar procesar */
    /** Modelo para eliminar procesar * */
    protected static function eliminar_procesar_modelo($id) {
        $sql = mainModel::conectar()->prepare("DELETE FROM procesar WHERE procesar_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }

    /* Fin Modelo eliminar procesar */
    /** Modelo para obtener los datos del procesar * */
    protected static function datos_procesar_modelo($tipo, $id) {
        if ($tipo == "Unico") {
            $sql = mainModel::conectar()->prepare("SELECT * FROM procesar WHERE procesar_id=:ID");
            $sql->bindParam(":ID", $id);
        } elseif ($tipo == "Conteo") {
            $sql = mainModel::conectar()->prepare("SELECT procesar_id FROM procesar");
        } elseif ($tipo == "Lista") {
            $sql = mainModel::conectar()->prepare("SELECT * FROM procesar");
        } elseif ($tipo == "Todos") {
            $sql = mainModel::conectar()->prepare("SELECT * FROM procesar ORDER BY procesar_nombre ASC");
        }

        $sql->execute();
        return $sql;
    }

    /* Fin modelo datos procesar */
    /*------------- Modelo para agregar vincular equipo -----------------*/
    protected static function vincular_equipo_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO equipo_actividad(sol_act_id, producto_codigo) VALUES (:ID, :Codigo)");
        //Agregar los marcadores
        $sql->bindParam(":ID", $datos['ID']);
        $sql->bindParam(":Codigo", $datos['Codigo']);
        $sql->execute();
        
        return $sql;
    } /*Fin Modelo agregar pdf */

    /**  Modelo para editar procesar * */
    protected static function actualizar_procesar_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE procesar SET procesar_nombre=:Nombre, procesar_descripcion=:Descripcion WHERE procesar_id=:ID");

        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Descripcion", $datos['Descripcion']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

    /**  Modelo para actualizar la tabla solicitud estado * */
    protected static function finalizar_asignacion_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE solicitud_actividad SET solicitud_estado=:Estado, solicitud_fin=:Fin WHERE sol_act_id=:ID");

        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Fin", $datos['Fin']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }
    
    /**  Modelo para actualizar la tabla solicitud estado * */
    protected static function actualizar_solicitud_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE solicitud SET solicitud_estado=:Estado WHERE solicitud_id=:ID");

        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":ID", $datos['ID']);

        $sql->execute();
        return $sql;
    }

    //Modelo para agregar datos a la tabla grafica solicitud
    protected static function agregar_grafica_solicitud_modelo($datos) {
        $sql = mainModel::conectar()->prepare("INSERT INTO grafica_solicitud (grafica_solicitud_year, grafica_solicitud_mes_id, grafica_solicitud_solicitadas, grafica_solicutud_finalizadas) VALUES (:Year, :Mes, :Solicitadas, :Finalizadas)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Mes", $datos['Mes']);
        $sql->bindParam(":Solicitadas", $datos['Solicitadas']);
        $sql->bindParam(":Finalizadas", $datos['Finalizadas']);
        $sql->execute();
        return $sql;
    }

    /* Fin Modelo agregar asignacion */

    protected static function actualizar_grafica_finalizadas_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE grafica_solicitud SET grafica_solicitud_finalizadas=grafica_solicitud_finalizadas + :Cantidad WHERE grafica_solicitud_year=:Year AND grafica_solicitud_mes_id=:Mes");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Mes", $datos['Mes']);

        $sql->execute();
        return $sql;
    }

    protected static function agregar_operador_home_modelo($datos) {
        $sql = mainModel::conectar()->prepare("INSERT INTO home_operador (home_operador_year, home_operador_cantidad_anual, home_operador_porcentaje_anual, home_operador_cantidad_mensual, home_operador_porcentaje_mensual, home_operador_cantidad_diario, home_operador_porcentaje_diario, usuario_id, usuario_nombre, usuario_imagen, home_operador_fecha) VALUES (:Year, :YearCantidad, :YearPorcentaje, :MesCantidad, :MesPorcentaje, :DiaCantidad, :DiaPorcentaje, :UsuarioID, :Nombre, :Imagen, :Fecha)");
        //Agregar los marcadores
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":YearCantidad", $datos['YearCantidad']);
        $sql->bindParam(":YearPorcentaje", $datos['YearPorcentaje']);
        $sql->bindParam(":MesCantidad", $datos['MesCantidad']);
        $sql->bindParam(":MesPorcentaje", $datos['MesPorcentaje']);
        $sql->bindParam(":DiaCantidad", $datos['DiaCantidad']);
        $sql->bindParam(":DiaPorcentaje", $datos['DiaPorcentaje']);
        $sql->bindParam(":UsuarioID", $datos['UsuarioID']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->execute();
        return $sql;
    }

    protected static function actualizar_operador_home_anual_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE home_operador SET home_operador_cantidad_anual=home_operador_cantidad_anual + :Cantidad WHERE home_operador_year=:Year AND usuario_id=:Operador");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
       // $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Operador", $datos['Operador']);

        $sql->execute();
        return $sql;
    }

    protected static function actualizar_operador_home_mes_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE home_operador SET home_operador_cantidad_mensual=home_operador_cantidad_mensual + :Cantidad WHERE home_operador_year=:Year AND usuario_id=:Operador");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
       // $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Operador", $datos['Operador']);

        $sql->execute();
        return $sql;
    }

    protected static function actualizar_operador_home_mes_diferente_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE home_operador SET home_operador_cantidad_mensual= :Cantidad, home_operador_fecha= :Fecha WHERE home_operador_year=:Year AND usuario_id=:Operador");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
       // $sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Operador", $datos['Operador']);
        $sql->bindParam(":Fecha", $datos['Fecha']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_operador_home_dia_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE home_operador SET home_operador_cantidad_diario=home_operador_cantidad_diario + :Cantidad WHERE home_operador_year=:Year AND usuario_id=:Operador");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        //$sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Operador", $datos['Operador']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_operador_home_dia_diferente_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE home_operador SET home_operador_cantidad_diario= :Cantidad, home_operador_fecha= :Fecha WHERE home_operador_year=:Year AND usuario_id=:Operador");

        //Agregar los marcadores
        $sql->bindParam(":Cantidad", $datos['Cantidad']);
        //$sql->bindParam(":Porcentaje", $datos['Porcentaje']);
        $sql->bindParam(":Year", $datos['Year']);
        $sql->bindParam(":Operador", $datos['Operador']);
        $sql->bindParam(":Fecha", $datos['Fecha']);

        $sql->execute();
        return $sql;
    }
    
    protected static function actualizar_home_porcentajes_modelo($datos) {
        $sql = mainModel::conectar()->prepare("UPDATE home_operador SET home_operador_porcentaje_anual = :YearPorcentaje, home_operador_porcentaje_mensual = :MesPorcentaje, home_operador_porcentaje_diario = :DiaPorcentaje WHERE home_operador_id =:ID");

        //Agregar los marcadores
        $sql->bindParam(":ID", $datos['ID']);
        $sql->bindParam(":YearPorcentaje", $datos['YearPorcentaje']);
        $sql->bindParam(":MesPorcentaje", $datos['MesPorcentaje']);
        $sql->bindParam(":DiaPorcentaje", $datos['DiaPorcentaje']);
        $sql->execute();
        return $sql;
    }

}
