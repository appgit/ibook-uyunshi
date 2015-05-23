<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class SecondhandController extends Controller {

    public function _initialize(){

        common_initial();
    }

    public function index(){
    	
    	$this->assign('second_active',' active');

    	utf(); 
    	$sptype = M('sptype')->where('isnew = 0')/*->limit(5)*/->select();
    	
        $this->assign('sptype',$sptype);

        /*当前是在二手页*/
        session('_isnew',0);

      	$this->display();

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


    public function te(){
        // echo cookie('aaa');
    }

}