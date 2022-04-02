<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once 'XML/HolidaysXSLT.php';
$xslt = new HolidaysXSLT('XML/holidays.xml');
$xslt->setStyleSheet('XML/Holidaylist.xsl');
echo $xslt->displayList("2022-03-09");
?>
