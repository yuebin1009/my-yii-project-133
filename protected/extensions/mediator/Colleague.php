<?php
/**
 * 同事基类
 * 用于同事之间发送信息
 */
abstract class Colleague{
	
	public $mediator;
	public function Colleague($mediator){
		
		$this->mediator = $mediator;
    }
	
	public function send($message){
		
		$this->mediator->send($message,$this);
	}
	
	public function notify($message){}
}
