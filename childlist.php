<?php include 'Function/load.php'; include 'Database/ChildDB.php' ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================

@author Tang Khai Li
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
    </head>
    <body>
        <?php include 'Components/ParentNavBar.php' ?>
        <div id="content">
            <div class="breadcrumbs shadow container">
                <ol class="breadcrumb" id="breadcrumb">
                    <li class="breadcrumb-item"><a href="announcement.php">Announcement</a></li>
                    <li class="breadcrumb-item active">Child List</li>
                </ol>
                
            </div>
            <br/>
            <section id="classes" class="classes">
                
                <div class="container">
                    <div id="displayList">
                        <div class="jumbotrun" id="container">
                            <h2 class="text-center">Child List</h2>
                            <br/>
                            <table class="table table-hover" id="tableList">
                                <thead>
                                    <tr class="table-active">
                                        <th>Child Name</th>
                                        <th>Birth Date</th>
                                        <th>IC No</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $db = new ChildDB();
                                        $result = $db->getChildList($_SESSION["parentID"]);
                                        if ($result!=null){
                                        foreach($result as $row){
                                    ?>
                                    <tr>
                                    <td><?php echo $row["ChildName"]; ?></td>
                                    <td><?php echo $row["BirthDate"]; ?></td>
                                    <td><?php echo $row["ChildICNo"]; ?></td>
                                    <td><?php echo $row["Status"]; ?></td>
                                    <td><button class='btn btn-outline-info' onclick="location.href = 'viewchild.php?id=<?php echo $row["ChildID"]; ?>';"><i class="fa-solid fa-eye"></i> View</button></td>
                                    </tr>
                                        <?php }}else{
                                            ?>
                                <td colspan="5">RESULT NOT FOUND</td>
                                    <?php
                                        } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'Components/footer.php' ?>
    </body>
</html>
