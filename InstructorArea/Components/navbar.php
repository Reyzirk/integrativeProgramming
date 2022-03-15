<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion">
    <li><h1 class="sidebar-brand" id="title"><?php echo $generalSection["shortName"]; ?> <sub><span class="badge badge-light ">V1.0</span></sub></h1></li>
    <li><hr class="sidebar-divider" id="divider"></li>
    <li class='nav-item <?php echo $pageName=="dashboard.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    </li>
    <li class='nav-item <?php echo $pageName=="classes.php"?"active":$pageName=="createclass.php"?"active":$pageName=="editclass.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="classes.php"><i class="fa-solid fa-chalkboard"></i> Classes</a>
    </li>
    <li class='nav-item <?php echo $pageName=="courses.php"?"active":$pageName=="createcourse.php"?"active":$pageName=="editcourse.php"?"active":$pageName=="viewcourse.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="courses.php"><i class="fa-solid fa-book"></i> Courses</a>
    </li>
    <li class='nav-item <?php echo $pageName=="holidays.php"?"active":$pageName=="createholiday.php"?"active":$pageName=="editholiday.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="holidays.php"><i class="fa-solid fa-calendar"></i> Holidays</a>
    </li>
    <li class='nav-item <?php echo $pageName=="grades.php"?"active":$pageName=="creategrade.php"?"active":$pageName=="editgrade.php"?"active":""?>'>
        <a class="nav-link" id="nav-update" href="grades.php"><i class="fa-solid fa-a"></i> Grades</a>
    </li>
    <div class="middleButton d-none d-md-inline" onclick="toggle(this)">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>