<?php
/**
 * 手机通讯录
 */
class PhoneList extends PhoneSoft{

    public $name;
    public function __construct($name){

        $this->name = $name;
    
    }
 
    public function run(){
    
        echo '运行'.$this->name.'手机通讯录';
    }
}
