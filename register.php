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
    </head>
    <body>
        <div class="wrapper">
            <h2>Registration</h2><br>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="parentName" class="form-control <?php echo (!empty($parentName_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $parentName; ?>"> 
                </div>
                <div class="form-group">
                    <label>IC Number</label>
                    <input type="text" name="parentIcNo" class="form-control <?php echo (!empty($parentICNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $parentICNo; ?>"> 
                </div>
                <div class="form-group">
                    <label>Gender</label><br>
                    <input type="radio" id="male" name="parentGender" class="form-control" value="male">
                    <label>Male</label><br>
                    <input type="radio" id="female" name="parentGender" class="form-control" value="female">
                    <label>Female</label><br>
                </div>
                <div class="form-group">
                    <label>Parent Type</label><br>
                    <input type="radio" id="mother" name="parentType" class="form-control" value="mother">
                    <label>Mother</label><br>
                    <input type="radio" id="father" name="parentType" class="form-control" value="father">
                    <label>Father</label><br>
                    <input type="radio" id="guardian" name="parentType" class="form-control" value="guardian">
                    <label>Guardian</label><br>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" id="parentBirth" name="parentBirth">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="number" name="phone_number" class="form-control <?php echo (!empty($parentPhoneNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $parentPhoneNo; ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($parentEmail_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $parentEmail; ?>">
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo $password; ?>">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>    
    </body>
</html>