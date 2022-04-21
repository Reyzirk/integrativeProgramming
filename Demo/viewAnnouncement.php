<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<?php
require_once "Functions/viewAnnouncement.php";
?>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
        <title>Announcement | API Demo Section</title>
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
        <script src='JavaScript/courses.js' type='text/javascript'></script>
    </head>
    <body>
        <div class="container">
            <br/><br/>
            <div class="row">
                <div class="col-md">
                    <h2>Search Announcement API Demo</h2><br/>
                    <form name="searchBox" method="POST">
                        <center>
                            <div class="col-md-5">   
                                <div class="input-group">

                                    <input type="text" name="inputSearch" id="inputSearch" placeholder="Search by (Title/ID/Date/Description)" value="<?php echo empty($storedValue["search"]) ? "" : $storedValue["search"] ?>" title="search" class="form-control bg-white small"/>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" runat="server" id="searchButton" onclick="form.submit()">
                                            <i class="fas fa-search fa-sm"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </div>  
                        </center>
                    </form>
                </div>  
            </div>
            <br/>
            <div class="row">
                <div class="col-md">
                    <table align="center" class="table table-hover table-striped">
                        <tr>
                            <th>Announcement ID</th>
                            <th>Instructor ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                        <?php
                        if (!empty($results)) {
                            foreach ($results as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $row->announceID ?></td>
                                    <td><?php echo $row->instructorID ?></td>
                                    <td><?php echo $row->title ?></td>
                                    <td><?php echo $row->cat ?></td>
                                    <td><?php echo $row->date ?></td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                                <tr style="text-align: center">
                                    <td colspan="5"><h2>No Result Found</h2></td> 
                                </tr>
                                <?php
                        }
                            ?>
                    </table>
                </div>
            </div><br/><br/>
    </body>
</html>
