<?php
/**
 *模版模式基类
 */
abstract class Template{

    public function templateA(){}

    public function templateB(){}

    public function getTemplate(){
        
        $this->templateA();
        $this->templateB();
    
    }
}
