<?php
/**
 *接受者
 */
class Receiver{

    private $name;
    public function __construct($name){

        $this->name = $name;
    }

    /**
     *行动方法
     */
    public function action(){
    
        echo $this->name.'do action';
    }

    public function copy(){
    
        echo $this->name.'--复制';
    }

    public function paste(){
    
        echo $this->name.'--粘贴';
    }


}
