<?php

namespace Admintt\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class OrderController extends Controller{ 
   
    
      public function  helporderhandde(){  //已处理
    		if(!userIsValid()){
    		
    		$this->error("请先登录！");
    	   }
    	   if(!isset($_REQUEST['id'])) redirect(__MODULE__.'/Home/helporder?');
    	   
    	   $conditionhel['Id']= $_REQUEST['id'];
    	   $helporder = M('Helporder');
    	   
    	   $helporder->ishandled = 1;
    	  // dump($condition);
    	 $helporder->where($conditionhel)->save();
    	   
    	  redirect(__MODULE__.'/Home/helporder?');
    	   
    }

	
      public function  helporderdel(){  //删除
    		if(!userIsValid()){
    		
    		$this->error("请先登录！");
    	   }
    	   if(!isset($_REQUEST['id'])) redirect(__MODULE__.'/Home/helporder?');
    	   
    	   $id = $_REQUEST['id'];
    	   $helporder = M('Helporder');
    	   
    	 $helporder->delete($id);
    	   
    	  redirect(__MODULE__.'/Home/helporder?');
    	   
    }
    	
    	   
    
    
}