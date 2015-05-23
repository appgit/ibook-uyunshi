<?php

namespace Admintt\Controller;
use Org\Util\Date;

use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class HelporderController extends Controller{
	
		public function index(){
		  if(!userIsValid()){

				$this->error("请先登录！");
			 }
				  $page = 1;
				  if(isset($_GET['page'])){
				   $page = $_GET['page'];
				  } 
                 $m = D('HelporderView');
				 
				 $count =count($m->field('id')->select());
				                                 
				 $helporder = $m->field('id,name,publishdate,description,username,truename,tel,addr,email')->limit(20)->page($page)->select();
				 $pages = ceil($count/15);
				 $helporders = $m->select();
				 $this->assign('page',$page);
    	         $this->assign('pages',$pages);
				 $this->assign('helporders',$helporders);			 
				 $this->display();
		
		}
		
		public function delete(){
		  if(!userIsValid()){

				$this->error("请先登录！");
			 }
			

					if(!isset($_GET['id'])){$this->error('删除失败！');}

					$id = $_GET['id'];

					$helporder = M('Helporder');
					$helporder->delete($id);
				   redirect(__CONTROLLER__ .'/index');
					
		
		}



	}