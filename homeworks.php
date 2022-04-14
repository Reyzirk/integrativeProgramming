<?php include 'Function/load.php';require_once "Database/ChildClassDB.php";include 'Function/homeworks.php'; ?>
<?php $childID = $_SESSION["childID"]; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
//Author: Poh Choo Meng
-->
<?php
#Page Languages
$lang_search = "Filter the homeworks list";
$lang_search_btn = "Search";
$lang_search_tooltip = "Type in any word that you want to search";
$lang_refresh_btn = "Refresh";
$lang_action_btn = "Action";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php'; ?>
        <script src="js/homeworks.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                    <li class="breadcrumb-item active">Homeworks</li>
                </ol>
                
            </div>
            <div class="container">
                <div class="alert alert-dismissible alert-danger">
                    Do you want switch to another child?  <a href="selectchild.php?transferpath=homework" class="alert-link">Switch Child</a>
                </div>
            </div>
            
            <br/>
            <section id="classes" class="classes">
                
                <div class="container">
                    <div id="displayList">
                        <div class="jumbotrun" id="container">
                            <h2 class="text-center">Homework List</h2>
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
                                <button class="btn btn-success" id="download" onclick="downloadPDF()"><i class="fa-solid fa-download"></i> PDF Download</button>
                                <button class="btn btn-success" id="downloadXLSX" onclick="downloadXLSX()"><i class="fa-solid fa-sheet-plastic"></i> Excel Download</button>
                            </div>
                            <br/>
                            <table class="table table-hover table2excel" id="tableList">
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
            </section>
        </div>
        <?php include 'Components/footer.php' ?>
    </body>
</html>
