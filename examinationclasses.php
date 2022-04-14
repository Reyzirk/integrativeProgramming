<?php include 'Function/load.php';require_once "Database/ChildClassDB.php";include 'Function/examinationclasses.php'; ?>
<?php $childID = $_SESSION["childID"]; ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<html>
    <head>
        <?php include 'Components/headmeta.php'; ?>

    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                    
                    <li class="breadcrumb-item active">Classes for examination</li>
                </ol>
            </div>
            <div class="container">
                <div class="alert alert-dismissible alert-danger">
                    Do you want switch to another child?  <a href="selectchild.php?transferpath=examination" class="alert-link">Switch Child</a>
                </div>
            </div>
            <br/>
            <section id="classes" class="classes">
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    <?php 
                        callLog();
                        $count = 0;
                        $childclassdb = new ChildClassDB();
                        $result = $childclassdb->listClass($childID);
                        foreach($result as $row){
                            $count++;
                            $startDate = date_create((string)$row["ClassStart"]);
                            $endDate = date_create((string)$row["ClassEnd"]);
                            if ($count%2==1){
                    ?>
                    <div class="row aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                            <?php } ?>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch shadow">
                            <div class="class-item" style="width:100%;">
                                <div class="class-content">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4>Y<?php echo $row["Year"] ?> SEM <?php echo $row["Semester"] ?></h4>
                                        <p class="time">(<?php echo convertDayToWeek(date_diff($startDate,$endDate)->format("%a")) ?>)</p>
                                    </div>
                                    
                                    <p>Duration: <?php echo $row["ClassStart"]." until ".$row["ClassEnd"]; ?></p>
                                    <h3 class="text-center">
                                        <a href="examinations.php?id=<?php echo $row["ClassID"]; ?>" class="btn btn-success">View Examination</a>
                                    </h3>
                                    <div class="formteacher d-flex justify-content-between align-items-center">
                                        <div class="formteacher-profile d-flex align-items-center">
                                            Form Teacher | 
                                            <span><?php echo $row["InstructorName"] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        if ($count%2==1){
                        ?>
                    </div>
                        <?php }?>
                    <?php                             
                        }?>
                </div>
            </section>
        </div>
        <?php include 'Components/footer.php' ?>
    </body>
</html>
