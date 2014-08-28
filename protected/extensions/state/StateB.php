<?php
/**
 * 状态类B
 */
class StateB implements State{
	
	public function handle($context)
	{
		$context->setState(new StateC());
	}
	public function display()
	{
		echo "state B<br/>";
	}	
}