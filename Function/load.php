<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Check session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'ini_load.php';
