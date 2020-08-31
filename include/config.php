<?php
/**
* @author yubing.zhu
* 系统配置文件
*/

/**
 * 定义系统根目录,请不要在这里加自定义函数
 */
!defined('SYS_PATH') && define('SYS_PATH',realpath(dirname(__FILE__).'/../').'/');
include(SYS_PATH.'include/pool.php');
include(SYS_PATH.'vendor/autoload.php');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

/**
 * 自动加载对象
 * 如果有libaray下面还有目录，用_分开，类名前面加目录名用_分开
 */
spl_autoload_register(function($class){
	$fn = SYS_PATH. 'include/'. str_replace('_','/',$class).'.php';
	if(is_file($fn)){
		include($fn);
	}
});
define('CDN','../static');//静态cdn
/**
 * 配置参数监护器
 *
 * @package library
 */
class config
{
	 //对称加密串
	const KEY="i5%e()|',\\"; 
	//PDO链接参数
	static  $web = array (
		'dsn'=>'mysql:host=localhost;port=3306;dbname=coolphp',
		'user'=>'root',
		'pass'=>'',
		'options'=>array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"',
		    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
	      	PDO::ATTR_TIMEOUT => 5,
		),
	);
}

