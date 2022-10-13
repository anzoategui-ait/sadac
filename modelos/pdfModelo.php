<?php
require_once "mainModel.php";

class pdfModelo extends mainModel{
    /*------------- Modelo para agregar pdf -----------------*/
    protected static function agregar_pdf_modelo($datos){
        $sql=mainModel::conectar()->prepare("INSERT INTO pdf(asignacion_id, pdf_archivo) VALUES (:Asignacion, :Archivo)");
        //Agregar los marcadores
        $sql->bindParam(":Asignacion", $datos['Asignacion']);
        $sql->bindParam(":Archivo", $datos['Archivo']);
        $sql->execute();
        
        return $sql;
    } /*Fin Modelo agregar pdf */
    
    /*------------- Modelo para eliminar pdf -----------------*/
    protected static function eliminar_pdf_modelo($id){
        $sql= mainModel::conectar()->prepare("DELETE FROM pdf WHERE pdf_id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }/*Fin Modelo eliminar pdf*/
    
    /**** Modelo para obtener los datos de la pdf ********/
    protected static function datos_pdf_modelo($tipo, $id){
        if($tipo=="Unico"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM pdf WHERE pdf_id=:ID");
            $sql->bindParam(":ID", $id);
        }elseif($tipo=="Conteo"){
            $sql= mainModel::conectar()->prepare("SELECT pdf_id FROM pdf");
        }elseif($tipo=="Reporte"){
            $sql= mainModel::conectar()->prepare("SELECT * FROM pdf");
        }if($tipo=="Unico-Club"){
            $sql= mainModel::conectar()->prepare("SELECT pdf.pdf_id, club.club_nombre, club.club_id, pdf.pdf_monto, pdf_archivo, pdf_estado, pdf_descripcion, pdf_fecha FROM pdf INNER JOIN club ON pdf.usuario_id=club.club_id WHERE pdf.pdf_id=:ID");
            $sql->bindParam(":ID", $id);
        }
        
        $sql->execute();
        return $sql;
    } /* Fin modelo datos pdf*/
    
 
    
}