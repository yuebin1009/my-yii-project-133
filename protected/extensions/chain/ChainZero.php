<?php
/**
 *职责链一号
 *计算值是否为0
 */
class ChainZero extends Chain{


    public function handleRequest($num){

        if($num == 0){
            echo '此数为0 职责链停止<br/>';
        }else{
            echo 'zero<br/>';
            $this->chain->handleRequest($num);
        }
    }
}
