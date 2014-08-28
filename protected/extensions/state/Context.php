<?php
/**
 * 不同的环境改变不同的状态
 */
class Context{
	
	private $state = null;
	public function __construct($state){
		
		$this->setState($state);	
	}
	
	public function setState($state){
		$this->state = $state;
	}
	
	public function request(){
		
		$this->state->display();
		$this->state->handle($this);
	}
}