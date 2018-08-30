<?php 

namespace framework\database;

/**
 * 数据库类
 */
class Database
{
	
	function __construct($config)
	{
		// 配置参数
		$dbms = $config['dbms'];
		$host = $config['host'];
		$user = $config['user'];
		$password = $config['password'];
		$dbname = $config['dbname'];
		$port = $config['port'];
		$charset = $config['charset'];
		$dsn = "$dbms:host=$host;post=$port;dbname=$dbname;charset=$charset";
		try{
			// 初始化PDO对象
			return new \PDO($dsn, $user, $password);
		} catch (PDOException $e){
			die ("Error!:" . $e -> getMessage() . '<br>');
		}
	}
}

 ?>