<?php

namespace Admintt\Controller;
use Org\Util\Date;

use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class PublishController extends Controller{
	
		public function typeshow(){
		  if(!userIsValid()){

				$this->error("请先登录！");
			 }
				  $page = 1;
				  if(isset($_GET['page'])){
				   $page = $_GET['page'];
				  } 
                 $m = D('TypeView');
				 
				 $count =count($m->field('id')->select());
				 $types = $m->field(true)->order('id desc')->limit(20)->page($page)->select();
				 $pages = ceil($count/20);
				 $this->assign('page',$page);
    	         $this->assign('pages',$pages);
				 $this->assign('types',$types);					 
				$this->display();
		
		}

//增加超类别
		 public function  addsptype(){
		
		if(!userIsValid()){

				$this->error("请先登录！");
			}

		  $this->display();
		
		}
		
		
		
		//增加大类别
		public function  addbtype(){
		
		if(!userIsValid()){

				$this->error("请先登录！");
			}

			//取出大类
			
			$m = M('Sptype');
			$sptypes = $m->select();
			$this->assign('sptypes',$sptypes);
			
			
			
		  $this->display();
		
		}
		
		//增加小类 
		public function  addstype(){
		
		if(!userIsValid()){

				$this->error("请先登录！");
			}

			//取出大类
			
			$m = M('Btype');
			$btypes = $m->select();
			$this->assign('btypes',$btypes);
			
			
			
		  $this->display();
		
		}
		
		
		//增加超类别处理函数
		public function  addsptypepro(){
		
		if(!userIsValid()){

				$this->error("请先登录！");
			}
		
 
	           if(!isset($_POST['note'])||!isset($_POST['isnew'])){$this->error('增加类别失败');}
			   $sptype = M('Sptype');
			   
			   $sptype->note = $_POST['note'];
			    $sptype->isnew = $_POST['isnew'];
			 //  dump($sptype);
			 if(!$sptype->add()) {$this->error('增加类别失败！');}
			   
			  redirect(__CONTROLLER__ .'/typeshow'); 
		
		}
		
		
		
		//增加大类别处理函数
		public function  addbtypepro(){
		
		if(!userIsValid()){

				$this->error("请先登录！");
			}

		 
	           if(!isset($_POST['note'])||!isset($_POST['sptypeid'])||$_POST['sptypeid']=='no'){$this->error('增加类别失败');}
			   $btype = M('Btype');
			   
			   $btype->note = $_POST['note'];
			    $btype->sptypeid = $_POST['sptypeid'];
			  // dump($_POST['btypeid']);
			 if(!$btype->add()) {$this->error('增加类别失败！');}
			   
			 redirect(__CONTROLLER__ .'/typeshow'); 
		
		}
		
		
		//增加小类别处理函数
			public function  addstypepro(){
		
		if(!userIsValid()){

				$this->error("请先登录！");
			}

		 
	           if(!isset($_POST['note'])||!isset($_POST['btypeid'])||$_POST['btypeid']=='no'){$this->error('增加类别失败');}
			   $stype = M('Stype');
			   
			   $stype->note = $_POST['note'];
			    $stype->btypeid = $_POST['btypeid'];
			   dump($_POST['btypeid']);
			 if(!$stype->add()) {$this->error('增加类别失败！');}
			   
			 redirect(__CONTROLLER__ .'/typeshow'); 
		
		}
		
		//删除小类别
		 public function delstype(){
		     if(!userIsValid()){

				$this->error("请先登录！");
			 }
		 if($_SESSION['permission']<2) $this->error("你没有权限操作");
		 
		  if(!isset($_GET['stypeid'])) $this->error('删除失败');
		  
		  $m = M('Stype');
		  if(!$m->delete($_GET['stypeid']))  $this->error('删除失败');
		$this->success('成功删除',__CONTROLLER__ .'/typeshow');
		  
		 
		 
		 }


	}