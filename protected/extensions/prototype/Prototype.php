<?php
/**
 * 原型模式基类
 */
interface Prototype{



    // DO : 深拷贝
    public function deepCopy();

    // DO : 浅拷贝
    public function shallowCopy();
}
