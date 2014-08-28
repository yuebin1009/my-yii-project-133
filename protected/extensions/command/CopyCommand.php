<?php
/**
 *具体拷贝命令角色
 */
class CopyCommand implements Command{ 

    private $receiver;
    public function __construct(Receiver $receiver){

        $this->receiver = $receiver;
    }
    public function execute(){
        
        $this->receiver->copy();
    }

}
