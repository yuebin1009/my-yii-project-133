<?php
/**
 * 手机游戏
 */
class PhoneGame extends PhoneSoft{

    public $name;
    public function __construct($name){

        $this->name = $name;
    
    }
 
    public function run(){
    
        echo '运行'.$this->name.'平台手机游戏';
    }
}
