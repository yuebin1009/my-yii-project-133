<?php
/**
 * 咖啡类
 */
class Coffee extends Menu{
	
	public function __construct(){
		
		$this->name = '咖啡';
	}
	
	public function cost(){
		
        echo $this->name;		
		return 2;
	}
	
}
