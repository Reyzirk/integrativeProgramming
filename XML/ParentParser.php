<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ParentTypess.php";

class ParentParser {
    
    private $parentTypPar;
    
    public function __construct($filename) {
        $this->parentTypPar = new SplObjectStorage();
        $this->readFromXML($filename);
        $this->display();
    }
    
    public function readFromXML($filename) {
        $xml = simplexml_load_file($filename);
        $paList = $xml->parentType;
        
        foreach ($paList as $row){
            $attr = $row->attributes();
            $pList = new ParentTypess($attr->pType, $row->type, $row->shortForm, $row->description);
            $this->parentTypPar->attach($pList);
        }
    }
    
    public function display() {
        echo "<h2>Parent Types</h2>";
        foreach($this->parentTypPar as $row){
            print $row."<br/>";
        }
    }

}

$newType = new ParentParser("parent.xml");