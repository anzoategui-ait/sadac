<?php
require_once "mainModel.php";

class usuarioModelo extends mainModel{
    
       /** Modelo para agregar relacion usuario cargo **/
    protected static function agregar_usuario_cargo_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario_cargo(usuario_id, cargo_id) VALUES (:Usuario, :Cargo)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Cargo", $datos['Cargo']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar cargo*/
    
    /** Modelo para eliminar relacion usuario cargo **/
    protected static function eliminar_usuario_cargo_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM usuario_cargo WHERE usuario_cargo_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar cargo*/
    
    /*------------- Modelo para agregar usuario -----------------*/
    protected static function agregar_usuario_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario(usuario_dni, usuario_nombre,"
                . " usuario_apellido, usuario_telefono, usuario_direccion, usuario_email, "
                . "usuario_usuario, usuario_clave, usuario_estado, usuario_privilegio, usuario_imagen, usuario_tipo, usuario_genero, usuario_fecha_nacimiento) VALUES(:DNI, :Nombre, :Apellido, :Telefono, "
                . ":Direccion, :Email, :Usuario, :Clave, :Estado, :Privilegio, :Imagen, :Tipo, :Genero, :Fecha)");
        //Agregar los marcadores
        $sql->bindParam(":DNI", $datos['DNI']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Privilegio", $datos['Privilegio']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":Genero", $datos['Genero']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->execute();
        
        return $sql;
    }
    /*Fin Modelo agregar usuario*/
    
     /*------------- Modelo para eliminar usuario -----------------*/
    protected static function eliminar_usuario_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM usuario WHERE usuario_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar usuario*/
   
    /**** Modelo para obtener los datos del usuario ********/
    protected static function datos_usuario_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM usuario WHERE usuario_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT usuario_id FROM usuario WHERE usuario_id!='1'");
        }elseif($tipo=="Home"){
            $sql= mainModel::conectar()->prepare("SELECT usuario_id, usuario_usuario, usuario_nombre, usuario_apellido, usuario_imagen FROM usuario WHERE usuario_tipo='3'");
        }elseif($tipo=="Reporte-usuario"){
            $sql= mainModel::conectar()->prepare("SELECT usuario_id, usuario_usuario FROM usuario WHERE usuario_id!='1'");
        }elseif($tipo=="Todos"){
            $sql= mainModel::conectar()->prepare("SELECT usuario_id, usuario_usuario, usuario_nombre, usuario_apellido FROM usuario WHERE usuario_id!='1'");
        }elseif($tipo=="Operador"){
            $sql= mainModel::conectar()->prepare("SELECT usuario_id, usuario_usuario, usuario_nombre, usuario_apellido FROM usuario WHERE usuario_id!='1' AND usuario_tipo='3'");
        }elseif($tipo=="UsuarioParroquia"){
            $sql= mainModel::conectar()->prepare("SELECT parroquia.parroquia_nombre, parroquia.parroquia_id FROM usuario_parroquia INNER JOIN parroquia ON usuario_parroquia.parroquia_id = parroquia.parroquia_id WHERE usuario_parroquia.usuario_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Ciudadano"){
            $sql= mainModel::conectar()->prepare("SELECT usuario_id, usuario_usuario, usuario_nombre, usuario_apellido, usuario_telefono, usuario_fecha_nacimiento, usuario_genero FROM usuario WHERE usuario_tipo='4'");
        }
        
        $sql->execute();
        return $sql;
    } /* Fin modelo datos usuario*/
    
    /******  Modelo para editar usuario ******/
    protected static function actualizar_usuario_modelo($datos){
        $sql= mainModel::conectar()->prepare("UPDATE usuario SET usuario_dni=:DNI, usuario_nombre=:Nombre, "
                . "usuario_apellido=:Apellido, usuario_telefono=:Telefono, "
                . "usuario_direccion=:Direccion, usuario_email=:Email, usuario_usuario=:Usuario, usuario_clave=:Clave, "
                . "usuario_estado=:Estado, usuario_privilegio=:Privilegio, usuario_tipo=:Tipo, usuario_imagen=:Imagen, usuario_genero=:Genero, usuario_fecha_nacimiento=:Fecha WHERE usuario_id=:ID");
    
        $sql->bindParam(":DNI", $datos['DNI']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Privilegio", $datos['Privilegio']);
        $sql->bindParam(":Imagen", $datos['Imagen']);
        $sql->bindParam(":Tipo", $datos['Tipo']);
        $sql->bindParam(":Genero", $datos['Genero']);
        $sql->bindParam(":Fecha", $datos['Fecha']);
        $sql->bindParam(":ID", $datos['ID']);
        
        $sql->execute();
        return $sql;
        
    }
    
        /** Modelo para agregar relacion usuario parroquia **/
    protected static function agregar_usuario_parroquia_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario_parroquia(usuario_id, parroquia_id) VALUES (:Usuario, :Parroquia)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Parroquia", $datos['Parroquia']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar parroquia*/
    
       /** Modelo para agregar relacion usuario sector **/
    protected static function agregar_usuario_sector_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO usuario_sector(usuario_id, sector_id) VALUES (:Usuario, :Sector)");
        //Agregar los marcadores
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Sector", $datos['Sector']);
        $sql->execute();
        return $sql;
    } /*Fin Modelo agregar sector*/
    
}
