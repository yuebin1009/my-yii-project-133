<?php
/**
 * 状态类C
 */
class StateC implements State{
	
	public function handle($context)
	{
		$context->setState(new StateA());
	}
	public function display()
	{
		echo "state C<br/>";
	}	
}
