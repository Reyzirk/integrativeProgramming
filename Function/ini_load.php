<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Load the config ini file
$ini_array = parse_ini_file(dirname(__DIR__)."/config.ini",true);
$dbSection = $ini_array["Database"];
$mailSection = $ini_array["Mail"];
$generalSection = $ini_array["General"];
$recaptchaSection = $ini_array["Recaptcha"];

