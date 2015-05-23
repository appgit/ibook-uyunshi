<?php
// 本类由系统自动生成，仅供测试用途
namespace Admintt\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";
class HomeController extends Controller {
    public function index(){
    	//echo "----------".userIsValid()."dfdsfdsf";
    	
    	//$_SESSION['loginuser']
    	if(userIsValid()){
    		
    	   $this->display();
    	   
    	}else{
    		$this->error("请先登录！");
    	}
    }
    
    
    
    

    
 
    
    
    
    //上传商品展示
    public  function  shangpindis(){
    	
    	if(!userIsValid()){
    		
    		$this->error("请先登录！");
    	}
    	
    	
    	$page = 1;
    	$conditon1['ishandled']=0;   //未处理

    	 if(isset($_GET['ishandled'])){
    		
    		$conditon1['ishandled'] =$_GET['ishandled'];
    		// echo "debug";
    		
    	 }
    	 if(isset($_GET['page'])){
    	 	$page = $_GET['page'];
    	 } 
   
    	
    	 
    	//echo $page."debug";
    	                        
    	 //echo "debug".isset($_GET['ishandled']);
    	$m = D('ShangpinView');
   // 	 var_dump($m->field('id')->select());
   	$count =count($m->field(true)->where($conditon1)->select()); //19
    
    	
    	$shangpin = $m->field(true)->order('id desc')->limit(4)->page($page)->where($conditon1)->select();
    //  echo "........".var_dump($order);

    	$pages = ceil($count/4); //19
    	//添加用户信息和书本信息

    	
        
         
    	$this->assign('ishandled',$conditon1['ishandled']);
    	$this->assign('page',$page);
    	 $this->assign('pages',$pages);
       $this->assign('shangpin',$shangpin);
  $this->display();
    }
    



//商品通过审核
public function shangpinpass(){
    if(!userIsValid()){
    		
    		$this->error("请先登录！");
    }

	if(!isset($_GET['id'])){$this->error('审核失败！');}

	$condition['id'] = $_GET['id'];

	$shangpin = M('Shangpin');
    $shangpin->status = 1;
	$shangpin->ishandled= 1;
	$shangpin->where($condition)->save();
   redirect(__CONTROLLER__ .'/shangpindis');
	
    	

}
//删除商品
public function shangpindel(){

 if(!userIsValid()){
    		
    		$this->error("请先登录！");
    }

	if(!isset($_GET['id'])){$this->error('删除失败！');}

	$id = $_GET['id'];

	$shangpin = M('Shangpin');
    if(!$shangpin->delete($id)) $this->error('删除失败');
   $this->success('成功删除',__CONTROLLER__ .'/shangpindis?ishandled=1');
	


}

   
     
    
   
}