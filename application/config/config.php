<?php 
return [
	// 数据库配置信息
	'db' => [
		'dbms' => 'mysql',		//数据库类型
		'host' => '127.0.0.1',		// 地址
		'user' => 'root',		// 用户名
		'password' => '0503',	// 密码
		'dbname' => 'test',		// 数据库名
		'port' => '3306',		// 端口号
		'prefix' => '',		// 表前缀
		'charset' => 'utf8',	// 字符编码
	],
	// 视图配置信息
	'view' => [
		'debugging' => 'false',		// 开启Debug
		'left_delimiter' => '{',	// 左定界符
		'right_delimiter' => '}',	// 右定界符
		'template_dir' => CUR_VIEW_PATH,		// 模板目录
		'compile_dir' => CUR_VIEW_PATH . DS . 'compile',		// 编译文件目录
	],
];