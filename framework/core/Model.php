<?php 

namespace framework\core;

use framework\database\Database;

/**
 * 基础模型类
 */
class Model
{
	public $db;		// 数据库对象
	/**
	 * 构造函数
	 */
	function __construct($table)
	{
		// 存储配置信息
		$config['dbms'] = $GLOBALS['config']['db']['dbms'];
		$config['host'] = $GLOBALS['config']['db']['host'];
		$config['user'] = $GLOBALS['config']['db']['user'];
		$config['password'] = $GLOBALS['config']['db']['password'];
		$config['dbname'] = $GLOBALS['config']['db']['dbname'];
		$config['port'] = $GLOBALS['config']['db']['port'];
		$config['prefix'] = $GLOBALS['config']['db']['prefix'];
		$config['charset'] = $GLOBALS['config']['db']['charset'];
		$config['table'] = $table;
		// 实例化数据库类
		$this -> db = new Database($config);
		$this -> init();
	}
	public function init()
	{

	}
}
