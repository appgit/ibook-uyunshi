<?php

namespace Admintt\Controller;

use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class UserController extends Controller{
	public function  userinfo(){
		if(!userIsValid()){

			$this->error("请先登录！");
		}
		
	         $page = 1;
		
	        if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
		
		   $m = D('Userinfo');
		
		 
			$count = count($m->field('id')->select()); //19
			//echo 'ddddddddd'.$count;
			//$count = count($m->where($conditon1)->select());
			$users = $m->field('id,username,email,addr,vip,number,tel,truename,regdate,isseller')->order('id desc')->limit(15)->page($page)->select();
			// echo "........".var_dump($users);
			$pages = ceil($count/15); //19
			//添加用户信息和书本信息

			 

			 
			$this->assign('page',$page);
			$this->assign('pages',$pages);
			$this->assign('users',$users);
			$this->display();
			 
		
	}
	
	
	public function  userdel(){
		if(!userIsValid()){

			$this->error("请先登录！");
		}
		if($_SESSION['permission']<2) $this->error("你没有权限操作");
	         
	       
		if(!isset($_GET['id'])) $this->error('id不对，删除失败');
		
		   $m = M('Userinfo');
		
		if(!$m->delete($_GET['id']))  $this->error('删除失败...)');
		 
		
		$this->success('成功删除',__CONTROLLER__ .'/userinfo'); 
			 
		
	}

	
}