<?php 
/**
 * 状态接口基类
 */
interface State{
	
	public function handle($state);
	
	public function display();
}
