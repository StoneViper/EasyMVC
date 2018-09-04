<?php 

namespace framework\core;

class Framework
{
	/**
	 * 运行框架
	 */
	public static function run()
	{
		self::init();
	}
	/**
	 * 初始化
	 */
	public static function init()
	{
		// 定义目录目录
		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT', getcwd() . DS);									// 分隔符
		define('APP_PATH', ROOT . 'application' . DS);					// 根目录
		define('FRAMEWORK_PATH', ROOT . 'framework' . DS);				// 程序目录
		define('CONFIG_PATH', APP_PATH . 'config' . DS);				// 配置文件目录
		define('CORE_PATH', FRAMEWORK_PATH . 'core' . DS);				// 核心框架目录
		define('PAGE_PATH', FRAMEWORK_PATH . 'page' . DS);				// 静态页目录
		define('DB_PATH', FRAMEWORK_PATH . 'database' . DS);			// 数据库类目录
		define('HELPER_PATH', FRAMEWORK_PATH . 'helper' . DS);			// 辅助函数目录
		define('LIB_PATH', FRAMEWORK_PATH . 'libraries' . DS);			// 工具类目录
		define('PUBLIC_PATH', APP_PATH . 'public' . DS);				// 资源文件目录
		define('UPLOADS_PATH', PUBLIC_PATH . 'uploads' . DS);			// 上传文件目录
		define('PUBLIC_BASE_PATH', PUBLIC_PATH . 'base' . DS);			// 基础资源文件目录

		// 引入路由类
		require LIB_PATH . 'Router.php';
		$router_type =  require CONFIG_PATH . 'router.php';
		// 实例化路由器
		$router = new \framework\libraries\Router($router_type['router']['type']);
		// 获取路由参数
		$url = $router -> url;
		// 定义相关常量
		define('PALFORM', $url['p'] . DS);									// 定义当前访问模块
		define('PALFORM_PATH', APP_PATH . $url['p'] . DS);					// 定义当前访问模块目录
		define('CONTROLLER_PATH', PALFORM_PATH . 'controller' . DS);		// 控制器层目录
		define('MODEL_PATH', PALFORM_PATH . 'model' . DS);					// 模型层目录
		define('VIEW_PATH', PALFORM_PATH . 'view' . DS);					// 视图层目录

		define('CONTROLLER', $url['c']);									// 当前访问控制器
		define('ACTION', $url['a']);										// 当前访问方法
		define('CUR_VIEW_PATH', VIEW_PATH . CONTROLLER . DS);				// 当前访问视图

		// 引入配置文件
		$GLOBALS['config'] =  require CONFIG_PATH . 'config.php';

		// 引入基础文件
		require CORE_PATH . 'Controller.php';		// 基础控制器类
		require DB_PATH . 'Database.php';			// 数据库类
		require CORE_PATH . 'Model.php';			// 基础模型类
		require LIB_PATH . 'Smarty.php';			// Smarty类
		require LIB_PATH . 'CatchError.php';		// 异常处理类
		require LIB_PATH . 'Memcached.php';			// Mem缓存类
		require CORE_PATH . 'View.php';				// 基础视图类
		// 调用异常处理类
		\framework\libraries\CatchError::start();
		
		// 调用路由方法
		$router -> toload();
	}

}

 ?>