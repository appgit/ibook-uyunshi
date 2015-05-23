<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";
use QQ\QC;

class IndexController extends Controller {

    public function _initialize(){
        
        common_initial();
    }

    public function index(){

	if(isset($_GET['code'])){
		
		$qc = new QC();
                            //调用QQ登陆
		$access_token=   $qc->qq_callback();

		$openid = $qc->get_openid();

		$qc= new QC($access_token,$openid);

        qqlogin($access_token,$openid,$qc->get_user_info());

	}

        $this->assign('home_active',' active');

        $sptype = M("sptype")/*->order('RAND()')*/->select();

        $this->assign('sptype',$sptype);

        $helporders = D("HelporderView")->order('publishdate desc')->limit(4)->select();
        
        $this->assign('helporders',$helporders);
         // dump($sptype);

        $this->display('Index/index');
		
    }

    public function _go_login(){    //前缀_ 无法通过url直接访问该操作

    /*
        通过common中的go_login直接判断用户是否已登录，
        没有则调用Index实例的该操作调到登录页面  
    */
        
        $this->error('亲~ 请先登录！',U('Login/index','',''),2);
    }


    // end of ##
}