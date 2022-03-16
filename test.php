<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once 'Database/MySQLQueryBuilder.php';
require_once 'Enum/EnumLoad.php';
$builder = new MySQLQueryBuilder();
$value = $builder->select(["users"], ["name", "email", "password"])
        ->where("age", 18, WhereTypeEnum::OR, OperatorEnum::LESSER, false)
        ->where("age", 21, WhereTypeEnum::OR, OperatorEnum::LESSER, false)
        ->bracketWhere(WhereTypeEnum::OR)
        ->where("age", CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::GREATER, true)
        ->bracketWhere(WhereTypeEnum::AND)
        ->where("age", CustomSQLEnum::BIND_QUESTIONMARK, WhereTypeEnum::AND, OperatorEnum::GREATER, true)
        ->order("ab")
        ->limit(10)
        ->query();
echo $value;