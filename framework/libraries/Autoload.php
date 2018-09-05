<?php 

namespace framework\libraries;

/**
 * 自动加载类
 */
class Autoload
{
	/**
	 * 注册自动加载
	 */
	public static function autoload()
	{
		spl_autoload_register(array(__CLASS__, "load"));
	}
	/**
	 * 加载方法
	 * @param  string $classname 类名
	 */
	protected static function load($classname)
	{
		if (substr($classname, -10) == 'Controller') {
			if (!is_file(CONTROLLER_PATH . (substr($classname, strripos($classname , DS)+1). '.php'))) {
				require PAGE_PATH . "404.html";
			}else{
				require CONTROLLER_PATH . (substr($classname, strripos($classname , DS)+1) . '.php');
			}
		}elseif (substr($classname, -5) == 'Model') {
			require MODEL_PATH . (substr($classname, strripos($classname , DS)+1) . '.php');
		}else{
			// 其他情况
		}
	}
}
