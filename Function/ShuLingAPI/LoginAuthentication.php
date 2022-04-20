<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of LoginAuthentication
 *
 * @author Shu Ling
 */
header("Content-Type:application/json");
require_once "Database/ParentDB.php";

if (!empty($_GET['email'])&&!empty($_GET['password'])) {
    $email = eliminateExploit($_GET['email']);
    $password = eliminateExploit($_GET["password"]);
    $db = new ParentDB();
    $result = $db->login($email);
    if ($result == null){
        response(200, "FAILED");
    }else{
        if (password_verify($password,$result->password)){
            
            response(200, "SUCCESS");
        }else{
            response(200, "FAILED");
        }
    }
} else {
    header("HTTP/1.1 400 Invalid Request");
}

function response($status, $status_message) {
    header("HTTP/1.1 " . $status);

    $response['status'] = $status;
    $response['status_message'] = $status_message;

    $json_response = json_encode($response, JSON_PRETTY_PRINT);
    echo $json_response;
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
