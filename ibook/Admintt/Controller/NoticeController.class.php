<?php

namespace Admintt\Controller;

use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class NoticeController extends Controller{
	public  function index(){
	if(!userIsValid()){

			$this->error("请先登录！");
		}
		$this->display();
	}
	
	
	
	public function  notice(){
		if(!userIsValid()){

			$this->error("请先登录！");
		}
		
		$m = M('Notice');
		$conditon['iseffective'] = 1;
		 
			$count =count($m->where($conditon)->select()); //19
			//var_dump($m->field('id')->where($conditon)->select());
			$notices = $m->limit(15)->page($page)->where($conditon)->select();
			// echo "........".var_dump($order);
			$pages = ceil($count/15); //19
			//添加用户信息和书本信息

			 

			 
			$this->assign('page',$page);
			$this->assign('pages',$pages);
			$this->assign('notice',$notices);
		$this->display();
			 
		
	}

	//发布notice
	public function  publishnotice(){
		if(!userIsValid()){

			$this->error("请先登录！");
		}
		
		 
		if(isset($_POST['text'])&&isset($_POST['effectivedays'])){
		                $data['note'] = $_POST['text'];
						$data['effectivedays']= $_POST['effectivedays'];;
					    $data['iseffective'] = 1;
					    $data['adminname'] = $_SESSION['loginuser'];
					    $data['createdate'] = date('Y-m-d H:i:s',time());
					          

			 
		}else{
			$this->error('公告发布失败，请重新发布');
		}


		
		          
		          	// 上传成功 获取上传文件信息       
		          	//  echo $info['savepath'];  
		               $Notice = M('Notice');
   
		           
		            
		            if($Notice->create($data)!=null){
		            	$Notice->add(); 
		            }else {
		            	$this->error('公告发布失败，请重新发布');
		            }
		            
		            
		            //echo __CONTROLLER__;
		        redirect('./notice');
		
	}
}