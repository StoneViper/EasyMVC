<?php 

namespace app\frontend\controller;

use framework\core\Controller;
use app\frontend\model\UserModel;
use framework\core\View;

class IndexController extends Controller
{
	public function ActionIndex()
	{
		$model = new UserModel('user');
		$view = new View();
		echo "<pre>";
		// var_dump($model->db->selectAll());
		$data = [
			'name' => 'zhangsan',
		];
		$this->assign('data',$data);
		$this->display();
	}
}


 ?>