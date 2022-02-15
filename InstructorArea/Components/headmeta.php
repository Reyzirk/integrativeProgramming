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
$pageTitle = empty($webpage)?"":$webpage->getPageTitle();
$description = empty($webpage)?"":$webpage->getPageDescription();

echo("
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='author' content='$author'>
    <meta name='keywords' content='$keywords'>
    <meta name='description' content='$description'>
    <title>$pageTitle | Instructor Section</title>
        ");
