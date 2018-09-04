<?php 

namespace framework\libraries;

/**
 * 路由类
 */
class Router
{

	public $url;
	/**
	 * 构造方法
	 * @param string $type 路由解析类型
	 */
	function __construct($type)
	{
		// 判断url类型
		switch ($type) {
			case '0':
				$url = $this->baseUrl();
				break;
			case '1':
				$url = $this->pathInfoUrl();
				break;
			case '2':
				$url = $this->rewriteUrl();
				break;
			default:
				# code...
				break;
		}
	}
	/**
	 * 普通url解析方法
	 */
	protected function baseUrl()
	{
		$this->url['p'] = isset($_GET['p'])?$_GET['p']:'frontend';
		$this->url['c'] = isset($_GET['c'])?strtolower($_GET['c']):'Index';
		$this->url['a'] = isset($_GET['a'])?strtolower($_GET['a']):'Index';
	}
	/**
	 * pathInfo解析方法
	 */
	protected function pathInfoUrl()
	{
		$root = $_SERVER['SCRIPT_NAME'];
		$request = $_SERVER['REQUEST_URI'];
		$parameter = trim(str_replace($root, '', $request), '/');
		// 去掉非路径参数
		$parameter = substr($parameter, 0, strpos($parameter, '?'));
		if (!empty($parameter)) {
			$URI = explode('/', $parameter);
		}
		$this->url['p'] = isset($URI['0'])?$URI['0']:'frontend';
		$this->url['c'] = isset($URI['1'])?strtolower($URI['1']):'Index';
		$this->url['a'] = isset($URI['2'])?strtolower($URI['2']):'Index';
	}
	/**
	 * rewrite解析方法
	 */
	protected function rewriteUrl()
	{
		$root = $_SERVER['SCRIPT_NAME'];
		$request = $_SERVER['REQUEST_URI'];
		$parameter = trim(str_replace($root, '', $request), '/');

		if (!empty($parameter)) {
			$URI = explode('/', $parameter);

			// 判断是否有非路径参数
			if (count($URI)>3) {
				$data = $URI;
				// 这里写三个shift()，而不用unset()是为了保证下标从0开始。
				array_shift($data);
				array_shift($data);
				array_shift($data);
				// 赋值
				for ($i=0; $i < count($data)-1; $i++) { 
					$_REQUEST[$data[$i]] = $data[$i+1];
					$_GET[$data[$i]] = $data[$i+1];
				}
			}
		}
		$this->url['p'] = isset($URI['0'])?$URI['0']:'frontend';
		$this->url['c'] = isset($URI['1'])?strtolower($URI['1']):'Index';
		$this->url['a'] = isset($URI['2'])?strtolower($URI['2']):'Index';
	}
	/**
	 * 外部调用加载方法
	 */
	public function toload()
	{
		self::autoload();
		self::router();
	}
	/**
	 * 注册自动加载
	 */
	protected static function autoload()
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
	/**
	 * 路由方法
	 */
	protected static function router()
	{
		// 实例化类并调用方法
		$controller_name = ucfirst(CONTROLLER) . 'Controller';
		$class_map = 'app\\'.trim(PALFORM, DS).'\\controller\\' . $controller_name;
		$action_name = 'Action' . ucfirst(ACTION);
		$controller = new $class_map;
		$controller -> $action_name();
	}
}



 ?>