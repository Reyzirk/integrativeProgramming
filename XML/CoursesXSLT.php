<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once 'XSLTInterface.php';
class CoursesXSLT implements XSLTInterface{
    private static $instance;
    private $xml;
    private $xsl;
    private $xmlFile = "";
    private $xslFile = "";
    public static function getInstance($xmlFile){
        if (self::$instance==NULL){
            self::$instance = new CoursesXSLT($xmlFile);
        }
        return self::$instance;
    }
    public function __construct($xmlFile) {
        $this->xmlFile = $xmlFile;
        $this->xml = new DOMDocument();
        $this->xsl = new DOMDocument();
        $this->xml->load($xmlFile);
    }
    public function setStyleSheet($xslFile){
        $this->xslFile = $xslFile;
        $this->xsl = new DOMDocument();
        $this->xsl->load($xslFile);
    }
    public function displayList($search,$sortType,$sortOrder,$beginIndex,$endIndex, $templateFile = ""):String{
        if (empty($templateFile)){
            $templateFile = $this->xslFile;
        }
        if (empty($this->xslFile)){
            return "";
        }else{
            $xsl = new XSLTProcessor();
            $xsl->setParameter( '', 'search', $search);
            $xsl->setParameter( '', 'sortType', $sortType);
            $xsl->setParameter( '', 'sortOrder', $sortOrder);
            $xsl->setParameter( '', 'beginIndex', $beginIndex);
            $xsl->setParameter( '', 'endIndex', $endIndex);
            $xsl->importStylesheet($this->xsl);
            $result = $xsl->transformToXml($this->xml);
            if (empty($result)){
                return "";
            }else{
                return $result;
            }
        }
        
    }
}