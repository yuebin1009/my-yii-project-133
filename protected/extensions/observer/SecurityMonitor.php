<?php
/** 
 *安全监控登录，负责登录安全的观察者 
 *@author li.yonghuan 
 *@version 2014.01.18 
 */  
class SecurityMonitor extends LoginObserver {  
    /** 
     *执行更新 
     *@param $login Login 
     */  
    public function doUpdate( Login $login ) {  
     
        $status = $login->getStatus();   
        if( $status[0] == Login::LOGIN_WRONG_PASS ) {  
            //发送邮件给系统管理员  
            print __CLASS__.":\tsending mail to sysadmin";   
        }  
    }  
}  
