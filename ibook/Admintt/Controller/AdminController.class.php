<?php

namespace Admintt\Controller;

use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class AdminController extends Controller{
	public function  index(){
		if(!userIsValid()){

			$this->error("请先登录！");
			
		}                  
		 if($_SESSION['permission']<2) $this->error("你没有权限查看");
	         $page = 1;
		
	        if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
		
		   $m = M('Admin');
		
		 
			$count = count($m->field('id')->select()); //19
			//echo 'ddddddddd'.$count;
			//$count = count($m->where($conditon1)->select());
			$admins = $m->field('id,name,permission')->order('id desc')->limit(10)->page($page)->select();
		  //  echo "........".var_dump($admins);
			$pages = ceil($count/10); //19
			//添加用户信息和书本信息

			 

			 
			$this->assign('page',$page);
			$this->assign('pages',$pages);
			$this->assign('admins',$admins);
			$this->display();
			 
		
	}
	
	public function admindel(){
	
	if(!userIsValid()){

			$this->error("请先登录！");
			
		} 
	 if($_SESSION['permission']<3) $this->error("你没有权限操作");
	 
	   if(!isset($_GET['id'])) $this->error('删除失败');
	   if($_GET[id]==$_SESSION['adminid']) $this->error('你不能删除自己！');
	   $m = M('Admin');
	 
	   $m->delete($_GET['id']);
	
	  $this->success('成功删除',__CONTROLLER__ .'/index'); 
	}
	
	
	
	

	
}