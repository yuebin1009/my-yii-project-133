<?php
/**
 *宏命令
 */
class DemoMacroCommand implements MacroCommand{

    /**
     *成员命令列表
     *@param array
     */
    private $commandList;

    public function __construct(){
    
        $this->commandList = array();
    }

    /**
     *添加成员命令
     *@param $command Command
     */
    public function add(Command $command){

        return array_push($this->commandList,$command);
    }

    /**
     *删除成员命令
     *@param $command Command
     */
    public function remove(Command $command){
        
        $key = array_search($command, $this->commandList);
        if($key === false){
            
            return false;
        }

        unset($this->commandList[$key]);
        return true;
    }

    /**
     *执行请求
     */
    public function execute(){
    
        foreach($this->commandList as $command){
        
            $command->execute();
        }
    }

}
