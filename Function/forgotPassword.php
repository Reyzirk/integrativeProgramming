<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require 'mail/Exception.php';
    require 'mail/PHPMailer.php';
    require 'mail/SMTP.php';
    
    date_default_timezone_set(TIMEZONE);
    $error=array();
    if(isset($_POST['forgotPassword']))
    {
        if(empty($_POST['emailAddress'])){
            array_push($error,"<b>Email Address</b> cannot empty.");
            $errorEmail = true;
        }else{
            if(strlen($_POST['emailAddress'])>50){
                array_push($error,"<b>Email</b> cannot more than 50 characters.");
                $errorEmail = true;
            }else{
                $pattern = "/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/";
                if(!preg_match($pattern, $_POST['emailAddress'])){
                    array_push($error,"<b>Email Address</b> is of invalid format.");
                    $errorEmail = true;
                }else{
                    $emailAddress = antiExploit($_POST['emailAddress']);
                }
            }
        }    
    }
    //Prevent hacker to exploit the system
    function antiExploit($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function displayMessage(){
        global $error, $emailAddress;
        if(isset($_POST['forgotPassword'])){
            if(empty($error)){
                printf('
                    <p class="info">
                        %s
                        <br/>
                        %s
                    </p>
                        ',"Recovery mail has been sent to your email.","If the email is exist, you will receive a recovery mail.");
                @$con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); //Connect to database
                if ($con -> connect_errno) { //Check it is the connection succesful
                    echo "<div class='error'><b>DATABASE ERROR</b>. Please contact Administrator<br/>Error Message: ".$con->connect_error."</div>";
                }else{
                    $sql = "SELECT * from client WHERE email='".$emailAddress."'";
                    if($result = $con->query($sql)){
                        if (($result->num_rows)>0){
                            while($row = $result->fetch_object()){
                                $email = $_POST['emailAddress'];
                                $name = $row->name;
                            }
                            
                        }

                    }else{
                        echo "<div class='error'><b>DATABASE ERROR</b>. Please contact Administrator<br/>Error Message: ".$con->error."</div>";
                    }
                    $result->free();
                    $con->close();
                }
                if (isset($email)){
                    $mail = new PHPMailer(true);
                    if (in_array($email, EMAIL_ALLOWED)){
                        @$con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME); //Connect to database
                        if ($con -> connect_errno) { //Check it is the connection succesful
                            echo "<div class='error'><b>DATABASE ERROR</b>. Please contact Administrator<br/>Error Message: ".$con->connect_error."</div>";
                        }else{
                            $sql = "SELECT * from resetpassword WHERE email='".$email."'";
                            if($result = $con->query($sql)){
                                if (($result->num_rows)>0){
                                    $result->free();
                                    $date = date('Y-m-d H:i:s');
                                    $sql = "UPDATE resetpassword SET resetCode = ?, request_time = ? WHERE email=?";
                                    $code = uniqid("",true).uniqid("",true);
                                    $stmt = $con ->prepare($sql);
                                    $stmt->bind_param('sss', $code,$date,$email);
                                    if ($stmt->execute()){
                                        $stmt->free_result();
                                    }
                                }else{
                                    $result->free();
                                    $date = date('Y-m-d H:i:s');
                                    $sql = "INSERT INTO resetpassword VALUES (?,?,?)";
                                    $code = uniqid("",true).uniqid("",true);
                                    $stmt = $con ->prepare($sql);
                                    $stmt->bind_param('sss', $code,$email,$date);
                                    if ($stmt->execute()){
                                        $stmt->free_result();
                                    }
                                }

                            }else{
                                echo "<div class='error'><b>DATABASE ERROR</b>. Please contact Administrator<br/>Error Message: ".$con->error."</div>";
                            }
                            $con->close();
                        }
                        try{
                            //Email Settings
                            if (EMAIL_DEBUG){
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output Only open for debug purpose
                            }

                            $mail->isSMTP(); //Send using SMTP
                            $mail->Host = EMAIL_HOST; //Set the smtp server to send through
                            $mail->SMTPAuth = true; //Enable SMTP authentication
                            $mail->Username= EMAIL_USERNAME; //SMTP Username
                            $mail->Password = EMAIL_PASSWORD; //SMTP Password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption
                            $mail->Port = EMAIL_PORT;

                            //Recipients
                            $mail->setFrom(EMAIL_USERNAME,'Daily Market');
                            $mail->addAddress($email,$name);
                            // Content
                            $mail ->isHTML(true); //Make the mail into HTML
                            $mail->Subject = 'Reset password for DailyMarket website account.';
                            $link = "resetpassword.php";
                            $mail->msgHTML(str_replace("%link%",$link, str_replace("%code%", $code, str_replace("%email%", $email, str_replace("%name%",$name,file_get_contents('mail/resetPasswordTemplate.php'))))), __DIR__);
                            if (!$mail->send()){
                                printf('<div class="email">Error while sending the email. Error: {'.$mail->ErrorInfo.'}</div>');
                            }
                        } catch (Exception $ex) {
                            printf('<div class="email">Error while sending the email. Error: {'.$mail->ErrorInfo.'}</div>');
                        }
                    }else{
                        echo "<div class='error'>To Ms Cho, enter the email at the settings.php to allow send mail to that email. It is to prevent accident spam random person gmail account</div>";
                    }
                }
            }else{
                printf('<ul class="error"><li>%s</li></ul>
                             ', implode('</li><li>', $error));
            }
        }
    }
?>