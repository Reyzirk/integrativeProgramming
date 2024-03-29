<nav class="navbar navbar-expand navbar-light bg-white topbar mb-0 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" onclick="toggle2(this)">
        <i class="fa fa-bars"></i>
    </button>
    <h1 class="navbar-brand" id="title"><a href="announcement.php">Instructor Area</a></h1>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow" onclick="dropdown(this)">
            <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <span class="mr-2 text-gray-600 medium"><i class="fa fa-user"></i> <?php echo $_SESSION["instructorName"]; ?></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item <?php echo ($pageName=="instructorProfile.php"?"active":"");?>" href="instructorProfile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                    Profile
                </a>
                <a class="dropdown-item <?php echo ($pageName=="changepassword.php"?"active":"");?>" href="changepassword">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" aria-hidden="true"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- Scroll to top -->
<button type="button" id="scrollToTop" class="scrollToTop" onclick="scrollFunction()">
    <i class="fas fa-arrow-up"></i>
</button>
<script>initScrollToTop()</script>
