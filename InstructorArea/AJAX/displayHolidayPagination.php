<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of displayHolidayPagination
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/XML/HolidaysParser.php';
$parser = new HolidaysParser(str_replace("InstructorArea", "", dirname(__DIR__)) . "/XML/holidays.xml");
$holidays = $parser->getHolidays();
$totalCount = count($holidays);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
$totalPage = (int) (ceil($totalCount / $entry));
if ($totalCount != 0) {
    ?>
    <div class="entries text-right">
        <span>
            Show 
            <select class="form-select" id="displayEntries" onchange='updatePageEntry()'>
                <option <?php echo $entry==10?"selected":"" ?>>10</option>
                <option <?php echo $entry==20?"selected":"" ?>>20</option>
                <option <?php echo $entry==30?"selected":"" ?>>30</option>
                <option <?php echo $entry==50?"selected":"" ?>>50</option>
                <option <?php echo $entry==100?"selected":"" ?>>100</option>
            </select>
            Entries
        </span>
    </div>
    <center>
        <ul class="pagination">
            <?php
            if ($currentPage != 1) {
                ?>
                <li class='page-item'>
                    <a class='page-link' runat="server" onclick="updatePageIndex(1)">&laquo;</a>
                </li>
                <?php
            } else {
                ?>
                <li class='page-item disabled'>
                    <a class='page-link'>&laquo;</a>
                </li>
                <?php
            }
            for ($i = 1; $i <= $totalPage; $i++) {
                ?>
                <li class='page-item <?php echo $i == $currentPage ? "active" : ""; ?>'>
                    <a class='page-link' runat="server" onclick="updatePageIndex(<?php echo $i; ?>)"><?php echo $i; ?></a>
                </li>
                <?php
            }
            if ($currentPage != $totalPage) {
                ?>
                <li class='page-item'>
                    <a class='page-link' runat="server" onclick="updatePageIndex(<?php echo $totalPage; ?>)">&raquo;</a>
                </li>
                <?php
            } else {
                ?>
                <li class='page-item disabled'>
                    <a class='page-link'>&raquo;</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </center>
    


    <?php
}