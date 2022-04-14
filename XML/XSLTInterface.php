<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * //Author: Poh Choo Meng
 */
interface XSLTInterface{
    function displayList($search,$sortType,$sortOrder,$beginIndex,$endIndex, $templateFile = ""):String;
    function setStyleSheet($xslFile);
}
