<?php

class ConcreteVisitor2 extends Visitor 
{ 
    public function visitCroncreteElementA($element) 
    { 
        echo get_class($element)." visit 2A<br/>"; 
    } 
    public function visitCroncreteElementB($element) 
    { 
        echo get_class($element)." visit 2B<br/>"; 
    }
} 
