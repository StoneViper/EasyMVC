<?php 

namespace framework\libraries;

/**
 * 异常处理
 */
class CatchError
{
	/**
	 * 开启异常处理
	 */
	public static function start()
	{
		
		set_error_handler([__CLASS__,'baseError']);
		register_shutdown_function([__CLASS__,'shutDownFun']);
		// set_exception_handler()方法暂时搁置
	}
	/**
	 * 通知错误&警告错误
	 * @param  string $type    [错误类型]
	 * @param  string $message [提示信息]
	 * @param  string $file    [出错文件]
	 * @param  string $line    [出错行数]
	 */
	public static function baseError($type, $message, $file, $line)
	{
		self::printError($type, $message, $file, $line);
	}
	/**
	 * 捕获PHP错误
	 */
	public static function shutDownFun()
	{
		// 判断是否有错误
		if ($error = error_get_last()) {
			self::printError($error['type'], $error['message'], $error['file'], $error['line']);
		}
	}
	/**
	 * 返回错误信息
	 * @param  string $type    [错误类型]
	 * @param  string $message [提示信息]
	 * @param  string $file    [出错文件]
	 * @param  string $line    [出错行数]
	 */
	public static function printError($type, $message, $file, $line)
	{
		// 判断错误类型
		switch ($type) {
			case 1:
				$type = "致命错误！(E_ERROR)(1)";
				break;
			case 2:
				$type = "警告！(E_WARNING)(2)";
				break;
			case 4:
				$type = "语法错误！(E_PARSE)(4)";
				break;
			case 8:
				$type = "注意！(E_NOTICE)(8)";
				break;
			case 16:
				$type = "非核心致命错误！(E_CORE_ERROR)(16)";
				break;
			case 64:
				$type = "致命编译错误！(E_COMPILE_ERROT)(64)";
				break;
			case 128:
				$type = "致命编译警告！(E_COMPILE_WARNING)(128)";
				break;
			case 256:
				$type = "用户导致致命错误！(E_USER_ERROR)(256)";
				break;
			case 512:
				$type = "用户导致警告！(E_USER_WARNING)(256)";
				break;
			case 1024:
				$type = "用户导致注意消息！(E_USER_NOTICE)(256)";
				break;
			case 2047:
				$type = "(E_ALL)(256)";
				break;
			default:
				$type = "PHP版本移植的兼容性和互操作性建议(E_STRICT)(256)";
				break;
		}
		$controller = new \framework\core\Controller;
		// 传递变量
		$controller -> assign('type', $type);
		$controller -> assign('message', $message);
		$controller -> assign('file', $file);
		$controller -> assign('line', $line);
		// 因为display()封装局限性，只能引入
		require PAGE_PATH . 'error.html';
	}
}
