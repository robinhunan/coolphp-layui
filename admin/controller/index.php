<?php
/**
*  管理系统首页
* @author:
*/
class c_index{

	function clearCache(){
		msg::json(1);
	}

	function index(){
		$manager = new manager();
		$info = $manager->getLoginInfo();
		include APP_PATH.("view/index/index.php");
	}
}
