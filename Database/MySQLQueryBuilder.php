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
    public function update($table, $data = array()){
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
            $val = "$col = '$value'";
            $this->query->base .= str_replace("'".\CustomSQLEnum::BIND_QUESTIONMARK."'", "?", $val);
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
        $value = "VALUES ('".implode(", ",$values)."')";
        $this->query->addValues(str_replace("'".\CustomSQLEnum::BIND_QUESTIONMARK."'", "?", $value));
        return $this;
    }
    public function bracketWhere($type = \WhereTypeEnum::AND){
        $where = "(";
        if ($type == \WhereTypeEnum::AND){
            if (empty($this->query->getAndWhere())){
                throw new \QueryBuilderException("No WHERE data. ");
            }
            $where .= implode(' AND ',$this->query->getAndWhere());
            $this->query->setAndWhere(array());
        }else{
            if (empty($this->query->getOrWhere())){
                throw new \QueryBuilderException("No WHERE data. ");
            }
            $where .= implode(' OR ',$this->query->getOrWhere());
            $this->query->setOrWhere(array());
        }
        $where .= ")";
        $this->query->addWhere($where);
        return $this;
    }
    public function join($table,$leftOn, $rightOn, $type = \JoinTypeEnum::NONE){
        if (!in_array($this->query->type, $this->blockType3)){
            throw new \QueryBuilderException("ORDER syntax not allowed to use for ".$this->query->type);
        }
        if (empty($table)){
            throw new \QueryBuilderException("Table cannot empty.");
        }
        if (empty($leftOn)){
            throw new \QueryBuilderException("Left side on cannot empty.");
        }
        if (empty($rightOn)){
            throw new \QueryBuilderException("Right side on cannot empty.");
        }
        if ($type==\JoinTypeEnum::LEFT){
            $this->query->addJoin(" LEFT JOIN ".$table." ON $leftOn = $rightOn");
        }else if ($type==\JoinTypeEnum::RIGHT){
            $this->query->addJoin(" RIGHT JOIN ".$table." ON $leftOn = $rightOn");
        }else{
            $this->query->addJoin(" JOIN ".$table." ON $leftOn = $rightOn");
        }
        return $this;
    }
    public function where($field, $value, $type= \WhereTypeEnum::AND, $operator = \OperatorEnum::EQUAL, $singlequote = true, $otheroperator = ""){
        if (!in_array($this->query->type, $this->blockType1)){
            throw new \QueryBuilderException("WHERE syntax not allowed to use for ".$this->query->type);
        }
        if (empty($field)){
            throw new \QueryBuilderException("Field cannot empty.");
        }
        if ($value==NULL){
            $value = "";
        }
        $startquote = $singlequote?"'":"";
        $endquote = $singlequote?"'":"";
        $value = $startquote.$value.$endquote;
        $value = str_replace("'".\CustomSQLEnum::BIND_QUESTIONMARK."'", "?", $value);
        $value = str_replace(\CustomSQLEnum::BIND_QUESTIONMARK, "?", $value);
        if ($operator == \OperatorEnum::OTHERS){
            
            if ($type == \WhereTypeEnum::AND){
                $this->query->addAndWhere("$field $otheroperator $value");
            }else{
                $this->query->addOrWhere("$field $otheroperator $value");
            }
        }else{
            $ope = $operator;
            if ($type == \WhereTypeEnum::AND){
                $this->query->addAndWhere("$field $ope $value");
            }else{
                $this->query->addOrWhere("$field $ope $value");
            }
        }
        return $this;
    }
    public function groupby($column){
        if (!in_array($this->query->type, $this->blockType3)){
            throw new \QueryBuilderException("ORDER syntax not allowed to use for ".$this->query->type);
        }
        if (empty($column)){
            throw new \QueryBuilderException("Column cannot empty.");
        }
        if (!is_array($column)){
            throw new \QueryBuilderException("Column must in array type.");
        }
        $this->query->groupby = "GROUP BY ".implode(', ',$column);
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
        $this->query->limit = " LIMIT $start , $offset";
        return $this;
    }
    public function query(){
        if ($this->query->type==\QueryTypeEnum::SELECT){
            $sqlStmt = $this->query->base;
            if (!empty($this->query->getJoin())){
                $sqlStmt .= implode('',$this->query->getJoin());;
            }
            if (!empty($this->query->getWhere())){
                $sqlStmt .= $this->retrieveWhere();
            }
            if (!empty($this->query->getOrder())){
                $sqlStmt .= " ORDER BY ".implode(', ',$this->query->order);
            }
            if (!empty($this->query->getLimit())){
                $sqlStmt .= $this->query->getLimit();
            }
            if (!empty($this->query->groupby)){
                $sqlStmt .= $this->query->groupby;
            }
        }else if ($this->query->type==\QueryTypeEnum::INSERT){
            $sqlStmt = $this->query->base;
            $sqlStmt .= $this->query->getValues();
        }else if ($this->query->type==\QueryTypeEnum::UPDATE){
            $sqlStmt = $this->query->base;
            if (!empty($this->query->getWhere())){
                $sqlStmt .= $this->retrieveWhere();
            }
        }else if ($this->query->type==\QueryTypeEnum::DELETE){
            $sqlStmt = $this->query->base;
            if (!empty($this->query->getWhere())){
                $sqlStmt .= $this->retrieveWhere();
            }
        }
        return $sqlStmt .= ";";
    }
    private function retrieveWhere(){
        $where = " WHERE ";
        if (!empty($this->query->getAndWhere())){
            $where .= implode(' AND ',$this->query->getAndWhere());
            if (!empty($this->query->getWhere())){
                $where .= " AND ";
            }
            
        }else if (!empty($this->query->getOrWhere())){
            $where .= implode(' OR ',$this->query->getOrWhere());
            if (!empty($this->query->getWhere())){
                $where .= " AND ";
            }
        }
        $where .= implode(' AND ',$this->query->getWhere());
        return $where;
    }
    private function isAssociativeArray(array $arr)
    {
        if (empty($arr)){ 
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}
