<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", str_replace("Function", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
require_once "BaseController.php";
require_once "Controller.php";

class GradeController extends BaseController implements Controller{
    private static $controller = NULL;
    
    public static function getInstance(){
        if (self::$controller == NULL){
            self::$controller = new GradeController();
        }
        return self::$controller;
    }
    //Get the list of the grade
    public function list() {
        $entry = 20;
        $currentPage = 1;
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $factory = new ParserFactory();
                $parser = $factory->getParser("Grades");
                $grades = $parser->getGrades();
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) ."/config.ini",true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        if (isset($params["limit"])) {
                            $entry = $params["limit"];
                        }
                        if (!empty($params["index"])) {
                            $currentPage = $params["index"];
                        }
                        if (!empty($params["mark"])) {
                            $mark = $params["mark"];
                        }
                        $totalCount = count($grades);
                        $beginIndex = ($currentPage - 1) * $entry;
                        $endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
                        $count = 0;
                        $data=array();
                        for ($i = $beginIndex; $i < $endIndex; $i++) {
                            $count++;
                            $key = $grades[$i];
                            if (!empty($params["search"])) {
                                if (!(custom_str_contains($key->grade, empty($params["search"]) ? "" : $params["search"]) ||
                                custom_str_contains($key->minMark, empty($params["search"]) ? "" : $params["search"])||
                                custom_str_contains($key->maxMark, empty($params["search"]) ? "" : $params["search"]))){
                                    $totalCount--;
                                    continue;
                                }
                                
                            }
                            if (!empty($mark)) {
                                $minMark = $key->minMark;
                                $maxMark = $key->maxMark;
                                if ($minMark <= $mark && $mark <= $maxMark) {
                                    continue;
                                }
                            }
                            $data[] = array("Grade ID"=> (string) $key->gradeID,"Grade" => (string) $key->grade, "Min Mark" => (string)$key->minMark, "Max Mark" => (string)$key->maxMark);
                        }
                        $output[] = array("Status"=>"Success","Data" => $data, "Total Record Retrieved" => $count, "Total Record in Database" => $totalCount);
                    }
                }

                $response = json_encode($output, JSON_PRETTY_PRINT);
            } catch (Exception $ex) {
                $errorDesc = "Something error! Please contact administrator.";
                $errorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $errorDesc = "Method not found";
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        if (empty($errorDesc)) {
            $this->sendOutput(
                    $response,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $errorDesc)),
                    array('Content-Type: application/json', $errorHeader)
            );
        }
    }
    //Get the grade
    public function get() {
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $factory = new ParserFactory();
                $parser = $factory->getParser("Grades");
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) ."/config.ini",true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        if (empty($params["mark"])){
                            $output[] = array("Status" => "Failed", "Message" => "Required mark to retrieve the data.");
                        }else{
                            $mark = $params["mark"];
                            $grade = $parser->getGradeByMark($mark);
                            if ($course==NULL){
                                $output[] = array("Status" => "Failed", "Message" => "The mark not under any grade.");
                            }else{
                                $data = array("Grade" => (string) $key->grade, "Min Mark" => (string)$key->minMark, "Max Mark" => (string)$key->maxMark);
                                $output[] = array("Status"=>"Success","Data" => $data);
                            }
                        }
                        
                    }
                }

                $response = json_encode($output, JSON_PRETTY_PRINT);
            } catch (Exception $ex) {
                $errorDesc = "Something error! Please contact administrator.";
                $errorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $errorDesc = "Method not found";
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        if (empty($errorDesc)) {
            $this->sendOutput(
                    $response,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $errorDesc)),
                    array('Content-Type: application/json', $errorHeader)
            );
        }
    }
}
