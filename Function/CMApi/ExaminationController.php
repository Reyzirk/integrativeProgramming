<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", str_replace("Function", "", dirname(__DIR__))) . '/Database/ExamResultDB.php';
require_once "BaseController.php";
require_once "Controller.php";

class GradeController extends BaseController implements Controller {

    private static $controller = NULL;

    public static function getInstance() {
        if (self::$controller == NULL) {
            self::$controller = new GradeController();
        }
        return self::$controller;
    }

    //Get the student result
    public function get() {
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $resultdb = new ExamResultDB();
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) . "/config.ini", true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        if (empty($params["id"])) {
                            $output[] = array("Status" => "Failed", "Message" => "Required child ID to retrieve the data.");
                        } else {
                            $childID = $params["id"];
                            if (is_numeric($childID)) {
                                $classList = $resultdb->getResult($childID);
                                $classdata = array();

                                foreach ($classList as $class) {
                                    $examresult = $resultdb->getResultByClass($class, $childID);
                                    $examlistdata = array();
                                    foreach ($examresult as $row) {
                                        $examObj = $row->examinationID;
                                        $examdata = array("Examination ID" => $examObj->examinationID, "Course Code" => $examObj->course, "Exam Start Time" => $examObj->examStartTime, "Duration" => $examObj->examDuration, "Marks" => $row->Marks);
                                        $examlistdata[] = $examdata;
                                    }
                                    $classdata[] = array("Class ID" => $class, "Examination" => examlistdata);
                                }
                                $output[] = array("Status" => "Success", "Data" => $classdata);
                            } else {
                                $output[] = array("Status" => "Failed", "Message" => "Required child ID to retrieve the data.");
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

    //Get the list of the exam result
    public function list() {
        $entry = 20;
        $currentPage = 1;
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $resultdb = new ExamResultDB();
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) . "/config.ini", true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        if (empty($params["id"])) {
                            $output[] = array("Status" => "Failed", "Message" => "Required child ID to retrieve the data.");
                        } else {
                            $examID = $params["id"];
                            if (is_numeric($examID)) {
                                $examresult = $resultdb->getResultByExaminationID($examID);
                                $childdata = array();
                                foreach ($examresult as $row) {
                                    $examdata = array("Child Name"=>$row->ChildID,"Marks" => $row->Marks);
                                    $childdata[] = $examdata;
                                }
                                $output[] = array("Status" => "Success", "Data" => $childdata, "Total Record Retrieved" => count($examresult));
                            }else{
                                $output[] = array("Status" => "Failed", "Message" => "Required examination ID to retrieve the data.");
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
