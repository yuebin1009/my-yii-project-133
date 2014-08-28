<?php

class ObjectStructure 
{ 
    private $_elements = array(); 
    
    public function attach($element) 
    { 
        $this->_elements[] = $element; 
    } 
    
    public function detach($element) 
    { 
        if($key = array_search($element,$this->_elements) !== false) unset($this->_elements[$key]); 
    } 
    
    public function accept($visitor) 
    { 
        foreach($this->_elements as $element) 
        { 

            $element->accept($visitor); 
        } 
    } 
}
