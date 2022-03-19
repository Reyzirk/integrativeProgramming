<?php include '../Function/load.php';$pageName = basename(__FILE__); ?>
<?php include 'Function/examresults.php' ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->


<?php
#Page Languages
$lang_search = "Filter the list";
$lang_search_btn = "Search";
$lang_search_tooltip = "Type in any word that you want to search";
$lang_refresh_btn = "Refresh";
$lang_create_btn = "Assign By Child";
$lang_create_btn2 = "Assign By Class";
$lang_action_btn = "Action";

?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/examresults.js" type="text/javascript"></script>
    </head>
    <body>
        <?php callLog(); ?>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="classes.php">Examination</a></li>
                        <li class="breadcrumb-item active">Exam Results</li>
                    </ol>
                    <div class="container-fluid">
                        <div id="displayList">
                            <div class="jumbotrun" id="container">
                                <div class="text-right">
                                    <button class="btn btn-info mt-3" onclick="createBtn()"><i class="fa-solid fa-square-plus"></i> <?php echo $lang_create_btn; ?></button>
                                    <button class="btn btn-info mt-3 ml-2" onclick="createBtn2()"><i class="fa-solid fa-square-plus"></i> <?php echo $lang_create_btn2; ?></button>
                                </div>
                                <br/>
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
                                    <button class="btn btn-warning" onclick="displayList()"><?php echo $lang_refresh_btn; ?></button>
                                </div>
                                <br/>
                                <table class="table table-hover" id="tableList">
                                    <thead>
                                        <tr class="table-active">
                                            <?php
                                            foreach ($dataArray as $key => $value) {
                                                ?>
                                                <th width="<?php echo $value["Width"]; ?>" class="text-center" onclick="sortCol(this)"><?php echo $value["Title"] ?> <i class="fas fa-sort"></i></th>
                                                <?php
                                            }
                                            ?>
                                            <th width="15%" class="text-center" style="cursor:default;">
                                                <?php echo $lang_action_btn; ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableContent">
                                    </tbody>
                                </table>
                                <div id="displayPagination">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>
