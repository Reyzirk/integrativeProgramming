<?php
include 'Function/load.php';
include 'Function/profile.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<html>
    <head>
<?php include 'Components/headmeta.php'; ?>
    </head>
    <body>
<?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item active">My Account</li>
                </ol>

            </div>

            <section id="classes" class="classes">

                <div class="container">
                    <div id="formControl">
                        <div class="jumbotrun" id="container">
                            <form method="POST" id="form" name="form">
                                <h1 class="display-4">Edit Profile</h1>
                                <hr class="my-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="parentName" class="form-control <?php echo (!empty($parentName_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo!isset($parentName) ? "" : $parentName; ?>"> 
                                </div>
                                <div class="form-group">
                                    <br><label>IC Number</label>
                                    <input type="text" name="parentICNo" class="form-control <?php echo (!empty($parentICNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo!isset($parentICNo) ? "" : $parentICNo; ?>"> 
                                </div>
                                <div class="form-group">
                                    <br><label>Gender</label><br>
                                    <input type="radio" id="male" name="parentGender" value="male" <?php echo empty($parentGender) ? "" : ($parentGender == "M" ? "checked" : "") ?>>
                                    <label for="male" >Male</label><br>
                                    <input type="radio" id="female" name="parentGender" value="female" <?php echo empty($parentGender) ? "" : ($parentGender == "F" ? "checked" : "") ?>>
                                    <label for="female" >Female</label><br>

                                </div>

                                <div class="form-group">
                                    <br><label>Parent Type</label><br>   
                                    <input type="radio" id="mother" name="parentType" value="mother" <?php echo empty($parentType) ? "" : ($parentType == "mother" ? "checked" : "") ?>>
                                    <label for="mother" >Mother</label><br>
                                    <input type="radio" id="father" name="parentType" value="father" <?php echo empty($parentType) ? "" : ($parentType == "father" ? "checked" : "") ?>>
                                    <label for="father" >Father</label><br>
                                    <input type="radio" id="guardian" name="parentType" value="guardian" <?php echo empty($parentType) ? "" : ($parentType == "guardian" ? "checked" : "") ?>>
                                    <label for="guardian" >Guardian</label>       
                                </div>

                                <div class="form-group">
                                    <br><label>Date of Birth</label><br>
                                    <input type="date" id="parentBirth" name="parentBirth" value = "<?php echo !isset($parentBirth)?"":$parentBirth; ?>">
                                </div>
                                <div class="form-group">
                                    <br><label>Phone Number</label>
                                    <input type="text" name="parentPhoneNo" class="form-control <?php echo (!empty($parentPhoneNo_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo!isset($parentPhoneNo) ? "" : $parentPhoneNo; ?>">
                                </div>
                                <div class="form-group">
                                    <br><label>Address</label>
                                    <input type="text" name="Address" class="form-control <?php echo (!empty($Address_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo!isset($address) ? "" : $address; ?>"></input>

                                    <br><label>City</label>
                                    <select name="City" id="City" class="form-control <?php echo (!empty($City_err)) ? 'is-invalid' : ''; ?>">
                                        <option value="George Town" <?php echo empty($city) ? "" : ($city == "George Town" ? "selected" : "") ?>>George Town</option>
                                        <option value="Kuala Lumpur" <?php echo empty($city) ? "" : ($city == "Kuala Lumpur" ? "selected" : "") ?>>Kuala Lumpur</option>
                                        <option value="Ipoh" <?php echo empty($city) ? "" : ($city == "Ipoh" ? "selected" : "") ?>>Ipoh</option>
                                        <option value="Kuching" <?php echo empty($city) ? "" : ($city == "Kuching" ? "selected" : "") ?>>Kuching</option>
                                        <option value="Johor Bahru" <?php echo empty($city) ? "" : ($city == "Johor Bahru" ? "selected" : "") ?>>Johor Bahru</option>
                                        <option value="Kota Kinabalu" <?php echo empty($city) ? "" : ($city == "Kota Kinabalu" ? "selected" : "") ?>>Kota Kinabalu</option>
                                        <option value="Shah Alam" <?php echo empty($city) ? "" : ($city == "Shah Alam" ? "selected" : "") ?>>Shah Alam</option>
                                        <option value="Malacca City" <?php echo empty($city) ? "" : ($city == "Malacca City" ? "selected" : "") ?>>Malacca City</option>
                                        <option value="Alor Setar" <?php echo empty($city) ? "" : ($city == "Alor Setar" ? "selected" : "") ?>>Alor Setar</option>
                                        <option value="Miri" <?php echo empty($city) ? "" : ($city == "Miri" ? "selected" : "") ?>>Miri</option>
                                        <option value="Petaling Jaya" <?php echo empty($city) ? "" : ($city == "Petaling Jaya" ? "selected" : "") ?>>Petaling Jaya</option>
                                        <option value="Kuala Terengganu" <?php echo empty($city) ? "" : ($city == "Kuala Terengganu" ? "selected" : "") ?>>Kuala Terengganu</option>
                                        <option value="Iskandar Puteri" <?php echo empty($city) ? "" : ($city == "Iskandar Puteri" ? "selected" : "") ?>>Iskandar Puteri</option>
                                        <option value="Seberang Perai" <?php echo empty($city) ? "" : ($city == "Seberang Perai" ? "selected" : "") ?>>Seberang Perai</option>
                                        <option value="Seremban" <?php echo empty($city) ? "" : ($city == "Seremban" ? "selected" : "") ?>>Seremban</option>
                                        <option value="Subang Jaya" <?php echo empty($city) ? "" : ($city == "Subang Jaya" ? "selected" : "") ?>>Subang Jaya</option>
                                        <option value="Pasir Gudang" <?php echo empty($city) ? "" : ($city == "Pasir Gudang" ? "selected" : "") ?>>Pasir Gudang</option>
                                        <option value="Kuantan" <?php echo empty($city) ? "" : ($city == "Kuantan" ? "selected" : "") ?>>Kuantan</option>
                                        <option value="Bayan Lepas" <?php echo empty($city) ? "" : ($city == "Bayan Lepas" ? "selected" : "") ?>>Bayan Lepas</option>

                                    </select>

                                    <br><label>State</label>
                                    <select name="State" id="State" class="form-control <?php echo (!empty($State_err)) ? 'is-invalid' : ''; ?>">
                                        <option value="Johor" <?php echo empty($state) ? "" : ($state == "Johor" ? "selected" : "") ?>>Johor</option>
                                        <option value="Kedah" <?php echo empty($state) ? "" : ($state == "Kedah" ? "selected" : "") ?>>Kedah</option>
                                        <option value="Kelantan" <?php echo empty($state) ? "" : ($state == "Kelantan" ? "selected" : "") ?>>Kelantan</option>
                                        <option value="Melacca" <?php echo empty($state) ? "" : ($state == "Melacca" ? "selected" : "") ?>>Melacca</option>
                                        <option value="Negeri Sembilan" <?php echo empty($state) ? "" : ($state == "Negeri Sembilan" ? "selected" : "") ?>>Negeri Sembilan</option>
                                        <option value="Pahang" <?php echo empty($state) ? "" : ($state == "Pahang" ? "selected" : "") ?>>Pahang</option>
                                        <option value="Penang" <?php echo empty($state) ? "" : ($state == "Penang" ? "selected" : "") ?>>Penang</option>
                                        <option value="Perak" <?php echo empty($state) ? "" : ($state == "Perak" ? "selected" : "") ?>>Perak</option>
                                        <option value="Perlis" <?php echo empty($state) ? "" : ($state == "Perlis" ? "selected" : "") ?>>Perlis</option>
                                        <option value="Sabah" <?php echo empty($state) ? "" : ($state == "Sabah" ? "selected" : "") ?>>Sabah</option>
                                        <option value="Sarawak" <?php echo empty($state) ? "" : ($state == "Sarawak" ? "selected" : "") ?>>Sarawak</option>
                                        <option value="Selangor" <?php echo empty($state) ? "" : ($state == "Selangor" ? "selected" : "") ?>>Selangor</option>
                                        <option value="Terengganu" <?php echo empty($state) ? "" : ($state == "Terengganu" ? "selected" : "") ?>>Terengganu</option>
                                    </select>

                                    <br><label>Post Code</label>
                                    <input type="text" name="PostCode" class="form-control <?php echo (!empty($PostCode_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo!isset($postCode) ? "" : $postCode; ?>"></input>

                                </div>
                                <div class="form-group">
                                    <br><label>Email</label>
                                    <input type="text" name="parentEmail" readonly class="form-control <?php echo (!empty($parentEmail_err)) ? 'is-invalid' : ''; ?>" value = "<?php echo!isset($parentEmail) ? "" : $parentEmail; ?>">
                                </div>   
                                <br/>
                                <center>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <input class="btn btn-secondary ml-2" style="width: 6%" value="Reset" onclick="location.href = 'profile.php'">
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <br/>
<?php include 'Components/footer.php' ?>
    </body>
</html>
