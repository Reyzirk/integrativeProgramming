<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include './Function/announcement.php';
?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Oon Kheng Huang
-->
<?php
#Page Languages
$lang_search = "Search (ID/Date/Title)";
$lang_search_btn = "Search";
$lang_search_tooltip = "Type in any word that you want to search";
$lang_create_btn = "Create new announcement";
$lang_refresh_btn = "Refresh";
$lang_action_btn = "Action";
$lang_delete_all_btn = "Delete All";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Announcement</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <script src="js/announcement.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item active">Announcement</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <div id="displayList">
                                <div class="jumbotrun" id="container">
                                    <div class="text-right">
                                        <button class="btn btn-info" onclick="location.href = 'createAnnouncement.php'"><i class="fa-solid fa-square-plus"></i> <?php echo $lang_create_btn; ?></button>
                                       
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
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>
