<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Grade.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
if (isset($_POST["formDetect"])){
    if (empty($_POST["grade"])){
        $error["grade"] = "<b>Grade</b> cannot empty.";
    }else{
        $storedValue["grade"] = eliminateExploit($_POST["grade"]);
        if (strlen($storedValue["grade"])>3){
            $error["graade"] = "<b>Grade</b> cannot more than 3 characters.";
        }else{
            $parser = $factory->getParser("Grades");
            if ($parser->checkExist($storedValue["grade"])){
                $error["grade"] = "<b>Grade</b> already exist.";
            }
        }
    }
    if ($_POST["minMark"]==null){
        $error["minMark"] = "<b>Min Mark</b> cannot empty.";
    }else{
        $storedValue["minMark"] = eliminateExploit($_POST["minMark"]);
        try{
            $minmark = intval($storedValue["minMark"]);
            if ($minmark < 0 || $minmark > 100){
                $error["minMark"] = "<b>Min Mark</b> must between 0 to 100.";
            }
        } catch (Exception $ex) {
            $error["minMark"] = "<b>Min Mark</b> must decimal.";
        }
    }
    if ($_POST["maxMark"]==null){
        $error["maxMark"] = "<b>Max Mark</b> cannot empty.";
    }else{
        $storedValue["maxMark"] = eliminateExploit($_POST["maxMark"]);
        try{
            $maxmark = intval($storedValue["maxMark"]);
            if ($maxmark < 0 || $maxmark > 100){
                $error["maxMark"] = "<b>Max Mark</b> must between 0 to 100.";
            }
        } catch (Exception $ex) {
            $error["maxMark"] = "<b>Max Mark</b> must decimal.";
        }
    }
    if (empty($error["minMark"])&&empty($error["maxMark"])){
        if (intval($storedValue["minMark"]) > intval($storedValue["maxMark"])){
            $error["minMark"] = "<b>Min Mark</b> cannot more than max mark.";
        }
        if (intval($storedValue["maxMark"]) < intval($storedValue["minMark"])){
            $error["maxMark"] = "<b>Max Mark</b> cannot less than min mark.";
        }
    }
    if (empty($error["minMark"])){
        $parser = $factory->getParser("Grades");
        if (!($parser->checkMarkLeast($storedValue["minMark"])&&$parser->checkMarkLeast($storedValue["maxMark"]))){
            if (!($parser->checkMarkGreatest($storedValue["minMark"])&&$parser->checkMarkGreatest($storedValue["maxMark"]))){
                if ($parser->checkMarkBetween($storedValue["minMark"])){
                    $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
                }
                if ($parser->checkMarkBetween($storedValue["maxMark"])){
                    $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
                }
            }else{
                if ($parser->checkMarkBetween($storedValue["minMark"])){
                    $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
                }
                if ($parser->checkMarkBetween($storedValue["maxMark"])){
                    $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
                }
            }
        }else{
            if ($parser->checkMarkBetween($storedValue["minMark"])){
                $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
            }
            if ($parser->checkMarkBetween($storedValue["maxMark"])){
                $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
            }
        }
        
    }
    if (empty($error)){
        $newGrade = new Grade("G",$storedValue["grade"],$storedValue["minMark"],$storedValue["maxMark"]);
        
        $parser = $factory->getParser("Grades");
        $parser->addGrade($newGrade);
        $factory->saveXML("Grades");
        $_SESSION["modifyLog"] = "creategrade";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: grades.php');
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}