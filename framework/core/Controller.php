<?php 

namespace framework\core;

/**
 * 基础控制器类
 */
class Controller
{
	// 存储传递变量
	public $arr;
	/**
	 * 构造函数
	 */
	function __construct()
	{
		// 调用init()方法
		self::init();
	}
	public function init(){

	}
	/**
	 * 渲染视图
	 * @param  string $page 渲染目标页
	 */
	public function display($page = '')
	{
		// 判断是否传递变量
		if ($this -> arr) {
			// 将变量导入到当前的符号表
			extract($this -> arr);
		}
		// 判断是否传参
		if (empty($page)) {
			require VIEW_PATH . CONTROLLER . DS . ACTION . '.html';
		}else{
			require VIEW_PATH . CONTROLLER . DS . $page . '.html';
		}
	}
	/**
	 * 传递变量
	 * @param  string $name 变量名
	 * @param  [type] $statistics 传递变量
	 */
	public function assign($name, $statistics)
	{
		// 判断是否传参
		if ($name && $statistics) {
			$this -> arr = [$name => $statistics];
		}else{
			return 'error!';
		}
	}
}




 ?>