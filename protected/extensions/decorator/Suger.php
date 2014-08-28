<?php
/**
 * 牛奶类
 */
class Suger extends CoffeeDecorator{
	
	public $menu;
	public function __construct($menu){
    
		$this->name = '糖块';

		if($menu instanceof Menu){
			
			$this->menu = $menu;

        }
	}
	
	public function cost(){
        
        echo $this->name;		
		return $this->menu->cost() + 3;
	}
	
}
