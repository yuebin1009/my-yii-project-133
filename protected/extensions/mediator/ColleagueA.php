<?php
/**
 * 具体同事类
 * 
 */
class ColleagueA extends Colleague 
{ 

    /*
    public function __construct($mediator){

        parent:: __construct($mediator);
    }
     */
    
    public function notify($message) 
    { 
        echo "ColleagueA Message is :".$message."<br/>"; 
    } 
} 
