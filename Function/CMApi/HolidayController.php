<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of HolidayController
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", str_replace("Function", "", dirname(__DIR__))) . '/XML/ParserFactory.php';
require_once "BaseController.php";
require_once "Controller.php";

class HolidayController extends BaseController implements Controller{
    private static $controller = NULL;
    
    public static function getInstance(){
        if (self::$controller == NULL){
            self::$controller = new HolidayController();
        }
        return self::$controller;
    }
    //Get the list of the holiday
    public function list() {
        $entry = 20;
        $currentPage = 1;
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method) == "GET") {
            try {
                $factory = new ParserFactory();
                $parser = $factory->getParser("Holidays");
                $holidays = $parser->getHolidays();
                $output = array();
                if (empty($params["api-key"])) {
                    $output[] = array("Status" => "Failed", "Message" => "Required API Key to retrieve the data.");
                } else {
                    $apiKey = $params["api-key"];
                    $ini_array = parse_ini_file(str_replace("Function", "", str_replace("InstructorArea", "", dirname(__DIR__))) ."/config.ini",true);
                    if ($apiKey != $ini_array["General"]["apiKey"]) {
                        $output[] = array("Status" => "Failed", "Message" => "Invalid API Key to retrieve the data.");
                    } else {
                        foreach ($holidays as $key) {
                            $holidayList[] = $key;
                        }
                        if (isset($params["limit"])) {
                            $entry = $params["limit"];
                        }
                        if (!empty($params["index"])) {
                            $currentPage = $params["index"];
                        }
                        if (!empty($params["month"])) {
                            $month = $params["month"];
                        }
                        if (!empty($params["year"])) {
                            $year = $params["year"];
                        }
                        if (!empty($params["day"])) {
                            $day = $params["day"];
                        }
                        $totalCount = count($holidays);
                        $beginIndex = ($currentPage - 1) * $entry;
                        $endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
                        $count = 0;
                        $data=array();
                        for ($i = $beginIndex; $i < $endIndex; $i++) {
                            $count++;
                            $key = $holidayList[$i];
                            $valueDateStart = (string) $key->dateStart;
                            $dateStart = new DateTime($valueDateStart);
                            if (!empty($month)) {
                                if ($dateStart->format('n') != $month) {
                                    continue;
                                }
                            }
                            if (!empty($year)) {
                                if ($dateStart->format('Y') != $year) {
                                    continue;
                                }
                            }
                            if (!empty($day)) {
                                if ($dateStart->format('j') != $day) {
                                    continue;
                                }
                            }
                            $data[] = array("ID" => (string) $key->id, "Name" => (string) $key->name, "Start Date" => (string) $key->dateStart, "End Date" => (string) $key->dateEnd);
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

}
