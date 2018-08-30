<?php 

namespace app\frontend\controller;

use framework\core\Controller;

class IndexController extends Controller
{
	public function ActionIndex()
	{
		$data = [
			'name' => 'alice',
			'sex' => 'girl'
		];
		$this->assign('data', $data);
		$this->display();
	}
}


 ?>