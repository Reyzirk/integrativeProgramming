<?php
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea","",dirname(__DIR__)).'/XML/WebPageParser.php';
$author = "Ng Kar Kai, Oon Kheng Huang, Tang Khai Li, Fong Shu Ling, Poh Choo Meng";
$keywords = "Kindergarden, Education, Learning";
$fileName = pathinfo($_SERVER['PHP_SELF'],PATHINFO_BASENAME);
$parser = new WebPageParser(str_replace("InstructorArea","",dirname(__DIR__))."/XML/InstructorSideWebPage.xml");
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
    <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
    <title>$pageTitle | Instructor Section</title>
    <link href='css/main.css' rel='stylesheet' type='text/css'/>
    <link href='css/sb-admin-2.css' rel='stylesheet' type='text/css'/>
    <link href='../css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
    <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
    <script src='../js/jquery-3.6.0.js' type='text/javascript'></script>
    <script src='../js/sweetalert2.all.min.js' type='text/javascript'></script>
    <script src='../js/ckeditor.js' type='text/javascript'></script>
    <script src='js/sb-admin-2.min.js' type='text/javascript'></script>
    <script src='js/main.js' type='text/javascript'></script>
        ");
