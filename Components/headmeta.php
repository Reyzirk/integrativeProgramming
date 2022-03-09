<?php
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once dirname(__DIR__).'/XML/WebPageParser.php';
$author = "Ng Kar Kai, Oon Kheng Huang, Tang Khai Li, Fong Shu Ling, Poh Choo Meng";
$keywords = "Kindergarden, Education, Learning";
$fileName = pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);
$companyName = $generalSection["companyName"];
$parser = new WebPageParser(dirname(__DIR__)."/XML/ParentSideWebPage.xml");
$webpage = empty($parser->getWebpage()[ str_replace(".php","",strtolower($fileName))])?"":
        $parser->getWebpage()[ str_replace(".php","",strtolower($fileName))];
$pageTitle = empty($webpage)?"":$webpage->pageTitle;
$description = empty($webpage)?"":$webpage->pageDescription;

echo("
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='author' content='$author'>
    <meta name='keywords' content='$keywords'>
    <meta name='description' content='$description'>
    <title>$pageTitle | $companyName</title>
    <link href='css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
    <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
    <script src='js/jquery-3.6.0.js' type='text/javascript'></script>
    <script src='js/sweetalert2.all.min.js' type='text/javascript'></script>
    <script src='js/ckeditor.js' type='text/javascript'></script>
        ");


