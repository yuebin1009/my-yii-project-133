<?php
/** 
 *抽象类，登录观察者 
 *@author li.yonghuan 
 *@version 2014.01.18 
 * 
 */  
abstract class LoginObserver implements Observer {  
    /** 
     *Login 对象 
     *@var Login object 
     */  
    private $login;  
  
    /** 
     *构造方法 
     *@param $login Login object 
     */  
    public function __construct( Login $login ) {  
       $this->login = $login;   
       $login->attach( $this );  
    }  
  
    /** 
     *更新操作 
     *@param $observer Observer 
     */  
    public function update( Observable $observable ) {  
        if( $observable === $this->login ) {  
            $this->doUpdate( $observable );  
        }   
    }  
  
    /** 
     *执行更新 
     *@param login Login 
     */  
    abstract function doUpdate( Login $login );  
  
}  
