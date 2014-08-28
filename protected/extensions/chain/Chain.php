<?php
/**
 *职责链抽象类
 */
abstract class Chain{

    public $chain;
    public function setChain($chain){

        $this->chain = $chain;
    }

    public function handleRequest($request){}
}
