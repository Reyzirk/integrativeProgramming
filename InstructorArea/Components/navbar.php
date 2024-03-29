<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion">
    <li class="list-brand"><h1 class="sidebar-brand" id="title"><div class="sidebar-brand-icon"><img src="../images/logo.gif"/></div><?php echo $generalSection["shortName"]; ?> <sub><span class="badge badge-light ">V1.0</span></sub></h1></li>
    <li><hr class="sidebar-divider" id="divider"></li>
    <li class='nav-item <?php echo ($pageName=="announcement.php"?"active":($pageName=="createAnnouncement.php"?"active":($pageName=="editAnnouncement.php"?"active":($pageName=="viewAnnouncement.php"?"active":""))))?>'>
        <a class="nav-link" id="nav-update" href="announcement.php"><i class="fa-solid fa-bullhorn"></i> Announcement</a>
    </li>
    <li class='nav-item dropdown <?php echo ($pageName=="classes.php"?"active":($pageName=="createclass.php"?"active":($pageName=="editclass.php"?"active":($pageName=="childclasses.php"?"active":($pageName=="courseschedule.php"?"active":($pageName=="createcourseschedule.php"?"active":($pageName=="editcourseschedule.php"?"active":($pageName=="viewClassAttendance.php"?"active":($pageName=="insertChildAttendance.php"?"active":($pageName=="homeworks.php"?"active":($pageName=="createhomework.php"?"active":($pageName=="edithomework.php"?"active":($pageName=="viewhomework.php"?"active":"")))))))))))))?>' onclick="dropdown(this)">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="nav-update" href="#" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa-solid fa-chalkboard"></i> Classes</a>
        <div class="collapse">
            <div class="bg-white py-2 collapse-inner rounded mt-1">
                <a class="collapse-item 
                    <?php echo ($pageName=="viewClassAttendance.php"?"active":($pageName=="insertChildAttendance.php"?"active":""));?>" 
                    href="viewClassAttendance.php">Attendance</a>
                <a class="collapse-item <?php echo ($pageName=="classes.php"?"active":($pageName=="createclass.php"?"active":($pageName=="editclass.php"?"active":"")))?>" href="classes.php">Class List</a>
                <a style="cursor:pointer;" class="collapse-item <?php echo ($pageName=="childclasses.php"?"active":"");?>" onclick="navigateToChildClass()">Student</a>
                <a style="cursor:pointer;" class="collapse-item <?php echo ($pageName=="courseschedule.php"?"active":($pageName=="createcourseschedule.php"?"active":($pageName=="editcourseschedule.php"?"active":"")));?>" onclick="navigateToCourseSchedule()">Schedule</a>
                <a style="cursor:pointer;" class="collapse-item <?php echo ($pageName=="homeworks.php"?"active":($pageName=="createhomework.php"?"active":($pageName=="edithomework.php"?"active":($pageName=="viewhomework.php"?"active":""))));?>" onclick="navigateToHomework()">Homeworks</a>
            </div>
        </div>
       
    </li>
    <li class='nav-item <?php echo ($pageName=="courses.php"?"active":($pageName=="createcourse.php"?"active":($pageName=="editcourse.php"?"active":($pageName=="viewcourse.php"?"active":""))))?>'>
        <a class="nav-link" id="nav-update" href="courses.php"><i class="fa-solid fa-book"></i> Courses</a>
    </li>
    <li class='nav-item dropdown <?php echo ($pageName=="examinations.php"?"active":($pageName=="createexamination.php"?"active":($pageName=="editexamination.php"?"active":($pageName=="viewexamination.php"?"active":($pageName=="examresults.php"?"active":"")))))?>' onclick="dropdown(this)">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="nav-update" href="#" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa-solid fa-scroll"></i> Exams</a>
        <div class="collapse">
            <div class="bg-white py-2 collapse-inner rounded mt-1">
                <a class="collapse-item <?php echo ($pageName=="examinations.php"?"active":($pageName=="createexamination.php"?"active":($pageName=="editexamination.php"?"active":($pageName=="viewexamination.php"?"active":""))))?>" href="examinations.php">Exam List</a>
                <a style="cursor:pointer;" class="collapse-item <?php echo ($pageName=="examresults.php"?"active":"");?>" onclick="navigateToExamResult()">Assign Student</a>
            </div>
        </div>
       
    </li>
    <li class='nav-item <?php echo ($pageName=="holidays.php"?"active":($pageName=="createholiday.php"?"active":($pageName=="editholiday.php"?"active":"")))?>'>
        <a class="nav-link" id="nav-update" href="holidays.php"><i class="fa-solid fa-calendar"></i> Holidays</a>
    </li>
    <li class='nav-item <?php echo ($pageName=="grades.php"?"active":($pageName=="creategrade.php"?"active":($pageName=="editgrade.php"?"active":"")))?>'>
        <a class="nav-link" id="nav-update" href="grades.php"><i class="fa-solid fa-a"></i> Grades</a>
    </li>
    <li class='nav-item <?php echo $pageName=="addattendance.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="addattendance.php"><i class="fa fa-address-card"></i> Attendance Log</a>
    </li>
    
    <!--
    ***The add parent logo need to change***
    -->
    <li class='nav-item dropdown <?php echo $pageName=="parent.php"?"active":""?>' onclick="dropdown(this)">
        <!--<a class="nav-link" id="nav-update" href="parent.php"><i class="fa fa-address-card"></i> Parent</a>-->
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="nav-update" href="#" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa-solid fa-scroll"></i> Parent</a>
        <div class="collapse">
            <div class="bg-white py-2 collapse-inner rounded mt-1">
                <a class="collapse-item <?php echo ($pageName=="parent.php"?"active":"")?>" href="parent.php">Parent</a>
            </div>
        </div>
    </li>
    <div class="middleButton d-none d-md-inline" onclick="toggle(this)">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
