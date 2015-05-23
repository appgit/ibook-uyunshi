<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

//签到 控制器
class SignupController extends Controller {
    public function index(){
    if(!userIsValid()){

			$this->error("请先登录！");
	}
	if(!isset($_GET['userid'])) {
		echo '出现错误，请稍后再签到！';
		exit();
	} 
	
	$m = M('Userinfo');
	$user = $m->find($_GET['userid']);
	
	if(!$user) {
		echo '出现错误，请稍后再签到！';
		exit();
	} 
	$today = date('Ymd',time());
    if(((int)$today-(int)date('Ymd',$user['signupdate']))<=0){
	
    	echo 'false';
    	exit();
    }
    
    $condtion2['id'] = $_GET['userid'];
    $user['signupdate'] = time();  //把签到时间换成今天的 
    $m->where($condtion2)->save($user);  //更新
   
    
    $m2 = M('Coin');  //用户的积分表
    $condtion['userid'] = $_GET['userid'];
    $coin = $m2->where($condtion)->find();
    $coin['income'] += 1;
    $m2->where($condtion)->save($coin);  //更新积分
    echo 'true';
    
    }

    // end of ##
}