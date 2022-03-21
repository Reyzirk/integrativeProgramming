<?php
include 'Function/load.php';
require_once "Database/ChildClassDB.php";
include 'Function/timetable.php';
?>
<?php $childID = $_SESSION["childID"]; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<?php
#Page Languages
$lang_search = "Filter the holidays list";
$lang_search_btn = "Search";
$lang_search_tooltip = "Type in any word that you want to search";
$lang_create_btn = "Create new holiday";
$lang_refresh_btn = "Refresh";
$lang_action_btn = "Action";
?>
<html>
    <head>
<?php include 'Components/headmeta.php'; ?>
        <script src="js/timetable.js" type="text/javascript"></script>
    </head>
    <body>
<?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Announcement</a></li>
                    <li class="breadcrumb-item active">Timetable</li>
                </ol>

            </div>
            <div class="container">
                <div class="alert alert-dismissible alert-danger">
                    Do you want switch to another child?  <a href="selectchild.php?transferpath=timetable" class="alert-link">Switch Child</a>
                </div>
            </div>

            <br/>
            <section id="classes" class="classes">

                <div class="container">
                    <div id="displayList">
                        <div class="jumbotrun" id="container">
                            <h2 class="text-center">Timetable</h2>
                            <br/>
                            <div class="leftSide">
                                <button class="btn btn-success" id="download" onclick="downloadSchedule()"><i class="fa-solid fa-download"></i> PDF Download</button>
                            </div>
                            <br/>
                            <div class="schedule" id="schedule">
                                <?php
                                foreach ($scheduleList as $key => $value) {
                                    ?>
                                    <div class="dayOfWeekTitle bg-info">
                                        <?php echo $key; ?>
                                    </div>
                                    <ul>
                                        <?php
                                        foreach ($value as $row) {
                                            $timeStart = new DateTime($row->timeStart);
                                            $endtime = new DateTime($row->timeStart);
                                            $endtime->add(new DateInterval('PT' . $row->duration . 'M'));
                                            $course = $parser2->getCourse($row->courseCode);
                                            ?>
                                            <li>
        <?php echo $timeStart->format("h:i A"); ?> - <?php echo $endtime->format('h:i A'); ?> (<?php echo convertMinute($row->duration); ?>) <a href="#" onclick="getCourseDetails('<?php echo $row->courseCode; ?>')" style="text-decoration: none;"><b><?php echo $row->courseCode . " " . $course->courseName ?></a> [<?php echo $row->classType; ?>]</b>
                                                <br/>
                                                <b><?php echo $row->instructor; ?></b>
                                            </li>
                                    <?php } ?>
                                    </ul>
                            <?php } ?>
                            </div>
                            <?php
                            if ($result == NULL) {
                                ?>
                                <div class="card text-white bg-danger mb-3 m-auto" style="max-width: 50rem">
                                    <div class="card-header text-center"><b>No result found</b></div>
                                    <div class="card-body">
                                        <p class="card-text text-center">Please contact administrator, if this is a mistake.</p>
                                    </div>
                                </div>
<?php } ?>
                            <br/>
                            <h2 class="text-center">Holidays</h2>
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
                            <br/>
                            <div class="leftSide">
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
        <br/>
        <br/>
        <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalTitle"><span id="courseTitle"></span></h5>
                    </div>
                    <div class="modal-body">
                        <h6><b>Course Description:</b></h6>
                        <span id="courseDesc"></span>
                        <br/>
                        <h6><b>Course Materials:</b></h6>
                        <span id="courseMaterials"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'Components/footer.php' ?>
    </body>
</html>