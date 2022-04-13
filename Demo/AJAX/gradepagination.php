<?php
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of displayCoursePagination
 *
 * @author Choo Meng
 */
$apiKey = "d61a42d239989eb9df075a70b5ad0e1435f7b186";
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$search = empty($_POST["search"]) ? null : eliminateExploit($_POST["search"]);
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
$count = 0;
$page = file_get_contents("http://localhost/IPAssignment/cmapi.php/grade/list?api-key=$apiKey&limit=$entry&index=$currentPage&search=$search");
$jsonStr = json_decode($page)[0];
if ($jsonStr->Status == "Success") {
    $dataStr = $jsonStr->Data;

    $variable = "Grade ID";
    $variable1 = "Grade";
    $variable2 = "Min Mark";
    $variable3 = "Max Mark";
    $variable4 = "Total Record in Database";
    $totalCount = $jsonStr->$variable4;
    $totalPage = (int) (ceil($totalCount / $entry));
    $beginIndex = ($currentPage - 1) * $entry;
    $endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);
    if ($totalCount != 0) {
        ?>
        <div class="entries text-right">
            <span>
                Show 
                <select class="form-select" id="displayEntries" onchange='updatePageEntry()'>
                    <option <?php echo $entry == 10 ? "selected" : "" ?>>10</option>
                    <option <?php echo $entry == 20 ? "selected" : "" ?>>20</option>
                    <option <?php echo $entry == 30 ? "selected" : "" ?>>30</option>
                    <option <?php echo $entry == 50 ? "selected" : "" ?>>50</option>
                    <option <?php echo $entry == 100 ? "selected" : "" ?>>100</option>
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
}
//For PHP version that below 8.0
function custom_str_contains(string $haystack, string $needle): bool {
    return '' === $needle || false !== strpos($haystack, $needle);
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
