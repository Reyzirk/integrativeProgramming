<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Announcement.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Attachment.php";
require_once dirname(__DIR__).'/Function/AnnounceWithDoc.php';
require_once dirname(__DIR__).'/Function/AnnounceWithImg.php';
require_once dirname(__DIR__).'/Function/AnnounceWithImgDoc.php';
require_once dirname(__DIR__).'/Function/AnnounceWithNoAttach.php';
require_once dirname(__DIR__).'/Function/AttachmentFactory.php';

class AttachmentFactory{

    
    public function __construct() {
        
    }
    
    public static function createAnnounceType($announce, $attach="empty"){
        
        $imgNum = 0;
        $docNum = 0;
        if($attach == "empty"){
            return new AnnounceWithNoAttach($announce);
        }else{
            foreach($attach as $row){
                $path = pathinfo($row->attachName,PATHINFO_EXTENSION);
                
                if($path != "png" && $path != "jpeg" && $path!="svg" && $path != "jpg"){
                    $docNum++;
                }else{
                    $imgNum++;
                }
            }
            
            if($docNum == 0){
                return new AnnounceWithImg($announce, $attach);
            }else if($imgNum == 0){
                return new AnnounceWithDoc($announce, $attach);
            }else{
                return new AnnounceWithImgDoc($announce, $attach);
            }
            
        }
        
        
    }
    
    
    
}

