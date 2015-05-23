<?php
// 本类由系统自动生成，仅供测试用途
namespace Admintt\Controller;
require_once MODULE_PATH."Common/common.php";

use Think\Controller;
class IndexController extends Controller {
	public function index(){
		//$Verify = new \Think\Verify();
		//	$Verify->entry();
		//$this->assign('verify',$Verify);
		$this->display();
	}
	public function verify(){
          myverify();
	}
}