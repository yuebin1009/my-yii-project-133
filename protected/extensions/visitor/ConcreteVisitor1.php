<?php

class ConcreteVisitor1 extends Visitor
{
	public function visitCroncreteElementA($element)
	{
		echo get_class($element)." visit 1A<br/>";
	}
	public function visitCroncreteElementB($element)
	{
		echo get_class($element)." visit 1B<br/>";
	}
}
