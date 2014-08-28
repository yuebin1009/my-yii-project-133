<?php
/**
 * 访问者模式
 */
abstract class Visitor
{
	abstract public function visitCroncreteElementA($element);
	abstract public function visitCroncreteElementB($element);
}
