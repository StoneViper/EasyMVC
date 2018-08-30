<?php 

namespace app\frontend\controller;

use framework\core\Controller;
use app\frontend\model\UserModel;

class IndexController extends Controller
{
	public function ActionIndex()
	{
		$model = new UserModel('user');
	}
}


 ?>