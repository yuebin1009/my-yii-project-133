<?php
/**
 * 手机品牌
 */
abstract class PhoneBrand{

    public $phoneSoft;
    public function setPhoneSoft($phoneSoft){

       $this->phoneSoft = $phoneSoft; 
    }
    
    public function run(){}
}
