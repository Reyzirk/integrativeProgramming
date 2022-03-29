<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

class AnnouncementXPath{
    
    private $xpath;
    
    public function __construct($filename) {
        $doc = new DOMDocument();
        $doc->load($filename);
        $this->xpath = new DOMXPath($doc);
    }
    
    public function display($expr){
        $item = $this->xpath->query($expr);
        foreach($item as $row){
            echo $row->nodeValue."<br/>";
        }
    }
    
    public function evaluate($expr){
        $result = $this->xpath->evaluate($expr);
        echo $result."<br/>";
    }
}

