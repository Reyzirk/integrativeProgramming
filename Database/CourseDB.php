<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

namespace Database;

use PDO;
use Course;
/**
 * Description of CourseDB
 *
 * @author Choo Meng
 */
class CourseDB extends DBController{
    public function __construct(){
        $this->connectDB();
    }
    public function getCourseDetails($courseCode):Course{
        $statement="SELECT * FROM Course WHERE CourseCode = ?";
        $stmt = $this->con->prepare($statement);
        $stmt->bind_param("s",$courseCode);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()){
            $course = new Course($row["CourseCode"],$row["CourseName"],$row["CourseDesc"]);
            $courses[] = $course;
        }
        $this->closeDB();
        return $courses;
    }
}
