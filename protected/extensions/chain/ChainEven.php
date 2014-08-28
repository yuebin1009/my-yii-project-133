<?php
/**
 *职责链一号
 *计算值是否为奇数
 */
class ChainEven extends Chain{


    public function handleRequest($num){

        if($num%2 == 1){
            echo '此数为奇数 职责链停止<br/>';
        }else{
            echo 'even<br/>';
            $this->chain->handleRequest($num);
        }
    }
}
