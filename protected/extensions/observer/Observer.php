<?php
/** 
 *接口：观察者 
 *@author li.yonghuan 
 *@version 2014.01.18 
 * 
 */
interface Observer {  
    /** 
     *更新 
     */  
    function update( Observable $observable );  
}
