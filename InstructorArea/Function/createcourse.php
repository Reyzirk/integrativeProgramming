<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/CourseMaterial.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Course.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/ParserFactory.php';
$factory = new ParserFactory();
$parser = $factory->getParser("Courses");
if (isset($_POST["formDetect"])){
    $inputName = "courseCode";
    $inputTitle = "Course Code";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName])>10){
            $error[$inputName] = "<b>$inputTitle</b> cannot more than 10 characters.";
        }else if($parser->checkExist($storedValue[$inputName])){
            $error[$inputName] = "<b>$inputTitle</b> already exist.";
        }
    }
    $inputName = "courseName";
    $inputTitle = "Course Name";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName])>300){
            $error[$inputName] = "<b>$inputTitle</b> cannot more than 300 characters.";
        }
    }
    $inputName = "courseDescription";
    $inputTitle = "Course Description";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }
    $inputName = "materialFile";
    $inputTitle = "Material File";
    if (isset($_FILES[$inputName])){
        $files = $_FILES[$inputName];
        for($i = 0; $i < count($files["name"]);$i++){
            $tempFile = $files["tmp_name"][$i];
            $errorCode = $files["error"][$i];
            if ($errorCode>0){
                switch($errorCode){
                    case UPLOAD_ERR_NO_FILE:
                        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $error[$inputName] = "<b>$inputTitle</b> uploaded is too large!";
                        break;
                    default:
                        $error[$inputName] = "<b>$inputTitle</b>There was an error while uploading the file.";
                        break;
                }
            }else if($files["size"][$i]>$generalSection["file_max_size"]){
                $error[$inputName] = "<b>$inputTitle</b> File uploaded is too large. Maximum ".convertByteToOther($generalSection["file_max_size"]).".";
            }else{
                $ext = strtolower(pathinfo($files["name"][$i],PATHINFO_EXTENSION));
                if ($ext=="php"||$ext=="java"||$ext=="jsp"||$ext=="html"||$ext=="xhtml"||$ext=="js"||$ext=="css"||
                        $ext=="aspx"||$ext=="cs"||$ext=="py"||$ext=="htaccess"||$ext=="sql"||$ext=="db"){
                    $error[$inputName] = "File type of <b>Material File</b> not supported.";
                }
            }
            if (isset($error[$inputName])){
                break;
            }
        }
    }
    $inputName = "materialName";
    $inputTitle = "Material Name";
    if (isset($_POST[$inputName])){
        for($i = 0;$i < count($_POST[$inputName]);$i++){
            if (empty($_POST[$inputName][$i])){
                $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
                break;
            }else{
                $storedValue[$inputName] = eliminateExploit($_POST[$inputName][$i]);
                if (strlen($storedValue[$inputName])>300){
                    $error[$inputName] = "<b>$inputTitle</b> cannot more than 300 characters.";
                }
            }
        }
    }
    if (empty($error)){
        $courseMaterials = array();
        if (isset($_POST[$inputName])){
            for($i = 0;$i < count($_POST[$inputName]);$i++){
                $files = $_FILES["materialFile"];
                $save_as = uniqid("",true).'.'.$ext;
                move_uploaded_file($files['tmp_name'][$i],str_replace("InstructorArea", "", dirname(__DIR__)).'/uploads/CourseMaterial/'.$save_as);
                $courseMaterials[] = new CourseMaterial(uniqid("CM", true), $_POST[$inputName][$i], $save_as);
            }
        }
        $newCourse = new Course($storedValue["courseCode"],$storedValue["courseName"],$storedValue["courseDescription"],$courseMaterials);
        
        $parser->addCourse($newCourse);
        $factory->saveXML("Courses");
        $_SESSION["modifyLog"] = "createcourse";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: courses.php');

    }
    
}
function convertByteToOther($size){
    if ($size >= 1048576){
        return $size/1048576.0+" MB";
    }else if ($size>=1024){
        return $size/1024.0+" KB";
    }else{
        return $size+" bytes";
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}