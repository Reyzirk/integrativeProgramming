<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion">
    <li><h1 class="sidebar-brand" id="title"><?php echo $generalSection["shortName"]; ?> <sub><span class="badge badge-light ">V1.0</span></sub></h1></li>
    <li><hr class="sidebar-divider" id="divider"></li>
    <li class='nav-item <?php echo $pageName=="dashboard.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    </li>
    <li class='nav-item <?php echo ($pageName=="announcement.php"?"active":($pageName=="createAnnouncement.php"?"active":($pageName=="editAnnouncement.php"?"active":($pageName=="viewAnnouncement.php"?"active":""))))?>'>
        <a class="nav-link" id="nav-update" href="announcement.php"><i class="fa-solid fa-bullhorn"></i> Announcement</a>
    </li>
    <li class='nav-item dropdown <?php echo ($pageName=="classes.php"?"active":($pageName=="createclass.php"?"active":($pageName=="editclass.php"?"active":$pageName=="childclasses.php"?"active":"")))?>' onclick="dropdown(this)">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="nav-update" href="#" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa-solid fa-chalkboard"></i> Classes</a>
        <div class="collapse">
            <div class="bg-white py-2 collapse-inner rounded mt-1">
                <a class="collapse-item <?php echo ($pageName=="classes.php"?"active":($pageName=="createclass.php"?"active":($pageName=="editclass.php"?"active":$pageName=="childclasses.php"?"active":"")))?>" href="classes.php">Class List</a>
                <a style="cursor:pointer;" class="collapse-item <?php echo ($pageName=="childclasses.php"?"active":"");?>" onclick="navigateToChildClass()">Student</a>
            </div>
        </div>
       
    </li>
    <li class='nav-item <?php echo ($pageName=="courses.php"?"active":($pageName=="createcourse.php"?"active":($pageName=="editcourse.php"?"active":($pageName=="viewcourse.php"?"active":""))))?>'>
        <a class="nav-link" id="nav-update" href="courses.php"><i class="fa-solid fa-book"></i> Courses</a>
    </li>
    <li class='nav-item dropdown <?php echo ($pageName=="examinations.php"?"active":($pageName=="createexaminations.php"?"active":($pageName=="editexaminations.php"?"active":($pageName=="viewexaminations.php"?"active":($pageName=="examresults.php"?"active":"")))))?>' onclick="dropdown(this)">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="nav-update" href="#" role="button" aria-haspopup="true" aria-expanded="true"><i class="fa-solid fa-book"></i> Examinations</a>
        <div class="collapse">
            <div class="bg-white py-2 collapse-inner rounded mt-1">
                <a class="collapse-item <?php echo ($pageName=="examinations.php"?"active":($pageName=="createexaminations.php"?"active":($pageName=="editexaminations.php"?"active":($pageName=="viewexaminations.php"?"active":($pageName=="examresults.php"?"active":"")))))?>" href="examinations.php">Exam List</a>
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
    <div class="middleButton d-none d-md-inline" onclick="toggle(this)">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>