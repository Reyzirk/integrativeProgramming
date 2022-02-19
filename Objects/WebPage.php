<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of PageTitle
 *
 * @author Choo Meng
 */
class WebPage {
    private $pageLink, $pageTitle, $pageDescription;
    public function __construct($pageLink=null, $pageTitle=null, $pageDescription=null) {
        $this->pageLink = $pageLink;
        $this->pageTitle = $pageTitle;
        $this->pageDescription = $pageDescription;
    }

    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
    public function __set($name, $value) {
        if (property_exists($this, $name)){
            $this->$name = $value;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }


}
