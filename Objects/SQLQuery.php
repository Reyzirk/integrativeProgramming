<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Query
 *
 * @author Choo Meng
 */
class SQLQuery {
    private $base;
    private $type;
    private $values = array();
    private $andwhere = array();
    private $orwhere = array();
    private $where = array();
    private $order = array();
    private $groupby;
    private $join = array();
    private $limit;
    public function addJoin($join){
        $this->join[] = $join;
    }
    public function addValues($values){
        $this->values[] = $values;
    }
    public function addWhere ($where){
        $this->where[] = $where;
    }
    public function addAndWhere ($andwhere){
        $this->andwhere[] = $andwhere;
    }
     public function addOrWhere ($orwhere){
        $this->orwhere[] = $orwhere;
    }
    public function addOrder ($order){
        $this->order[] = $order;
    }
    public function getJoin(){
        return $this->join;
    }
    public function getValues(){
        return $this->values;
    }
    public function getAndWhere(){
        return $this->andwhere;
    }
    public function getOrWhere(){
        return $this->orwhere;
    }
    public function getWhere(){
        return $this->where;
    }
    public function getOrder(){
        return $this->order;
    }
     public function getLimit(){
        return $this->limit;
    }
    public function setAndWhere($andwhere){
        $this->andwhere = $andwhere;
    }
    public function setOrWhere($orwhere){
        $this->orwhere = $orwhere;
    }
    public function __get($name) {
        if (property_exists($this, $name)){
            return $this->$name;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
    public function __set($name, $value) {
        if (property_exists($this, $name)){
            $this->$name = $value;
        }else{
            trigger_error("Property $name doesn't exists", E_USER_ERROR);
        }
    }
    
}
