<?php
/**
 *宏命令接口
 */
interface MacroCommand extends Command{


    /**
     *添加命令
     */
    public function add(Command $command);

    /**
     *删除命令
     */
    public function remove(Command $command);

}
