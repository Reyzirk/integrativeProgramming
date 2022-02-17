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
require_once str_replace("Function","",str_replace("InstructorArea", "", dirname(__DIR__))) . '/XML/HolidaysParser.php';
require_once "BaseController.php";
class HolidayController extends BaseController{
    //Get the list of the holiday
    
    public function list(){
        $entry = 20;
        $currentPage = 1;
        $method = $_SERVER["REQUEST_METHOD"];
        $params = $this->getParams();
        if (strtoupper($method)=="GET"){
            try{
                $parser = new HolidaysParser(str_replace("Function","",str_replace("InstructorArea", "", dirname(__DIR__))) . "/XML/holidays.xml");
                $holidays = $parser->getHolidays();
                foreach ($holidays as $key) {
                    $holidayList[] = $key;
                }
                if (isset($params["limit"])){
                    $entry = $params["limit"];
                }
                if (!empty($params["index"])){
                    $currentPage = $params["index"];
                }
                if (!empty($params["month"])){
                    $month = $params["month"];
                }
                if (!empty($params["year"])){
                    $year = $params["year"];
                }
                if (!empty($params["day"])){
                    $day = $params["day"];
                }
                $totalCount = count($holidays);
                $beginIndex = ($currentPage - 1) * $entry;
                $endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
                $output = array();
                for ($i = $beginIndex; $i < $endIndex; $i++) {
                    $key = $holidayList[$i];
                    $valueDateStart = (string) $key->getdateStart();
                    $dateStart = new DateTime($valueDateStart);
                    if (!empty($month)){
                        if ($dateStart->format('n')!=$month){
                            continue;
                        }
                    }
                    if (!empty($year)){
                        if ($dateStart->format('Y')!=$year){
                            continue;
                        }
                    }
                    if (!empty($day)){
                        if ($dateStart->format('j')!=$day){
                            continue;
                        }
                    }
                    $output[] = array("ID"=>(string)$key->getId(),"Name"=>(string)$key->getName(),"Start Date"=>(string)$key->getDateStart(),"End Date"=>(string)$key->getDateEnd());
                }
                $response = json_encode($output,JSON_PRETTY_PRINT);
            } catch (Exception $ex) {
                $errorDesc = "Something error! Please contact administrator.";
                $errorHeader = "HTTP/1.1 500 Internal Server Error";
            }
            
        }else{
            $errorDesc="Method not found";
            $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        if (empty($errorDesc)){
            $this->sendOutput(
                $response,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        }else{
            $this->sendOutput(json_encode(array('error' => $errorDesc)), 
                array('Content-Type: application/json', $errorHeader)
            );
        }
    }
}
