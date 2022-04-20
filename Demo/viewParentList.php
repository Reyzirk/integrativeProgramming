<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Tang Khai Li
-->
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
        <title>Parent List | Demo</title>
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
        <script src='JavaScript/grades.js' type='text/javascript'></script>
    </head>
    <body>
        <table class="table table-hover">
            <thead>
            <th class="text-center">Parent Name</th>
            <th class="text-center">Parent Gender</th>
            <th class="text-center">Birth Date</th>
            <th class="text-center">Parent Email</th>
            <th class="text-center">Parent Phone No</th>
            <th class="text-center">Parent IC No</th>
            <th class="text-center">Parent Type</th>
        </thead>

        <tbody>
            <?php
            include "Functions/viewParent.php";
            ?>
        </tbody>
    </table>
</body>
</html>
