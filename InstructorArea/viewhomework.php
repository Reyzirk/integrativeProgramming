<?php include '../Function/load.php';$pageName = basename(__FILE__); ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<?php include 'Function/viewhomework.php';?>
<?php
#Page Languages
$lang_title = "View existing homework";
$lang_description = "View an existing homework.";
$lang_legendTitle = "Homework Details";
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
        <script src="js/createhomework.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'Components/navbar.php' ?>
            <div id="content-wrapper">
                <div id="content">
                    <?php include 'Components/header.php' ?>
                    <ol class="breadcrumb shadow" id="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.jsp">Home</a></li>
                        <li class="breadcrumb-item"><a href="homeworks.jsp">Homework</a></li>
                        <li class="breadcrumb-item active">View Homework</li>
                    </ol>
                    <div class="container-fluid">
                        <div id="formControl">
                            <div class="jumbotrun" id="container">
                                <form method="POST" id="form" name="form">
                                    <h1 class="display-4"><?php echo $lang_title; ?></h1>
                                    <p class="lead"><?php echo $lang_description; ?> </p>
                                    <hr class="my-3">
                                    <div class="form-group">
                                        <fieldset>
                                            <legend><?php echo $lang_legendTitle; ?></legend>
                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="class" class="col-form-label">Class</label>
                                                    <p class="p-12 font-weight-bold"><?php echo $retrievedHomework->class; ?></p>
                                                </div>
                                                <div class="col-md">
                                                    <label for="date" class="col-form-label">Date</label>
                                                    <p class="p-12 font-weight-bold"><?php echo $retrievedHomework->date; ?></p>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="row">
                                                <div class="col-md">
                                                    <h5>Homeworks</h5>
                                                    <hr/>
                                                    <?php echo htmlspecialchars_decode($retrievedHomework->homework); ?>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                    <input hidden="true" name="formDetect" value="formDetect">
                                    <center>
                                         <button type="button" class="btn btn-warning" id="submitBtn" onclick="editcourse.php?id=<?php echo $id; ?>">Modify</button>
                                        <button type="button" class="btn btn-danger" onclick="location.href='homeworks.php?id=<?php echo $retrievedHomework->class; ?>'">Back</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "Components/footer.php"; ?>
            </div>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('.editor'), {

                })
                .then(editor => {
                    window.editor = editor;
                    const wordCountPlugin = editor.plugins.get('WordCount');
                    const wordCountWrapper = document.getElementById('word-count');

                    wordCountWrapper.appendChild(wordCountPlugin.wordCountContainer);
                })
        </script>
    </body>
</html>
