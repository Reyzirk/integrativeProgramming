<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

class AnnouncementXSLT{
    
    public function __construct($xmlfile, $xslfile) {
       $xml = new DOMDocument();
       $xml->load($xmlfile);
       
       $xsl = new DOMDocument();
       $xsl->load($xslfile);
       
       $proc = new XSLTProcessor();
       $proc->importStylesheet($xsl);
       
       echo $proc->transformToXml($xml);
    }
}








