<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of CourseController
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", str_replace("Function", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
require_once "BaseController.php";
require_once "Controller.php";
class CourseController extends BaseController implements Controller{
    private static $controller = NULL;
    
    public static function getInstance(){
        if (self::$controller == NULL){
            self::$controller = new CourseController();
        }
        return self::$controller;
    }
    //Get the list of the course
    public function list() {
        $entry = 20;
        $currentPage = 1;
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $factory = new ParserFactory();
                $parser = $factory->getParser("Courses");
                $courses = $parser->getCourses();
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) ."/config.ini",true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        foreach ($courses as $key) {
                            $courseList[] = $key;
                        }
                        if (isset($params["limit"])) {
                            $entry = $params["limit"];
                        }
                        if (!empty($params["index"])) {
                            $currentPage = $params["index"];
                        }
                        $totalCount = count($courses);
                        $beginIndex = ($currentPage - 1) * $entry;
                        $endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
                        $count = 0;
                        $data=array();
                        for ($i = $beginIndex; $i < $endIndex; $i++) {
                            $count++;
                            $key = $courseList[$i];
                            $materials = $key->courseMaterials;
                            $material = array();
                            foreach($materials as $key2){
                                $material[] = array("Material Name"=>(string)$key2->materialName,"Link"=>(string)$key2->materialLink);
                            }
                            $data[] = array("Course Code" => (string) $key->courseCode, "Course Name" => (string) $key->courseName, "Course Description" => (string) $key->courseDesc, "Course Materials"=>$materials);
                        }
                        $output[] = array("Status"=>"Success","Data" => $data, "Total Record Retrieved" => $count);
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
    //Get the course details
    public function details() {
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $factory = new ParserFactory();
                $parser = $factory->getParser("Courses");
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) ."/config.ini",true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        if (empty($params["id"])){
                            $output[] = array("Status" => "Failed", "Message" => "Required Course ID to retrieve the data.");
                        }else{
                            $code = $params["id"];
                            $course = $parser->getCourse($code);
                            if ($course==NULL){
                                $output[] = array("Status" => "Failed", "Message" => "The course id given is not existing.");
                            }else{
                                $materials = $course->courseMaterials;
                                $material = array();
                                foreach($materials as $key2){
                                    $material[] = array("Material Name"=>(string)$key2->materialName,"Link"=>(string)$key2->materialLink);
                                }
                                $data = array("Course Code" => (string) $course->courseCode, "Course Name" => (string) $course->courseName, "Course Description" => (string) $course->courseDesc, "Course Materials"=>$materials);
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
