<?php include 'Function/load.php' ?>
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
        <link rel="stylesheet" href="css/login.css" />
        <?php
            include 'Components/headmeta.php';
            
            if (isset($_SESSION["clientId"])){
                header('location: index.php');
            }
        ?>
    </head>
    <body>
        <div class="wrapper">
            <h2>Registration</h2><br>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="parentName" class="form-control <?php echo (!empty($parentName_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentName)?"":$parentName; ?>"> 
                </div>
                <div class="form-group">
                    <br><label>IC Number</label>
                    <input type="text" name="parentICNo" class="form-control <?php echo (!empty($parentICNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentICNo)?"":$parentICNo; ?>"> 
                </div>
                <div class="form-group">
                    <br><label>Gender</label><br>
                    <input type="radio" id="male" name="parentGender" value="male">
                    <label>Male</label><br>
                    <input type="radio" id="female" name="parentGender" value="female">
                    <label>Female</label><br>
                    
                </div>
                
                <div class="form-group">
                    <br><label>Parent Type</label><br>   
                    <input type="radio" id="mother" name="parentType" value="mother">
                    <label>Mother</label><br>
                    <input type="radio" id="father" name="parentType" value="father">
                    <label>Father</label><br>
                    <input type="radio" id="guardian" name="parentType" value="guardian">
                    <label>Guardian</label>       
                </div>
                
                <div class="form-group">
                    <br><label>Date of Birth</label><br>
                    <input type="date" id="parentBirth" name="parentBirth">
                </div>
                <div class="form-group">
                    <br><label>Phone Number</label>
                    <input type="text" name="parentPhoneNo" class="form-control <?php echo (!empty($parentPhoneNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentPhoneNo)?"":$parentPhoneNo; ?>">
                </div>
                <div class="form-group">
                    <br><label>Address</label>
                    <input type="text" name="Address" class="form-control <?php echo (!empty($Address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($Address)?"":$Address; ?>"></input>
                    
                    <br><label>City</label>
                    <select name="City" id="City" class="form-control <?php echo (!empty($City_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($City)?"":$City; ?>">
                        <option value="George Town">George Town</option>
                        <option value="Kuala Lumpur">Kuala Lumpur</option>
                        <option value="Ipoh">Ipoh</option>
                        <option value="Kuching">Kuching</option>
                        <option value="Johor Bahru">Johor Bahru</option>
                        <option value="Kota Kinabalu">Kota Kinabalu</option>
                        <option value="Shah Alam">Shah Alam</option>
                        <option value="Malacca City">Malacca City</option>
                        <option value="Alor Setar">Alor Setar</option>
                        <option value="Miri">Miri</option>
                        <option value="Petaling Jaya">Petaling Jaya</option>
                        <option value="Kualan Terengganu">Kuala Terengganu</option>
                        <option value="Iskandar Puteri">Iskandar Puteri</option>
                        <option value="Seberang Perai">Seberang Perai</option>
                        <option value="Seremban">Seremban</option>
                        <option value="Subang Jaya">Subang Jaya</option>
                        <option value="Pasir Gudang">Pasir Gudang</option>
                        <option value="Kuantan">Kuantan</option>
                        
                    </select>
                    
                    <br><label>State</label>
                    <select name="State" id="State" class="form-control <?php echo (!empty($State_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($State)?"":$State; ?>">
                        <option value="Johor">Johor</option>
                        <option value="Kedah">Kedah</option>
                        <option value="Kelantan">Kelantan</option>
                        <option value="Melacca">Melacca</option>
                        <option value="Negeri Sembilan">Negeri Sembilan</option>
                        <option value="Pahang">Pahang</option>
                        <option value="Penang">Penang</option>
                        <option value="Perak">Perak</option>
                        <option value="Perlis">Perlis</option>
                        <option value="Sabah">Sabah</option>
                        <option value="Sarawak">Sarawak</option>
                        <option value="Selangor">Selangor</option>
                        <option value="Terengganu">Terengganu</option>
                    </select>
                    
                    <br><label>Post Code</label>
                    <input type="text" name="PostCode" class="form-control <?php echo (!empty($PostCode_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($PostCode)?"":$PostCode; ?>"></input>
                    
                </div>
                <div class="form-group">
                    <br><label>Email</label>
                    <input type="text" name="parentEmail" class="form-control <?php echo (!empty($parentEmail_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($parentEmail)?"":$parentEmail; ?>">
                </div>    
                <div class="form-group">
                    <br><label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo !isset($password)?"":$password; ?>">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo !isset($confirm_password)?"":$confirm_password; ?>">
                </div>
                <div class="form-group">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>    
    </body>
</html>