<?php
/**
 * 具体同事类
 * 
 */
class ColleagueB extends Colleague 
{ 
    public function notify($message) 
    { 
        echo "ColleagueB Message is :".$message."<br/>"; 
    } 
} 
