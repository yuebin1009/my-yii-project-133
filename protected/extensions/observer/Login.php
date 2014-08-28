<?php 
/**
 * 主体类
 * 被观察者
 */
class Login implements Observable{

    /**
     *密码错误状态
     */
    const LOGIN_ACCESS = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_USER_UNKNOWN = 3;

    /**
     *登录时的状态
     *
     */
    private $loginstatus;

    /**
     *观察者列表
     *@var array
     */
    private $observers;

    /**
     *构造方法
     *
     */
    public function __construct(){
        $this->observers = array();
    }

    /**
     *添加观察者
     *@param $observer Observer object
     */
    public function attach( Observer $observer ){
        $this->observers[] = $observer;
    }

    /**
     *删除观察者
     *@param $observer Observer object
     */
    public function detach( Observer $observer ){
        $newobservers = array();
        foreach( $this->observers as $obs ){
            if( $obs != $observer ){
                $newobservers[] = $observer;
            }
        }
        $this->observers = $newobservers;
    }

    /**
     *通知观察者
     *
     */
    public function notify(){
        foreach( $this->observers as $obs ){
            $obs->update( $this );
        }
    }

    /**
     *处理登录
     *@param $user string 用户名
     *@param $pass string 密码
     *@param $ip string IP地址
     */
    public function handleLogin( $user='li.yonghuan', $pass='123456', $ip='127.0.0.1' ) {
        switch( rand(1,3) ) {
        case 1:
            $this->setStatus( self::LOGIN_ACCESS, $user, $ip );
            $ret = true;
            break;
        case 2:
            $this->setStatus( self::LOGIN_WRONG_PASS, $user, $ip );
            $ret = false;
            break;
        case 3:
            $this->setStatus( self::LOGIN_USER_UNKNOWN, $user, $ip );
            $ret = false;
            break;
        }
        $this->notify();
        return $ret;
    }

    /**
     *设置状态值
     *@param $status string 状态值
     *@param $user string 用户名
     *@param $ip string IP地址
     */
    public function setStatus( $status, $user, $ip ) {
        $this->loginstatus = array( $status, $user, $ip );
    }


    /**
     *获取状态
     *登录时产生的各种状态
     */
    public function getStatus() {

        return $this->loginstatus;
    }

}
