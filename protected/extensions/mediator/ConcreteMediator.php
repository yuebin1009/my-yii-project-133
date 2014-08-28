<?php
/**
 * 具体中介者
 */
class ConcreteMediator extends Mediator{
	
	private $colleagueA;
	private $colleagueB;
	
	public function send($message, $colleague){
		
		if($colleague == $this->colleagueA){
			
			$this->colleagueA->notify($message);
		}else{
			$this->colleagueB->notify($message);
			
		}
		
		
	}
	
	public function set($colleagueA, $colleagueB){
		$this->colleagueA = $colleagueA;
		$this->colleagueB = $colleagueB;
	}
}