<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class NewproductsController extends Controller {

    public function _initialize(){

        common_initial();
    }

    public function index(){
    	
    	$this->assign('new_active',' active');

    	utf(); 

    	$sptype = M('sptype')->where('isnew = 1')->order('isnew desc')->select();
    	
        $this->assign('sptype',$sptype);

        /*当前是在新品页*/
        session('_isnew',1);

      	$this->display("Secondhand/index");

	}


	//获取固定长宽的图片
	private function imginfo(){

		 $path = './Public/images/home/tejia' ;
		// $path = $_GET['src'];
		
		// dump(urlencode($path));
		// dump(urldecode('Public%2Fimages%2Fhome%2Ftejia'));
		// dump($_GET);

		resizeimage($path);
  	}

}