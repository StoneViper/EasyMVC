<?php 

namespace framework\core;

/**
 * 视图基础类
 */
class View
{
	public $smarty;		// Smarty类

	/**
	 * 构造函数
	 */
	public function __construct()
	{
		// 实例化Smarty类
		$this -> smarty = new \Smarty;
		$config = $GLOBALS['config']['view'];
		// 调用config函数
		$this -> config($config);
		// var_dump($this->smarty);
	}
	/**
	 * 配置方法
	 * @param  array $config 配置信息
	 */
	function config($config)
	{
		foreach ($config as $k => $v) {
			if ($v == '') {
				continue;
			}
			$this -> smarty -> $k = $v;
		}
	}
}





 ?>