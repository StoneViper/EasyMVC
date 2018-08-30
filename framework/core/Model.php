<?php 

namespace framework\core;

use framework\database\Database;

/**
 * 基础模型类
 */
class Model
{
	public $pdo;		// 数据库对象
	private $config;	// 数据库配置
	private $table;		// 表名
	/**
	 * 构造函数
	 */
	function __construct($table)
	{
		// 存储变量名
		$this -> table = $table;
		// 存储配置信息
		$config['dbms'] = $GLOBALS['dbconfig']['dbms'];
		$config['host'] = $GLOBALS['dbconfig']['host'];
		$config['user'] = $GLOBALS['dbconfig']['user'];
		$config['password'] = $GLOBALS['dbconfig']['password'];
		$config['dbname'] = $GLOBALS['dbconfig']['dbname'];
		$config['port'] = $GLOBALS['dbconfig']['port'];
		$config['prefix'] = $GLOBALS['dbconfig']['prefix'];
		$config['charset'] = $GLOBALS['dbconfig']['charset'];
		// 实例化数据库类
		$this -> pdo = new Database($config);
		$this -> init();
	}
	public function init()
	{

	}


}




 ?>