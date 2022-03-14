<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of QueryBuilder
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/OperatorEnum.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/OrderTypeEnum.php';
interface QueryBuilder{
    public function select(array $tables, array $fields);
    public function insert(string $table, array $columns = array());
    public function update(string $table, array $data = array());
    public function delete(string $table);
    public function values(array $values);
    public function join(string $table,string $leftOn,string $rightOn, JoinTypeEnum $type = \JoinTypeEnum::NONE);
    public function where(string $field, string $value, OperatorEnum $operator = \OperatorEnum::EQUAL, string $otheroperator = "");
    public function groupby(array $groupby);
    public function order(string $column, OrderTypeEnum $orderType = \OrderTypeEnum::DESC);
    public function limit(int $start, int $offset=0);
    
}
