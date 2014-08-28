<?php
/**
 *职责链一号
 *计算值是否为偶数
 */
class ChainOdd extends Chain{


    public function handleRequest($num){

        if($num%2 != 1){
            echo '此数为偶数 职责链停止<br/>';
        }else{

            echo 'odd<br/>';
            $this->chain->handleRequest($num);
        }
    }
}
