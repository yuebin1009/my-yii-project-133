<?php
/** 
 *正确登录，观察者 
 *@author li.yonghuan 
 *@version 2014.01.18 
 */  
class GeneralLogger extends LoginObserver {  
   /** 
    *观察者更新 
    * 
    */   
    public function doUpdate( Login $login ) {  
        $status = $login->getStatus();   
       if( $status[0] == Login::LOGIN_ACCESS ) {  
           //记录登录数据到日志  
           print __CLASS__.":\tadd login data to log";   
       }         
    }  
}  
