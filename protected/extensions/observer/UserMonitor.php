<?php
/** 
 *用户名错误，观察者 
 *@author li.yonghuan 
 *@version 2014.01.18 
 */  
class UserMonitor extends LoginObserver {  
   /** 
    *观察者更新 
    * 
    */   
    public function doUpdate( Login $login ) {  
        $status = $login->getStatus();   
       if( $status[0] == Login::LOGIN_USER_UNKNOWN ) {  
           //用户名错误  
           print __CLASS__.":\tusername is uncorrect";   
       }         
    }  
}   