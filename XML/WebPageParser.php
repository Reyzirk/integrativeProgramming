<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of PageTitleParser
 *
 * @author Choo Meng
 */

require_once dirname(__DIR__)."/Objects/WebPage.php";
class WebPageParser {
    private $webpage, $webpageTemp, $file, $temp, $error, $pageLink;
    public function __construct($file) {
        $this->file = $file;
        $this->webpage = array();
        $this->error = $this->parseDocument();
    }
    public function getStartElement($parser, $name, $attr){
        if (!empty($name)){
            if (strtolower($name)=="page"){
                $this->webpageTemp = new WebPage();
            }
        }
    }
    public function getEndElement($parser, $name){
        switch(strtolower($name)){
            case "page":
                $this->webpage[$this->webpageTemp->pageLink] = $this->webpageTemp;
                break;
            case "pagetitle":
                $this->webpageTemp->pageTitle = $this->temp;
                break;
            case "pagelink":
                $this->webpageTemp->pageLink = $this->temp;
                break;
            case "pagedescription":
                $this->webpageTemp->pageDescription = $this->temp;
                break;
        }
    }
    public function characters($parser,$data){
        if (!empty($data)){
            $this->temp = trim($data);
        }
    }
    
    private function parseDocument():bool{
        $parser = xml_parser_create();
        xml_set_element_handler($parser, array($this, "getStartElement"), array($this,"getEndElement"));
        xml_set_character_data_handler($parser, array($this,"characters"));
        $fileHandle = fopen($this->file,"r"); //Open the file in read mode
        if ($fileHandle == false){
            return false;
        }
        while ($data = fread($fileHandle,4096)){
            xml_parse($parser, $data);
        }
        return true;
    }
    public function getWebpage() {
        return $this->webpage;
    }

    public function getError() {
        return $this->error;
    }


}
