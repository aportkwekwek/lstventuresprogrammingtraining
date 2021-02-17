<?php
    include_once('pdfconfig.php');
    $pdf =& new Cezpdf();
    SetPDFConfig($pdf);
    $data = array(
    array('num'=>1,'name'=>'gandalf','type'=>'wizard')
    ,array('num'=>2,'name'=>'bilbo','type'=>'hobbit','url'=>'http://www.ros.co.nz/pdf/')
    ,array('num'=>3,'name'=>'frodo','type'=>'hobbit')
    ,array('num'=>4,'name'=>'saruman','type'=>'bad dude','url'=>'http://sourceforge.net/projects/pdf-php')
    ,array('num'=>5,'name'=>'sauron','type'=>'really bad dude')
    );
    $pdf->addText(0,500,10,"the quick brown fox <b>jumps</b> <i>over</i> the lazy dog!");
    SetFontStyleAsBold($pdf);
    $pdf->addText(0,600,10,"the quick brown fox <b>jumps</b> <i>over</i> the lazy dog!");
    SetFontStyleAsNormal($pdf);
    $pdf->addText(0,700,10,"the quick brown fox <b>jumps</b> <i>over</i> the lazy dog!");
    SetFontStyleAsItalic($pdf);
    $pdf->addText(0,400,10,"the quick brown fox <b>jumps</b> <i>over</i> the lazy dog!");
    SetFontStyleAsSpecial($pdf);
    $pdf->addText(0,300,10,"the quick brown fox <b>jumps</b> <i>over</i> the lazy dog!");
    SetFontStyleAsNormal($pdf);
    $pdf->ezTable($data);
    $pdf->ezStream();
?>
<?
/*    
    error_reporting(0);
    
    include ('class.ezpdf.php');      
    
    $pdf =&new Cezpdf();
    
    //$token = md5(uniqid(rand(), true));
    
    die($token);
    
    $pdf->setEncryption('',$token,array('copy','print'))    
    
    //$pdf->selectFont('../fonts/Helvetica.afm');
    
    /*$data = array(
    array('num'=>1,'name'=>'gandalf','type'=>'wizard')
    ,array('num'=>2,'name'=>'bilbo','type'=>'hobbit','url'=>'http://www.ros.co.nz/pdf/')
    ,array('num'=>3,'name'=>'frodo','type'=>'hobbit')
    ,array('num'=>4,'name'=>'saruman','type'=>'bad dude','url'=>'http://sourceforge.net/projects/pdf-php')
    ,array('num'=>5,'name'=>'sauron','type'=>'I am testing EzPDF')
    );
        
    $pdf->ezTable($data);*/
    
    //$pdf->addText(0,500,10,"the quick brown fox <b>jumps</b><i>over</i> the lazy dog!");
    //$pdf->ezStream();*/
?>