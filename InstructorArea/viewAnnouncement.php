<?php
include '../Function/load.php';
$pageName = basename(__FILE__);
include './Function/viewAnnouncement.php';
include './Function/addComment.php';
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
$lang_title = "View announcement";
$lang_description = "View an existing announcement.";
$lang_legendTitle = "Announcement Details";
$LoginID = "I0001"; //++++++++++++++++++++++++++++++++++++++++++++To be change to session user ID
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Announcement</title>
        <?php
        include './Components/headmeta.php';
        ?>
        <script src="js/createAnnouncement.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/comment.css" />
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                        <li class="breadcrumb-item active">View Announcement</li>
                    </ol>
                    <div class="container">
                        <div class="row">
                            <div class="col-md">
                                <div id="formControl">
                                    <div class="jumbotrun" id="container">

                                        <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                        <p class="lead"><?php echo $lang_description; ?> </p>
                                        <hr class="my-3">
                                        <div class="form-group">
                                            <fieldset>
                                                <form method="POST" id="form" name="form">
                                                    <legend><?php echo $lang_legendTitle; ?></legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="class" class="col-form-label font-weight-bold">Announcement ID</label>
                                                            <p class="p-12"><?php echo $announceInfo->announceID; ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="cat" class="col-form-label font-weight-bold">Category</label>
                                                            <p class="p-12"><?php echo convertCatToWord($announceInfo->cat); ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="date" class="col-form-label font-weight-bold">Date</label>
                                                            <p class="p-12"><?php echo $announceInfo->date; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="class" class="col-form-label font-weight-bold">Title</label>
                                                            <div style=" background-color: white; border-radius: 15px;box-shadow: 0px 5px 5px  rgba(51, 51, 51, 0.3);padding: 10px">
                                                                <span style="font-size: 20pt;padding-left:10px; word-break: break-word;"><?php echo $announceInfo->title; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="class" class="col-form-label font-weight-bold">Description</label>
                                                            <div style=" background-color: white; border-radius: 15px;box-shadow: 0px 5px 5px  rgba(51, 51, 51, 0.3); min-height: 100px">
                                                                <div style="padding: 15px;"><span style="background-color: white;word-break: break-word;">
                                                                        <?php
                                                                        //*************Implementation of AnnounceDecorator
                                                                        $parent = new InstructorsAnnounceDecorator($announceInfo);
                                                                        echo html_entity_decode($parent->getAnnounceDesc());
                                                                        ?></span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input hidden="true" name="formDetect" value="formDetect">
                                                </form>
                                                <br/>
                       <!--******************************************************Attachment********************************************************-->
                                                <?php if (!($announceInfo instanceof AnnounceWithNoAttach)) { ?>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <h5>Attachments</h5>
                                                            <hr/>
                                                            <?php
                                                            if ($announceInfo instanceof AnnounceWithImg) {
                                                                $attach = $announceInfo->attach;

                                                                foreach ($attach as $row) {
                                                                    ?>

                                                                    <a href="..<?php echo $row->filePath; ?>" target="_blank"><img src="..<?php echo $row->filePath ?>" width="auto" height="300" style="padding-right: 10px" /></a>

                                                                    <?php
                                                                }
                                                            } else if ($announceInfo instanceof AnnounceWithImgDoc) {
                                                                $img = array();
                                                                $doc = array();
                                                                $docName = array();
                                                                $attach = $announceInfo->attach;
                                                                foreach ($attach as $row) {

                                                                    $path = pathinfo($row->attachName, PATHINFO_EXTENSION);

                                                                    if ($path != "png" && $path != "jpeg" && $path != "svg" && $path != "jpg" && $path != "gif") {
                                                                        $doc[] = $row->filePath;
                                                                        $docName[] = $row->attachName;
                                                                    } else {
                                                                        $img[] = $row->filePath;
                                                                    }
                                                                }
                                                                foreach ($img as $row) {
                                                                    ?>
                                                                    <a href="..<?php echo $row; ?>" target="_blank"><img src="..<?php echo $row ?>" width="auto" height="300" style="padding-right: 10px" /></a>

                                                                    <?php
                                                                }
                                                                echo "<br/><br/>";
                                                                $i = 0;
                                                                foreach ($doc as $row) {
                                                                    ?>
                                                                    <img src="../images/docIcon.gif" width="20px" height="20px" /><a href="..<?php echo $row ?>" target="_blank"><?php echo $docName[$i] ?></a><br/>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                            } else {
                                                                $attach = $announceInfo->attach;
                                                                foreach ($attach as $row) {
                                                                    ?>
                                                                    <img src="../images/docIcon.gif" width="20px" height="20px" /><a href="..<?php echo $row->filePath ?>" target="_blank"><?php echo $row->attachName ?></a><br/>

                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </div>

                                                    </div>
                                                    <br/>
                                                    <?php
                                                }
                                                ?>
                                                    <!--******************************************************Comment********************************************************-->
                                                <?php if ($announceInfo->allowC == 0) { ?>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <h5>Comment</h5>
                                                            <hr/>
                                                            <div class="comment-form-container">
                                                                <form id="frm-comment" method="POST">
                                                                    <div class="input-row">
                                                                        <?php
                                                                        $intructorDB = new InstructorDB();
                                                                        $instructor = $intructorDB->details($announceInfo->instructorID);
                                                                        $instructorName = $instructor->instructorName;
                                                                        ?>
                                                                        <input type="hidden" name="userID" id="commentId" placeholder="Name" value="<?php echo $announceInfo->instructorID ?>"/>
                                                                        <input class="input-field" disabled="true" type="text" name="userName" id="name" placeholder="Name" value="<?php echo empty($instructorName) ? "" : $instructorName ?>" />
                                                                    </div>
                                                                    <div class="input-row">
                                                                        <textarea class="input-field" type="text" name="desc"
                                                                                  id="comment" placeholder="Add a Comment"><?php echo empty($storedValue["desc"]) ? "" : $storedValue["desc"] ?>  </textarea><br/>
                                                                        <span id="errormsg" style="color: red"><?php echo empty($error) ? "" : $error["desc"] ?></span>
                                                                    </div>
                                                                    <div>
                                                                        <input hidden="true" name="AnnounceID" value="<?php echo $id ?>">
                                                                        <input hidden="true" name="commentDetect" value="commentDetect">
                                                                        <input type="button" class="btn-submit" id="submitButton" onclick="validateComment()"
                                                                               value="Comment" />

                                                                    </div>

                                                                </form>
                                                            </div><br/>
                                                            <!--******************************************************Display Comment********************************************************-->
                                                            <?php
                                                            $commentDB = new CommentDB();
                                                            $count = $commentDB->getCountByAID($id);
                                                            if ($count != 0) {
                                                                $commentList = $commentDB->list($id);
                                                                //ParentDB+++++++++++++++++++++++++++++++++++++++++To be added after parent database created
                                                                ?>
                                                                <div class="comment-form-container">
                                                                    <h6>Comments (<?php echo $count ?>)</h6><hr/>
                                                                    <?php
                                                                    foreach ($commentList as $row) {
                                                                        $userID = $row->userID;
                                                                        if ($userID[0] == "I") {
                                                                            $commentName = $instructorName . " (Instructor)";
                                                                        }else{//else Parent+++++++++++++++++++++++++++++++++++++++++To be added after parent database created
                                                                            $commentName ="";
                                                                        }
                                                                        ?>
                                                                        <form id="deleteComment" name="deleteComment" method="POST">
                                                                            <div class="col-md" style="background-color: white; border-radius: 5px; margin-bottom: 5px">
                                                                                <div style="padding: 5px">

                                                                                    <span style="font-weight: bold;font-size: 11pt"><?php echo $commentName ?></span>
                                                                                    <span style="font-style: italic; font-size: 11pt"><?php echo $row->date ?></span>
                                                                                    <?php if ($LoginID == $userID) { ?>
                                                                                        <span style="float: right"><input type="submit" class="btnNoStyle" id="submitButton" value="Delete" /></span>
                                                                                        <input hidden="true" id="commentId" name="commentId" value="<?php echo $row->commentID ?>">
                                                                                    <?php } ?>
                                                                                    <br/>
                                                                                </div>
                                                                                <p style="font-size: 16pt; padding:5px; word-break: break-word;"><?php echo $row->desc ?></p>
                                                                            </div>
                                                                        </form>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            <?php } ?>
                                                            <script type="text/javascript">
                                                                function validateComment() {
                                                                    title = $("#comment");
                                                                    if ($.trim(title.val()).length === 0) {
                                                                        document.getElementById("errormsg").innerHTML = "<b>Comment</b> cannot be empty";
                                                                        title.focus();
                                                                        return false;
                                                                    } else if (title.val().length > 5000) {
                                                                        document.getElementById("errormsg").innerHTML = "<b>Comment</b> cannot contain more than 5000 characters";
                                                                    } else {
                                                                        $("#frm-comment").submit();
                                                                    }
                                                                }
                                                            </script>

                                                        </div>

                                                    </div>
                                                <?php } ?>
                                            </fieldset>
                                        </div>

                                        <center>
                                            <button type="button" class="btn btn-warning" id="submitBtn" onclick="location.href = 'editAnnouncement.php?aID=<?php echo $id; ?>'">Modify</button>
                                            <button type="button" class="btn btn-danger" onclick="location.href = 'announcement.php'">Back</button>
                                        </center>

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
