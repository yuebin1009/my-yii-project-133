<?php
/**
 * 状态类A
 */
class StateA implements State{
	
	public function handle($context)
	{
		$context->setState(new StateB());
	}
	public function display()
	{
		echo "state A<br/>";
	}	
	
}