<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */

class ParentXSLT{
    
    public function __construct($xmlfile, $xslfile) {
        
       $xml = new DOMDocument();
       $xml->load($xmlfile);
       
       $xsl = new DOMDocument();
       $xsl->load($xslfile);
       
       $procedure = new XSLTProcessor();
       $procedure->importStylesheet($xsl);
       
       echo $procedure->transformToXml($xml);
    }
    
}