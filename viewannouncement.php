<?php
include 'Function/load.php';
include 'Function/viewAnnouncement.php';
include 'Function/addComment.php';
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
$lang_title = "View announcement";
$lang_description = "View an existing announcement.";
$lang_legendTitle = "Announcement Details";
$LoginID = "P001"; //++++++++++++++++++++++++++++++++++++++++++++To be change to session user ID
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>View Announcement</title>
        <?php
        include 'Components/headmeta.php';
        ?>
        <script src="InstructorArea/js/createAnnouncement.js" type="text/javascript"></script>
        <link rel="stylesheet" href="InstructorArea/css/comment.css" />
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/ParentNavBar.php' ?>
            <div id="content-wrapper">
                <div id="content">

                     <div class="breadcrumbs shadow container">
                        <ol class="breadcrumb" id="breadcrumb">
                            <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                            <li class="breadcrumb-item active">View Announcement</li>
                        </ol>

                    </div>
                    <div class="container aos-init aos-animate" data-aos="fade-up">
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
                                                            <label for="class" class="col-form-label font-weight-bold"><b>Announcement ID</b></label>
                                                            <p class="p-12"><?php echo $announceInfo->announceID; ?></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="cat" class="col-form-label font-weight-bold"><b>Category</b></label>
                                                            <p class="p-12"><a href="announceCategory.php?cat=<?php echo $announceInfo->cat?>" style="text-decoration: none"><?php echo convertCatToWord($announceInfo->cat); ?></a></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="date" class="col-form-label font-weight-bold"><b>Date</b></label>
                                                            <p class="p-12"><?php echo $announceInfo->date; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="class" class="col-form-label font-weight-bold"><b>Title</b></label>
                                                            <div style="border:1px solid black; background-color: white; border-radius: 15px;box-shadow: 0px 5px 5px  rgba(51, 51, 51, 0.3);padding:10px;word-break: break-word">
                                                                <span style="font-size: 20pt;"><?php echo $announceInfo->title; ?></span>
                                                            </div>
                                                        </div>
                                                    </div><br/>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="class" class="col-form-label font-weight-bold"><b>Description</b></label>
                                                            <div style="border:1px solid black; background-color: white; border-radius: 15px;box-shadow: 0px 5px 5px  rgba(51, 51, 51, 0.3); min-height: 100px">
                                                                <div style="padding: 15px;"><span style="background-color: white;word-break: break-word">
                                                                        <?php
                                                                        //*************Implementation of AnnounceDecorator
                                                                        $parent = new ParentsAnnounceDecorator($announceInfo);
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
                                                            //************************Announce With Img******************************
                                                            if ($announceInfo instanceof AnnounceWithImg) {
                                                                $attach = $announceInfo->attach;

                                                                foreach ($attach as $row) {
                                                                    ?>

                                                                    <a href="<?php echo substr($row->filePath, 1); ?>" target="_blank"><img src="<?php echo substr($row->filePath, 1) ?>" width="auto" height="300" style="padding-right: 10px" /></a>

                                                                    <?php
                                                                }
                                                                //************************Announce With ImgDoc******************************
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
                                                                    <a href="<?php echo substr($row, 1); ?>" target="_blank"><img src="<?php echo substr($row, 1) ?>" width="auto" height="300" style="padding-right: 10px" /></a>

                                                                    <?php
                                                                }
                                                                echo "<br/><br/>";
                                                                $i = 0;
                                                                foreach ($doc as $row) {
                                                                    ?>
                                                                    <img src="images/docIcon.gif" width="20px" height="20px" /><a href="<?php echo substr($row, 1) ?>" target="_blank"><?php echo $docName[$i] ?></a><br/>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                //************************Announce With Doc******************************
                                                            } else {
                                                                $attach = $announceInfo->attach;
                                                                foreach ($attach as $row) {
                                                                    ?>
                                                                    <img src="images/docIcon.gif" width="20px" height="20px" /><a href="<?php echo substr($row->filePath, 1) ?>" target="_blank"><?php echo $row->attachName ?></a><br/>

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
                                                                        $instructorName = $instructor->name;
                                                                        ?>
                                                                        <input type="hidden" name="userID" id="commentId" placeholder="Name" value="<?php echo $LoginID ?>"/>
                                                                        <input class="input-field" disabled="true" type="text" name="userName" id="name" placeholder="Name" value="<?php echo empty($instructorName) ? "" : $instructorName //Change to parent Name ?>" />
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
                                                                            $commentName = "";
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
                                                                                <p style="font-size: 16pt; padding:5px"><?php echo $row->desc ?></p>
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
                                        </div><br/>

                                        <center>                                        
                                            <button type="button" class="btn btn-danger" onclick="location.href = 'announcement.php'">Back</button>
                                        </center>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br/><br/>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
    </body>
</html>
