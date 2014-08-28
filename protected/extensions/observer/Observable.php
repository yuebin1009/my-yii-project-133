<?php 
/**
 * 主题功能
 */
interface Observable{
	
	/**
	 * 添加观察者
	 */
	function attach (Observer $observer);
	
	/**
	 * 删除观察者
	 */
	function detach (Observer $observer);
	
	/**
	 * 通知观察者
	 */
	function notify ();
}
