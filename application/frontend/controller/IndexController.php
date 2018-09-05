<?php 

namespace app\frontend\controller;

use framework\core\Controller;
use app\frontend\model\UserModel;
use framework\core\View;
use framework\libraries\Memcached;

class IndexController extends Controller
{
	public function ActionIndex()
	{
		// // $model = new UserModel('user');
		// // $view = new View();
		// echo "<pre>";
		// // var_dump($model->db->selectAll());
		$data = [
			'name' => 'zhangsan',
		];
		$this->assign('data',$data);
		$this->display();
		// // var_dump($_GET);
		
		// $mem = new Memcached();

		// echo $mem -> add('name','zhangsan',1200);
		// echo $mem -> add('sex','0',1200);
		// echo $mem -> get('name');
		// $mem -> delete('name');
		// $mem -> replace('name', 'da', 10);
		// var_dump($mem -> getAll());

		// var_dump($mem->getError());
		// echo "$a";
		
	}
}
