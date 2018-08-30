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
		self::autoload();
		self::router();
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
		define('PUBLIC_PATH', APP_PATH . 'public' . DS);				// 资源文件目录
		define('UPLOADS_PATH', PUBLIC_PATH . 'uploads' . DS);			// 上传文件目录
		define('PUBLIC_BASE_PATH', PUBLIC_PATH . 'base' . DS);			// 基础资源文件目录
		// 获取请求地址
		$root = $_SERVER['SCRIPT_NAME'];
		$request = $_SERVER['REQUEST_URI'];
		// 获取访问参数
		$parameter = trim(str_replace($root, '', $request), '/');
		$URI = explode('/', $parameter);
		define('PALFORM', APP_PATH . (empty($URI[0])?'frontend':strtolower($URI[0])) . DS);
		define('CONTROLLER_PATH', PALFORM . 'controller' . DS);							// 控制器层目录
		define('MODEL_PATH', PALFORM . 'model' . DS);									// 模型层目录
		define('VIEW_PATH', PALFORM . 'view' . DS);										// 视图层目录
		// 定义当前访问控制器名及方法名
		define('CONTROLLER', isset($URI[1])?strtolower($URI[1]):'index');				// 当前访问控制器
		define('ACTION', isset($URI[2])?strtolower($URI[2]):'index');					// 当前访问方法
	}
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
	public static function load($classname)
	{
		if (substr($classname, -10) == 'Controller') {
			if (!is_file(CONTROLLER_PATH . (substr($classname, strripos($classname , DS)+1). '.php'))) {
				require PAGE_PATH . "404.html";
			}else{
				require CONTROLLER_PATH . (substr($classname, strripos($classname , DS)+1). '.php');
			}
		}elseif (substr($classname, -5) == 'Model') {
			require MODEL_PATH . "{$classname}.php";
		}else{
			// 其他情况
		}
	}
	/**
	 * 路由方法
	 */
	public static function router()
	{
		// 实例化类并调用方法
		$controller_name = ucfirst(CONTROLLER) . 'Controller';
		$class_map = 'app\frontend\controller\\' . $controller_name;
		// var_dump($class_map);
		$action_name = 'Action' . ucfirst(ACTION);
		$controller = new $class_map;
		$controller -> $action_name();
	}
}

 ?>