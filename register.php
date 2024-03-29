<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include_once 'Function/ini_load.php'; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<!--
Registration page
@author Shu Ling
 -->
 
 <?php
    include 'Function/register.php' 
 ?>
 
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css" />
        <?php
        require_once 'XML/WebPageParser.php';
        $author = "Ng Kar Kai, Oon Kheng Huang, Tang Khai Li, Fong Shu Ling, Poh Choo Meng";
        $keywords = "Kindergarden, Education, Learning";
        $fileName = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);
        $companyName = $generalSection["companyName"];
        $parser = new WebPageParser("XML/ParentSideWebPage.xml");
        $webpage = empty($parser->getWebpage()[str_replace(".php", "", strtolower($fileName))]) ? "" :
                $parser->getWebpage()[str_replace(".php", "", strtolower($fileName))];
        $pageTitle = empty($webpage) ? "" : $webpage->pageTitle;
        $description = empty($webpage) ? "" : $webpage->pageDescription;

        echo("
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='author' content='$author'>
    <meta name='keywords' content='$keywords'>
    <meta name='description' content='$description'>
    <title>$pageTitle | $companyName</title>
    <link href='css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
    <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
    <script src='js/jquery-3.6.0.js' type='text/javascript'></script>
    <script src='js/sweetalert2.all.min.js' type='text/javascript'></script>
    <script src='js/ckeditor.js' type='text/javascript'></script>
    <script src='js/bootstrap.bundle.min.js' type='text/javascript'></script>
        ");
        ?>
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

        <link href="css/main.css" rel="stylesheet">

        <link href="vendor/aos/aos.css" rel="stylesheet">
        <script src="vendor/aos/aos.js" type='text/javascript'></script>

        <script src="js/html2pdf.bundle.min.js" type='text/javascript'></script>
        <script src="js/jquery.table2excel.js" type='text/javascript'></script>
    </head>
    <body>
        <div class="wrapper">
            <h2>Registration</h2><br>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="parentName" style="width: 50%" class="form-control <?php echo (!empty($parentName_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentName)?"":$parentName; ?>"> 
                </div>
                <div class="form-group">
                    <br><label>IC Number</label>
                    <input type="text" name="parentICNo" placeholder="010457-07-0987" 
                           style="width: 50%" class="form-control <?php echo (!empty($parentICNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentICNo)?"":$parentICNo; ?>"> 
                </div>
                <div class="form-group">
                    <br><label>Gender</label><br>
                    <input type="radio" id="male" name="parentGender" value="male" <?php echo empty($parentGender)?"":($parentGender=="Male"?"checked":"") ?>>
                    <label for="male">Male</label><br>
                    <input type="radio" id="female" name="parentGender" value="female" <?php echo empty($parentGender)?"":($parentGender=="Female"?"checked":"") ?>>
                    <label for="female">Female</label><br>
                    
                </div>
                
                <div class="form-group">
                    <br><label>Parent Type</label><br>   
                    <input type="radio" id="mother" name="parentType" value="mother" <?php echo empty($parentType)?"":($parentType=="mother"?"checked":"") ?>>
                    <label for="mother">Mother</label><br>
                    <input type="radio" id="father" name="parentType" value="father" <?php echo empty($parentType)?"":($parentType=="father"?"checked":"") ?>>
                    <label for="father">Father</label><br>
                    <input type="radio" id="guardian" name="parentType" value="guardian" <?php echo empty($parentType)?"":($parentType=="guardian"?"checked":"") ?>>
                    <label for="guardian">Guardian</label>       
                </div>
                
                <div class="form-group">
                    <br><label>Date of Birth</label><br>
                    <input type="date" id="parentBirth" name="parentBirth" value = "<?php echo !isset($parentBirth)?"":$parentBirth; ?>">
                </div>
                <div class="form-group">
                    <br><label>Phone Number</label>
                    <input type="text" name="parentPhoneNo" placeholder="016-1234567"
                           style="width: 50%" class="form-control <?php echo (!empty($parentPhoneNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentPhoneNo)?"":$parentPhoneNo; ?>">
                </div>
                <div class="form-group">
                    <br><label>Address</label>
                    <input type="text" name="Address" style="width: 50%" class="form-control <?php echo (!empty($Address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($address)?"":$address; ?>"></input>
                    
                    <br><label>City</label>
                    <select name="City" id="City" style="width: 50%" class="form-control <?php echo (!empty($City_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($city)?"":$city; ?>">
                        <option value="George Town" <?php echo empty($city)?"":($city=="George Town"?"selected":"") ?>>George Town</option>
                        <option value="Kuala Lumpur" <?php echo empty($city)?"":($city=="Kuala Lumpur"?"selected":"") ?>>Kuala Lumpur</option>
                        <option value="Ipoh" <?php echo empty($city)?"":($city=="Ipoh"?"selected":"") ?>>Ipoh</option>
                        <option value="Kuching" <?php echo empty($city)?"":($city=="Kuching"?"selected":"") ?>>Kuching</option>
                        <option value="Johor Bahru" <?php echo empty($city)?"":($city=="Johor Bahru"?"selected":"") ?>>Johor Bahru</option>
                        <option value="Kota Kinabalu" <?php echo empty($city)?"":($city=="Kota Kinabalu"?"selected":"") ?>>Kota Kinabalu</option>
                        <option value="Shah Alam" <?php echo empty($city)?"":($city=="Shah Alam"?"selected":"") ?>>Shah Alam</option>
                        <option value="Malacca City" <?php echo empty($city)?"":($city=="Malacca City"?"selected":"") ?>>Malacca City</option>
                        <option value="Alor Setar" <?php echo empty($city)?"":($city=="Alor Setar"?"selected":"") ?>>Alor Setar</option>
                        <option value="Miri" <?php echo empty($city)?"":($city=="Miri"?"selected":"") ?>>Miri</option>
                        <option value="Petaling Jaya" <?php echo empty($city)?"":($city=="Petaling Jaya"?"selected":"") ?>>Petaling Jaya</option>
                        <option value="Kuala Terengganu" <?php echo empty($city)?"":($city=="Kuala Terengganu"?"selected":"") ?>>Kuala Terengganu</option>
                        <option value="Iskandar Puteri" <?php echo empty($city)?"":($city=="Iskandar Puteri"?"selected":"") ?>>Iskandar Puteri</option>
                        <option value="Seberang Perai" <?php echo empty($city)?"":($city=="Seberang Perai"?"selected":"") ?>>Seberang Perai</option>
                        <option value="Seremban" <?php echo empty($city)?"":($city=="Seremban"?"selected":"") ?>>Seremban</option>
                        <option value="Subang Jaya" <?php echo empty($city)?"":($city=="Subang Jaya"?"selected":"") ?>>Subang Jaya</option>
                        <option value="Pasir Gudang" <?php echo empty($city)?"":($city=="Pasir Gudang"?"selected":"") ?>>Pasir Gudang</option>
                        <option value="Kuantan" <?php echo empty($city)?"":($city=="Kuantan"?"selected":"") ?>>Kuantan</option>
                        <option value="Bayan Lepas" <?php echo empty($city)?"":($city=="Bayan Lepas"?"selected":"") ?>>Bayan Lepas</option>
                        
                    </select>
                    
                    <br><label>State</label>
                    <select name="State" id="State" style="width: 50%" class="form-control <?php echo (!empty($State_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($State)?"":$State; ?>">
                        <option value="Johor" <?php echo empty($state)?"":($state=="Johor"?"selected":"") ?>>Johor</option>
                        <option value="Kedah" <?php echo empty($state)?"":($state=="Kedah"?"selected":"") ?>>Kedah</option>
                        <option value="Kelantan" <?php echo empty($state)?"":($state=="Kelantan"?"selected":"") ?>>Kelantan</option>
                        <option value="Melacca" <?php echo empty($state)?"":($state=="Melacca"?"selected":"") ?>>Melacca</option>
                        <option value="Negeri Sembilan" <?php echo empty($state)?"":($state=="Negeri Sembilan"?"selected":"") ?>>Negeri Sembilan</option>
                        <option value="Pahang" <?php echo empty($state)?"":($state=="Pahang"?"selected":"") ?>>Pahang</option>
                        <option value="Penang" <?php echo empty($state)?"":($state=="Penang"?"selected":"") ?>>Penang</option>
                        <option value="Perak" <?php echo empty($state)?"":($state=="Perak"?"selected":"") ?>>Perak</option>
                        <option value="Perlis" <?php echo empty($state)?"":($state=="Perlis"?"selected":"") ?>>Perlis</option>
                        <option value="Sabah" <?php echo empty($state)?"":($state=="Sabah"?"selected":"") ?>>Sabah</option>
                        <option value="Sarawak" <?php echo empty($state)?"":($state=="Sarawak"?"selected":"") ?>>Sarawak</option>
                        <option value="Selangor" <?php echo empty($state)?"":($state=="Selangor"?"selected":"") ?>>Selangor</option>
                        <option value="Terengganu" <?php echo empty($state)?"":($state=="Terengganu"?"selected":"") ?>>Terengganu</option>
                    </select>
                    
                    <br><label>Post Code</label>
                    <input type="text" name="PostCode" style="width: 50%" class="form-control <?php echo (!empty($PostCode_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($postCode)?"":$postCode; ?>"></input>
                    
                </div>
                <div class="form-group">
                    <br><label>Email</label>
                    <input type="text" name="parentEmail" style="width: 50%" class="form-control <?php echo (!empty($parentEmail_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentEmail)?"":$parentEmail; ?>">
                </div>    
                <div class="form-group">
                    <br><label>Password</label>
                    <input type="password" name="password" style="width: 50%" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($password)?"":$password; ?>">
                </div>
                <div class="form-group">
                    <br/>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" style="width: 50%" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo !isset($confirm_password)?"":$confirm_password; ?>">
                </div>
                <div class="form-group">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <br><p class="login">Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>    
    </body>
</html>