> **本项目开始于2018.08.29**

2018.08.29
=
 1. 创建目录
	 1. MVC层
	 2. 前后台文件分离
2. 编写核心文件
	1. run()
3. 单入口文件加载

目录结构 
-
![目录结构](https://s1.ax1x.com/2018/08/29/POxDOA.png)

核心文件编写
-
项目根目录下创建 *index.php* 文件，内容如下：

	<?php 
	// 引入核心文件
	require_once 'framework/core/Framework.class.php';
	// 调用run()方法
	framework\core\Framework::run();

core目录下创建 *Framework.class.php* 文件，内容如下：

    <?php 
    
	namespace framework\core;
	
	class Framework
	{
		// 定义静态方法
		public static function run()
		{
			// 打印HELLO WORLD!
			echo "HELLO WORLD!";
		}
	}

最终效果如下：

![enter image description here](https://s1.ax1x.com/2018/08/29/POzgBR.png)