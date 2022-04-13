
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<!-- Author: Poh Choo Meng, Oon Kheng Huang, Fong Shu Ling, Ng Kar Kai  -->
<!-- Preloaded -->
 <!-- ======= Header ======= -->
<header id="header">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><span class="omegaLogo"><a href="">OMEGA</a></span></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="announcement.php">Announcement</a></li>
                <li class="dropdown"><a href="#" onclick="toggleMobileNavBarDropdown(this)"><span>Course</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="examinationclasses.php">Examination</a></li>
                        <li><a href="timetableclasses.php">Timetable</a></li>
                        <li><a href="homeworkclasses.php">Homework</a></li> <!--Optional, may delete it-->
                    </ul>
                </li>
                <li class="dropdown"><a href="#" onclick="toggleMobileNavBarDropdown(this)"><span>Child</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">View Child Details</a></li>
                        <li><a href="#">Update Child Details</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="attendance.php" onclick="toggleMobileNavBarDropdown(this)"><span>Attendance</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="attendance.php">Child Attendance</a></li>
                        <li class="dropdown"><a href="#" onclick="toggleMobileNavBarDropdown(this)"><span>COVID-19</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="TemperatureLevels.php">Temperature</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="">About</a></li>
                <li id="navbarSeperator"><a>|</a></li>
                <li class="dropdown"><a href="#" onclick="toggleMobileNavBarDropdown(this)"><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Log Out</a></li>
                    </ul>
                </li>

            </ul>

            <i class="bi bi-list mobile-nav-toggle" onclick="toggleMobileNavBar(this)"></i>

        </nav> <!-- NavBar-->

    </div>
</header> <!--End Header-->
