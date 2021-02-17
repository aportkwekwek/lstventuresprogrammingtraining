<?
    //EzPDF Configurations
    //Last Modified: November 13, 2007 10:51AM
    include_once('class.ezpdf.php');
    
    function SetPDFConfig(&$pdf){
        $pdf->selectFont('../fonts/Helvetica.afm');
        $token = md5(uniqid(rand(), true));
        $pdf->setEncryption('',$token,array('copy','print'));    
    }
    
    function SetFontStyleAsBold(&$pdf){
        $pdf->selectFont('../fonts/Helvetica-Bold.afm');        
    }
    
    function SetFontStyleAsNormal(&$pdf){
        $pdf->selectFont('../fonts/Helvetica.afm');        
    }
    
    function SetFontStyleAsItalic(&$pdf){
        $pdf->selectFont('../fonts/Helvetica-Oblique.afm');      
    }
    
    function SetFontStyleAsSpecial(&$pdf){
        $pdf->selectFont('../fonts/Helvetica-BoldOblique.afm');      
    }
?>
