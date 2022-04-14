<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of AttendanceXSLT
 *
 * @author Ng Kar Kai
 */
class AttendanceXSLT {
    
    public function __construct($xmlFile, $xslFile) {
        $xml = new DOMDocument();
        $xml->load($xmlFile);
        
        $xsl = new DOMDocument();
        $xsl->load($xslFile);
        
        $process = new XSLTProcessor();
        $process->importStylesheet($xsl);
        
        echo $process->transformToXml($xml);
    }
}
