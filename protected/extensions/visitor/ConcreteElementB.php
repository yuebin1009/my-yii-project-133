<?php
class ConcreteElementB extends Element 
{ 
    public function accept($visitor) 
    { 
        $visitor->visitCroncreteElementB($this); 
    } 
} 
