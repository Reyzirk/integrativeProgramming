<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */

class ParentXPath{
    
    private $xpath;
    
    public function __construct($filename) {
        $doc = new DOMDocument();
        $doc->load($filename);
        $this->xpath = new DOMXPath($doc);
    }
    
    public function display($show){
        $item = $this->xpath->query($show);
        foreach($item as $row){
            echo $row->nodeValue."<br/>";
        }
    }
    
    public function evaluate($show){
        $result = $this->xpath->evaluate($show);
        echo $result."<br/>";
    }
    
}

