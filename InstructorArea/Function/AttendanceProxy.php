<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of AttendanceProxy
 *
 * @author Ng Kar Kai
 */
require_once ( str_replace("AJAX", "", dirname(__DIR__))) . '/AttendanceFacade.php';
interface Attendance {
    public function registerAttendance():void;
}

class AttendanceLogger implements Attendance{
    public function registerAttendance(): void {
        
    }
}

class AttendanceProxy implements Attendance{
    private $attendanceLogger;
    
    public function __construct(AttendanceLogger $attendanceLogger) {
        $this->attendanceLogger = $attendanceLogger;
    }
    public function registerAttendance():void{
        
    }
    
    public function checkExistingAttendance(){
        
    }
}
