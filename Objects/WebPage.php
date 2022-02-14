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

    public function getPageLink() {
        return $this->pageLink;
    }

    public function getPageTitle() {
        return $this->pageTitle;
    }

    public function getPageDescription() {
        return $this->pageDescription;
    }

    public function setPageLink($pageLink): void {
        $this->pageLink = $pageLink;
    }

    public function setPageTitle($pageTitle): void {
        $this->pageTitle = $pageTitle;
    }

    public function setPageDescription($pageDescription): void {
        $this->pageDescription = $pageDescription;
    }


}
