<?php
/**
 *具体粘贴命令角色
 */
class PasteCommand implements Command{ 

    private $receiver;
    public function __construct(Receiver $receiver){

        $this->receiver = $receiver;
    }
    public function execute(){
        
        $this->receiver->paste();
    }

}
