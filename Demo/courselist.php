<!doctype html>
<?php
$lang_search = "Filter the course list";
$lang_search_btn = "Search";
$lang_search_tooltip = "Type in any word that you want to search";
$lang_refresh_btn = "Refresh";
$lang_action_btn = "Action";
?>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta name='author' content='$author'>
        <meta name='keywords' content='$keywords'>
        <meta name='description' content='$description'>
        <link rel='icon' type='image/x-icon' href='../images/favicon.png'>
        <title>Course List | Demo Section</title>
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
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <div class="container-fluid">
                        <h2>Course List</h2>
                        <div class="rightSide">
                            <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search text-center m-auto searchDiv">
                                <div class="input-group">
                                    <input type="text" name="inputSearch" id="inputSearch" placeholder="<?php echo $lang_search; ?>" title="<?php echo $lang_search_tooltip; ?>" class="form-control bg-white small"/>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" runat="server" id="searchButton" onclick="displayList()">
                                            <i class="fas fa-search fa-sm"></i> <?php echo $lang_search_btn; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leftSide">
                            <button class="btn btn-warning" onclick="displayList()"><i class="fa-solid fa-arrows-rotate"></i> <?php echo $lang_refresh_btn; ?></button>
                        </div>
                        <table class="table table-hover table2excel" id="tableList">
                            <thead>
                                <tr class="table-active">
                                    <th class="text-center" style="cursor:default;">Course Code</th>
                                    <th class="text-center" style="cursor:default;">Course Name</th>
                                    <th width="20%" class="text-center" style="cursor:default;">
                                        <?php echo $lang_action_btn; ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableContent">
                            </tbody>
                        </table>
                        <div id="displayPagination"></div>
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>



