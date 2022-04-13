<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of AttendanceXPath
 *
 * @author Ng Kar Kai
 */
class AttendanceXPath {
    
    private $xpath; 
    
    public function __construct($filename) {
        $doc = new DOMDocument();
        $doc->load($filename);
        $this->xpath = new DOMXPath($doc);
    }
    
    public function display ($expression){
        $item = $this->xpath->query($expression);
        foreach ($item as $row){
            echo $row->nodeValue."<br/>";
        }
    }
    
    public function evaluate ($expression){
        $result = $this->xpath->evaluate($expression);
        echo $result."<br/>";
    }
}
