<?php
/**
 *请求者
 */
class Invoker{

    private $command;
    public function __construct($command){

        $this->command = $command;
    }

    /**
     *行动方法
     */
    public function action(){
        $this->command->execute();
    }
}
