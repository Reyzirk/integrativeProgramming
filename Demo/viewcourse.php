
<?php 
if (empty($_GET["id"])){
    
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: courselist.php');
}
$id = $_GET["id"];
$apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
$page = file_get_contents("http://localhost/IPAssignment/cmapi.php/course/details?api-key=$apiKey&id=$id");
$jsonStr = json_decode($page)[0];
if ($jsonStr->Status=="Success"){
    $dataStr = $jsonStr->Data;
}else{
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: courselist.php');
}
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<?php

#Page Languages
$lang_legendTitle = "Course Details";
$lang_legendTitle2 = "Course Materials";
$variable1 = "Course Code";
$variable2 = "Course Name";
$variable3 = "Course Description";
?>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
        <title>View Course | Demo Section</title>
        <link href='../InstructorArea/css/main.css' rel='stylesheet' type='text/css'/>
        <link href='../InstructorArea/css/sb-admin-2.css' rel='stylesheet' type='text/css'/>
        <link href='../css/sweetalert2.min.css' rel='stylesheet' type='text/css'/>
        <script src='https://kit.fontawesome.com/3f628a0091.js' crossorigin='anonymous'></script>
        <script src='../js/jquery-3.6.0.js' type='text/javascript'></script>
        <script src='../js/sweetalert2.all.min.js' type='text/javascript'></script>
        <script src='../js/ckeditor.js' type='text/javascript'></script>
        <script src='../js/html2pdf.bundle.min.js' type='text/javascript'></script>
        <script src='../js/jquery.table2excel.js' type='text/javascript'></script>
        <script src='../InstructorArea/js/sb-admin-2.min.js' type='text/javascript'></script>
        <script src='../InstructorArea/js/main.js' type='text/javascript'></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <h1 class="display-4">View <?php echo $dataStr->$variable1; ?> Details</h1>
                                <hr class="my-3">
                                <fieldset>
                                    <legend><?php echo $lang_legendTitle; ?></legend>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="courseCode" class="col-form-label">Course Code </label>
                                            <p class="p-12 font-weight-bold"><?php echo $dataStr->$variable1; ?></p>

                                        </div>
                                        <div class="col-md">
                                            <label for="courseName" class="col-form-label">Course Name </label>
                                            <p class="p-12 font-weight-bold"><?php echo $dataStr->$variable2; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md">
                                            <label for="courseDescription" class="col-form-label">Course Description </label>
                                            <div><?php echo htmlspecialchars_decode($dataStr->$variable3); ?></div>
                                        </div>
                                    </div>
                                </fieldset>
                                <br/>
                                <center>
                                    <button type="button" class="btn btn-danger" onclick="location.href = 'courselist.php'">Back</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
