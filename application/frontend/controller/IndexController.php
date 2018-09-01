<?php 

namespace app\frontend\controller;

use framework\core\Controller;
use app\frontend\model\UserModel;

class IndexController extends Controller
{
	public function ActionIndex()
	{
		$model = new UserModel('user');
		echo "<pre>";
		// var_dump($model->db->up(['username'=>'dabai','id'=>'88'],'id=2'));
	}
}


 ?>