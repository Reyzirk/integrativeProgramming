<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of BaseController
 *
 * @author Choo Meng
 */
class BaseController {
    //Method that only call whether the method that being called is not exist
    public function __call($name, $arguments) {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }
    //Get URI Part
    protected function getUriSegments(){
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
 
        return $uri;
    }
    //Get param of the query string
    protected function getParams(){
        parse_str($_SERVER['QUERY_STRING'], $result);
        return $result;
    }
    //Send the output to the webpage that requested
    protected function sendOutput($data,$httpHeaders){
        header_remove('Set-Cookie');
 
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $header) {
                header($header);
            }
        }
 
        echo $data;
        return;
    }
}
//For PHP version that below 8.0
function custom_str_contains(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}