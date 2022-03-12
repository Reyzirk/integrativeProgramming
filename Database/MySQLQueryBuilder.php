<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

namespace Database;

/**
 * Description of QueryBuilder
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Database/QueryBuilder.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Enum/EnumLoad.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Objects/SQLQuery.php';
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . '/Exception/QueryBuilderException.php';
class MySQLQueryBuilder implements QueryBuilder{
    private $query;
    private $blockType1 = [\QueryTypeEnum::SELECT,\QueryTypeEnum::UPDATE,\QueryTypeEnum::DELETE];
    private $blockType2 = [\QueryTypeEnum::INSERT];
    private $blockType3 = [\QueryTypeEnum::SELECT];
    private function clear(){
        $this->query = new \SQLQuery();
    }
    public function select(array $tables, array $fields){
        $this->clear();
        if (empty($tables)){
            throw new \QueryBuilderException("Table cannot empty.");
        }
        if (empty($fields)){
            throw new \QueryBuilderException("Table cannot empty.");
        }
        $this->query->type = \QueryTypeEnum::SELECT;
        $this->query->base = "SELECT ".implode(", ", $fields)." FROM ".implode(", ", $tables);
        return $this;
    }
    public function insert(string $table, array $columns = array()){
        $this->clear();
        $this->query->type = \QueryTypeEnum::INSERT;
        if (empty($table)){
            throw new \QueryBuilderException("Table cannot empty.");
        }
        $this->query->base = "INSERT INTO $table ";
        if (!empty($columns)){
            $this->query->base .= "(".implode(", ",$columns).") ";
        }
        return $this;
    }
    public function update($table, $data){
        $this->clear();
        $this->query->type = \QueryTypeEnum::UPDATE;
        if (empty($table)){
            throw new \QueryBuilderException("Table cannot empty.");
        }
        $this->query->base = "UPDATE $table SET ";
        if (empty($data)){
             throw new \QueryBuilderException("Data cannot empty.");
        }else{
            if (!$this->isAssociativeArray($data)){
                throw new \QueryBuilderException("Data must use associative array.");
            }
        }
        $dataCount = count($data);
        foreach ($data as $col => $value){
            $this->query->base .= "$col = $value";
            if ($i !== $dataCount){
                $this->query->base .= ", ";
            }
        }
        return $this;
    }
    public function delete($table){
        $this->clear();
        $this->query->type = \QueryTypeEnum::DELETE;
        if (empty($table)){
            throw new \QueryBuilderException("Table cannot empty.");
        }
        $this->query->base = "DELETE FROM $table";
        return $this;
    }
    public function values(array $values){
        if (!in_array($this->query->type, $this->blockType2)){
            throw new \QueryBuilderException("VALUES syntax not allowed to use for ".$this->query->type);
        }
        if (empty($values)){
            throw new \QueryBuilderException("Values cannot empty.");
        }
        $this->query->addValues("VALUES (".implode(", ",$values).")");
        return $this;
    }
    public function where($field, $value, $operator = \OperatorEnum::EQUAL, $singlequote = true, $otheroperator = ""){
        if (!in_array($this->query->type, $this->blockType1)){
            throw new \QueryBuilderException("WHERE syntax not allowed to use for ".$this->query->type);
        }
        if (empty($field)){
            throw new \QueryBuilderException("Field cannot empty.");
        }
        if (empty($value)){
            throw new \QueryBuilderException("Value cannot empty.");
        }
        $startquote = $singlequote?"'":"";
        $endquote = $singlequote?"'":"";
        $value = $startquote.$value.$endquote;
        if ($operator == \OperatorEnum::OTHERS){
            $this->query->addWhere("$field $otheroperator $value");
        }else{
            $ope = $operator;
            $this->query->addWhere("$field $ope $value");
        }
        return $this;
    }
    public function order(string $column, $orderType = \OrderTypeEnum::DESC){
        if (!in_array($this->query->type, $this->blockType3)){
            throw new \QueryBuilderException("ORDER syntax not allowed to use for ".$this->query->type);
        }
        if (empty($column)){
            throw new \QueryBuilderException("Column cannot empty.");
        }
        $ot = $orderType;
        $this->query->addOrder("$column $orderType");
        return $this;
    }
    public function limit(int $start, int $offset=0){
        if (!in_array($this->query->type, $this->blockType3)){
            throw new \QueryBuilderException("LIMIT syntax not allowed to use for ".$this->query->type);
        }
        if (empty($start)){
            throw new \QueryBuilderException("Start cannot empty.");
        }
        $this->query->limit = " LIMIT $start , $offset";
        return $this;
    }
    public function query(){
        if ($this->query->type==\QueryTypeEnum::SELECT){
            $sqlStmt = $this->query->base;
            if (!empty($this->query->getWhere())){
                $sqlStmt .= " WHERE ".implode(' AND ',$this->query->where);
            }
            if (!empty($this->query->getOrder())){
                $sqlStmt .= " ORDER BY ".implode(', ',$this->query->order);
            }
            if (isset($this->query->limit)){
                $sqlStmt .= $this->query->limit;
            }
        }else if ($this->query->type==\QueryTypeEnum::INSERT){
            $sqlStmt = $this->query->base;
            $sqlStmt .= $this->query->getValues();
        }else if ($this->query->type==\QueryTypeEnum::UPDATE){
            $sqlStmt = $this->query->base;
            if (!empty($this->query->getWhere())){
                $sqlStmt .= " WHERE ".implode(' AND ',$this->query->where);
            }
        }else if ($this->query->type==\QueryTypeEnum::DELETE){
            $sqlStmt = $this->query->base;
            if (!empty($this->query->getWhere())){
                $sqlStmt .= " WHERE ".implode(' AND ',$this->query->where);
            }
        }
        return $sqlStmt .= ";";
    }
    private function isAssociativeArray(array $arr)
    {
        if (empty($arr)){ 
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}
