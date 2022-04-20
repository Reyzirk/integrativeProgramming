<?php
//Author: Fong Shu Ling
    require_once dirname(__DIR__)."/Database/ParentDB.php";
    require_once dirname(__DIR__)."/Database/resetPasswordDB.php";
    require 'mail/mail_load.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['forgotPassword']))
            {
                if(empty($_POST['parentEmail']))
                {
                    $parentEmail_err = "Please enter your email address";
            
                }else if(!filter_var($_POST["parentEmail"], FILTER_VALIDATE_EMAIL)){
                    $parentEmail_err = "User email doesn't have the correct format. Please re-enter!";
                }else{
                    $parentEmail = trim($_POST["parentEmail"]);
                }
            }
        
        if(empty($parentEmail_err))
        {
            $db = new ParentDB();
            $parent = $db->detailsWithEmail($parentEmail);
            
            if ($parent == null)
            {
                $parentEmail_err = "If the email had registered, the mail will be sent to the email box";
            }else{
                $forgotDB = new resetPasswordDB();
                $code = uniqid("P",true);
                $forgotDB->delete($parentEmail);
                $forgotDB->insert($parentEmail, $code, "Parent");
                
                $message = str_replace("%link%","http://" . $_SERVER['SERVER_NAME'] . str_replace("forgotPassword.php","forgotpasswordchange.php",$_SERVER['REQUEST_URI']),str_replace("%code%",$code,str_replace("%email%",$parentEmail,str_replace("%name%",$parent->name,file_get_contents(dirname(__DIR__)."/mail/resetpasswordtemplate.php")))));
                sendMail("Omega International Junior School", $parentEmail, $parent->name, "Reset Password", $message);
                $parentEmail_err = "If the email had registered, the mail will be sent to the email box";
            }
        }
    }

    
    
    
      ?>      

