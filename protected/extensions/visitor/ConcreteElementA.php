<?php
class ConcreteElementA extends Element 
{ 
    public function accept($visitor) 
    { 
        $visitor->visitCroncreteElementA($this); 
    } 
} 
