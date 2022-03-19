<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";

require_once str_replace("InstructorArea", "", str_replace("AJAX", "", dirname(__DIR__))) . '/Database/ChildClassDB.php';
$totalCount = 0;
$sortType = trim(empty($_POST["sorttype"]) ? "Name" : eliminateExploit($_POST["sorttype"]));
$sortOrder = trim(empty($_POST["sortorder"]) ? "ASC" : eliminateExploit($_POST["sortorder"]));
$search = empty($_POST["search"]) ? "" : eliminateExploit($_POST["search"]);
$entry = empty($_POST["entry"]) ? 20 : (int) $_POST["entry"];
$currentPage = empty($_POST["currentPage"]) ? 1 : (int) $_POST["currentPage"];
if (!isset($_POST["id"])){
    
?>
    <tr>
        <td colspan='7'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
<?php
    return;
}else{
    $id = $_POST["id"];
}
$classdb = new ChildClassDB();
if ($sortType==="Name"){
    $sortType = "ChildName";
}else if ($sortType==="Parent Email"){
    $sortType = "ParentEmail";
}else if ($sortType==="IC No"){
    $sortType = "ChildICNo";
}
try{
    $totalCount = $classdb->getCount($search,$id);
} catch (PDOException $ex) {
    if ($generalSection["maintenance"]==true){
        echo $ex->getMessage();
    }else{
        callPDOExceptionLog($ex);
    }

}
$beginIndex = ($currentPage - 1) * $entry;
$endIndex = ($currentPage * $entry) >= $totalCount ? $totalCount : ($currentPage * $entry);

if ($totalCount == 0) {
    ?>
    <tr>
        <td colspan='7'height='60px' class='emptySlot'>
            <b>NO RESULT FOUND</b>
        </td>
    </tr>
    <?php
} else {
    $builder = new MySQLQueryBuilder();
    $query = $builder->select(array("childclass","child","parent"), array("ParentEmail","ChildName","ChildICNo","ClassID","childclass.ChildID"))
        ->where("ParentEmail", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ChildName", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->where("ChildICNo", "%".$search."%", WhereTypeEnum::OR, OperatorEnum::LIKE)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("childclass.ChildID", "child.ChildID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false)
        ->where("child.ParentID", "parent.ParentID", WhereTypeEnum::AND, OperatorEnum::EQUAL, false )
        ->where("childclass.ClassID", $id, WhereTypeEnum::AND, OperatorEnum::EQUAL)
        ->bracketWhere(WhereTypeEnum::AND)
        ->order($sortType, $sortOrder)
        ->limit($beginIndex,$endIndex)
        ->query();
    try{
        $results = $classdb->select($query);
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
            callPDOExceptionLog($ex);
        }

    }
    $index = 0;
   
    foreach($results as $row){
        $index ++;
        ?>
        <tr id="<?php echo $row["ClassID"]; ?>">
            <td class="text-center"><?php echo $index; ?></td>
            <td class="text-center"><?php echo $row["ChildName"]; ?></td>
            
            <td class="text-center"><?php echo $row["ChildICNo"]; ?></td>
            <td class="text-center"><?php echo $row["ParentEmail"]; ?> <i class="fa-solid fa-envelope" onclick="location.href='mailto: <?php echo $row["ParentEmail"]; ?>'"></i></td>
            <td class="text-center">
                <button class='btn btn-outline-danger' onclick="deleteDataRecord('<?php echo $row["ClassID"]; ?>','<?php echo $row["ChildID"]; ?>');"><i class="fa-solid fa-trash"></i> Delete</button>
            </td>
        </tr>
        <?php
    }
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}