<?php
/**
 * 原型具体实现类
 */
class ConcretePrototype implements Prototype{

    private $name;

    public function __construct($name){
    
        $this->name = $name;
    }

    public function getName(){
    
        return $this->name;
    }
    public function setName($name){
    
        $this->name = $name;
    }
    
    /**
     * 浅拷贝
     */
    public function shallowCopy(){
    
        return clone $this;
    }

    /**
     * 深拷贝
     */
    public function deepCopy(){
        $serialize = serialize($this);
        $cloneObj = unserialize($serialize);
        return $cloneObj;
    }
}
