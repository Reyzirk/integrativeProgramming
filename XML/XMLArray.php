<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of XMLArray
 *
 * @author Choo Meng
 */
class XMLArray implements Iterator, Serializable, Countable, ArrayAccess {
    private $objectList = array();
    private $currentCounter = 0;
    private $count = 0;
    
    public function __construct($objectList = NULL, $arrayAdd = false){
        if ($objectList != NULL){
            if ($arrayAdd){
                $this->addArray($objectList);
            }else{
                $this->add($objectList);
            }
        }
    }
    
    public function add($object){
        $this->objectList[] = $object;
        $this->count++;
    }
    
    public function addArray($objectList){
        if (is_array($objectList)){
            foreach ($objectList as $key){
                $this->add($key);
            }
        }
    }
    
    public function clear(){
        $this->objectList = array();
        $this->currentObject = NULL;
        $this->currentCounter = 0;
        $this->count = 0;
    }
    
    public function contains($object){
        for ($i = 0; $i < $this->count; $i++){
            if ($this->objectList[$i]==$object){
                return true;
            }else{
                return false;
            }
        }
    }
    
    public function current() {
        return $this->objectList[$this->currentCounter];
    }

    public function key(): int {
        return $this->currentCounter;
    }

    public function next() {
        if ($this->valid()){
            return $this->objectList[$this->currentCounter++];
        }else{
            return false;
        }
    }
    
    public function remove($offset = -1){
        if ($offset==-1){
            array_splice($this->objectList,$this->currentCounter);
            $this->count--;
        }else{
            if ($offset >= $this->count){
                return;
            }else{
                array_splice($this->objectList,$this->currentCounter);
                $this->count--;
                if ($this->currentCounter>=$this->count){
                    $this->currentCounter--;
                }
            }
        }
    }

    public function rewind(): void {
        $this->currentCounter = 0;
    }

    public function valid(): bool {
        return $this->currentCounter < $this->count;
    }

    public function count(): int {
        return $this->count;
    }

    public function serialize(): string {
        return serialize($this->objectList);
    }

    public function unserialize($serialized): void {
        $this->objectList = $serialized;
    }

    public function offsetExists($offset): bool {
        $object = $this->objectList[$offset];
        return isset($object);
    }

    public function offsetGet($offset) {
        if ($this->offsetExists($offset)){
            return $this->objectList[$offset];
        }else{
            return NULL;
        }
    }

    public function offsetSet($offset, $value): void {
        if(!is_null($offset)){
            $this->objectList[$offset] = $value;
        }else{
            $this->add($value);
        }
    }

    public function offsetUnset($offset): void {
        array_splice($this->objectList,$offset);
        $this->count--;
    }

}