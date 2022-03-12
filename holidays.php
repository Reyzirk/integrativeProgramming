<?php include 'Function/load.php' ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<?php include 'Function/holidays.php' ?>
<?php
#Page Languages
$lang_search = "Filter the holidays list";
$lang_search_btn = "Search";
$lang_search_tooltip = "Type in any word that you want to search";
$lang_refresh_btn = "Refresh";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php'; ?>

    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div id="displayList">
                <div class="breadcrumbs">
                    <div class="container">
                        <h2>Holidays</h2>
                       
                    </div>
                </div>
                <br/>
                <div class="container animate__animated animate__fadeIn">
                    <div class="rightSide">
                        <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search text-center m-auto searchDiv">
                            <div class="input-group">
                                <input type="text" name="inputSearch" id="inputSearch" placeholder="<?php echo $lang_search; ?>" title="<?php echo $lang_search_tooltip; ?>" class="form-control bg-white small"/>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" runat="server" id="searchButton" onclick="displayList();">
                                        <i class="fas fa-search fa-sm"></i> <?php echo $lang_search_btn; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="leftSide">
                        <button class="btn btn-warning" onclick="displayList();"><?php echo $lang_refresh_btn; ?></button>
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
        <?php include 'Components/footer.php' ?>
    </body>
</html>
