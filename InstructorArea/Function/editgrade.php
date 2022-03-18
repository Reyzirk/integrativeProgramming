<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of editgrade
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Grade.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Grades");
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: grades.php');
}else{
    $id = $_GET["id"];
    $oriGrade = "";
    $retrievedGrade = $parser->getGrade($id);
    if (!empty($retrievedGrade)){
        $oriGrade = $retrievedGrade->grade;
        $storedValue["grade"] = $retrievedGrade->grade;
        $storedValue["minMark"] = $retrievedGrade->minMark;
        $storedValue["maxMark"] = $retrievedGrade->maxMark;
    }else{
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: grades.php');
    }
}

if (isset($_POST["formDetect"])){
    if (empty($_POST["grade"])){
        $error["grade"] = "<b>Grade</b> cannot empty.";
    }else{
        $storedValue["grade"] = eliminateExploit($_POST["grade"]);
        if (strlen($storedValue["grade"])>3){
            $error["graade"] = "<b>Grade</b> cannot more than 3 characters.";
        }else if ($oriGrade != $storedValue["grade"]){
            $parser = $factory->getParser("Grades");
            if ($parser->checkExist($storedValue["grade"])){
                $error["grade"] = "<b>Grade</b> already exist.";
            }
        }
    }
    if ($_POST["minMark"]==NULL){
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
    if ($_POST["maxMark"]==NULL){
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
    if (empty($error)){
        $parser = $factory->getParser("Grades");
        $parser->removeGrade($id);
        //Check the least mark
        if (!($parser->checkMarkLeast($storedValue["minMark"])&&$parser->checkMarkLeast($storedValue["maxMark"]))){
            //Check the greatest mark
            if (!($parser->checkMarkGreatest($storedValue["minMark"])&&$parser->checkMarkGreatest($storedValue["maxMark"]))){
                //Check the mark between min mark with xml file
                if ($parser->checkMarkBetween($storedValue["minMark"])){
                    $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
                    $boolMin = true;
                }
                //Check the mark between max mark with xml file
                if ($parser->checkMarkBetween($storedValue["maxMark"])){
                    $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
                    $boolMax = true;
                }
                //Check whether min mark is the least and max mark is the greatest
                if (empty($error)){
                    if ($parser->checkMarkLeast($storedValue["minMark"])&&$parser->checkMarkGreatest($storedValue["maxMark"])){
                        $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
                    }
                }
            }else{
                //Check the mark between min mark with xml file
                if ($parser->checkMarkBetween($storedValue["minMark"])){
                    $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
                }
                //Check the mark between max mark with xml file
                if ($parser->checkMarkBetween($storedValue["maxMark"])){
                    $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
                }
                //Check the min mark with (xml min mark) < (min mark) < (xml max mark)
                if (empty($error)){
                    if ($parser->checkMarkGreaterMin($storedValue["minMark"])&&$parser->checkMarkLesserMax($storedValue["minMark"])){
                        $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
                    }
                }
            }
        }else{
            
            //Check the mark between min mark with xml file
            if ($parser->checkMarkBetween($storedValue["minMark"])){
                $error["minMark"] = "<b>Range of Min Mark</b> is exist.";
            }
            //Check the mark between max mark with xml file
            if ($parser->checkMarkBetween($storedValue["maxMark"])){
                $error["maxMark"] = "<b>Range of Max Mark</b> is exist.";
            }
        }
        $existGrade = new Grade($id,$storedValue["grade"],$storedValue["minMark"],$storedValue["maxMark"]);
        $parser->reputGrade($existGrade);
    }
    if (empty($error)){
        $newGrade = new Grade($id,$storedValue["grade"],$storedValue["minMark"],$storedValue["maxMark"]);
        require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
        $factory = new ParserFactory();
        $parser = $factory->getParser("Grades");
        $parser->updateGrade($newGrade);
        $factory->saveXML("Grades");
        $_SESSION["modifyLog"] = "editgrade";
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
