<?php
/**
 *具体命令
 */
class ConcreteCommand implements Command{

    private $receiver;
    public function __construct($receiver){

        $this->receiver = $receiver;
    }
    public function execute(){
        
        $this->receiver->action();
    }
}
