<?php

require './fpdf.php';

class PDF extends FPDF {

    function Header() {
        $this->Image('../vistas/asset/img/fondosocial.png', 0, 0);
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(0, 107, 181);
        // $this->Cell(0, 10, utf8_decode(strtoupper("COMPROBANTE")), 0, 0, 'R');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-12);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(251, 249, 248);
        $this->Cell(0, 10, utf8_decode("Página ") . $this->PageNo() . ' / {nb}', 0, 0, 'R');
    }
    
}
?>