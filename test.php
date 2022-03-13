<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once 'Database/MySQLQueryBuilder.php';
require_once 'Enum/EnumLoad.php';
$builder = new Database\MySQLQueryBuilder();
$value = $builder->select(["users"], ["name", "email", "password"])
        ->where("age", 18, OperatorEnum::LESSER, false)
        ->where("age", CustomSQLEnum::BIND_QUESTIONMARK, OperatorEnum::GREATER, true)
        ->order("ab")
        ->limit(10)
        ->query();
echo $value;