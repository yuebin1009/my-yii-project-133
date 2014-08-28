<?php
/**
 * 外观类
 */
class Facade{


    public $object1;
    public $object2;
    public $object3;

    public function __construct(){
    
        $this->object1 = new SubSystem1;    
        $this->object2 = new SubSystem2;    
        $this->object3 = new SubSystem3;    
    
    }

    public function facade1(){
    
        $this->object1->getMessage(); 
        $this->object2->getMessage(); 
    }

    public function facade2(){
    
        $this->object2->getMessage(); 
        $this->object3->getMessage(); 
    }

}
