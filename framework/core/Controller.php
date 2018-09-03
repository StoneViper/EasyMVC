<?php 

namespace framework\core;

use framework\core\View;
/**
 * 基础控制器类
 */
class Controller
{
	protected $smarty;		// Smarty对象
	/**
	 * 构造函数
	 */
	function __construct()
	{
		$view = new View;
		$this -> smarty = $view->smarty;
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
		// 判断是否传参
		if (empty($page)) {
			$this->smarty->display(ACTION.'.html');
		}else{
			$this->smarty->display($page.'.html');
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
			$this->smarty->assign($name, $statistics);
		}else{
			return 'error!';
		}
	}
}




 ?>