<?php

namespace ADadmin\Controller;

use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class SaleController extends Controller{
	public function  index(){
		if(!userIsValid()){

			$this->error("请先登录！");
		}
		$this->display();
	}

	//发布书籍处理函数
	public function  salebook(){
		if(!userIsValid()){

			$this->error("请先登录！");
		}
		if(isset($_POST['bookname'])&&isset($_POST['costprice'])&&isset($_POST['count'])
		&&isset($_POST['publish'])&&isset($_POST['author'])&&isset($_POST['newlevel'])
		&&isset($_POST['hasnote'])&&isset($_POST['classid'])){
		                $data['bookname'] = $_POST['bookname'];
						$data['costprice']= $_POST['costprice'];;
						//$data['price']= $_POST['price'];;
						$data['publish']= $_POST['publish'];;
						$data['author']= $_POST['author'];;
						$data['newlevel']= $_POST['newlevel'];;
						$data['hasnote']= $_POST['hasnote'];;
						//$data['ishotsell'] = $_POST['ishotsell'];;
					//	$data['issepprice']= $_POST['issepprice'];;
						$data['classid']= $_POST['classid'];;
					    $data['count']= $_POST['count'];  //出售数量
					    $data['publishdate'] = date('Y-m-d H:i:s',time());
					    $data['status'] = 3;  //用户卖出的
					          

			 
		}else{
			$this->error('图书出售失败，请重新发布');
		}


		  $upload = new \Think\Upload();// 实例化上传类 
		     $upload->maxSize   =     209715 ;// 设置附件上传大小   /2M
		     $upload->exts      =     array('jpg','jpeg');// 设置附件上传类型    
		     $upload->savePath  =  '/user/images/'; // 设置附件上传目录    // 上传单个文件  
		  //   $upload->
		        $info   =   $upload->uploadOne($_FILES['image']);  
		      // echo $upload->savePath;
		        //var_dump($info);
		         if(!$info) {// 上传错误提示错误信息       
		         	 $this->error($upload->getError());   
		          }
		          $data['bookimage'] = __ROOT__.'/uploads'.$info['savepath'].$info['savename'];
		          
		          	// 上传成功 获取上传文件信息       
		          	//  echo $info['savepath'];  
		               $Book = M('Book');
                      // echo $Book->create($data);
		            $Book->add(); 
		            
		           if($Book->create($data)!=null){
		            	$bookid= $Book->add(); 
		            }
		            if(!$bookid){
		            	$this->error('图书出售失败，请重新发布');
		            }
		            
		            
		           
		            
		            
		            
		       $data2['userid'] = $_SESSION['_userid']; //用户Id
		             $data2['bookid'] = $bookid; //bookID 
		             
		             //根据新旧定价格
		             if($data['newlevel']==1) $data2['price'] = $data['costprice']*0.2;
		             else if($data['newlevel']==2) $data2['price'] = $data['costprice']*0.25;
		             else $data2['price'] = $data['costprice']*0.3;
		              
		             $data2['count']= $data['count'];
		             $data2['orderdate']  = $data['publishdate']; 
		           //   $data2['orderdate'] 
		           //默认未处理
		           //默认卖
		           if ($_POST['message']) {
		           	$data2['message'] = $_POST['message'];
		           }
		           
		            //生成订单
		             $Order = M('Orders');
	                 if($Order->create($data2)!=null){
		            $orderid =  $Order->add(); 
		             }else {
		             	$this->error('图书出售失败，请重新发布');
		             }
		           // echo $orderid."dddddd";
		            
		            //echo __CONTROLLER__;
		      $this->success('图书出售成功',__MODULE__."/Index");
	}


		 
		

		//已发布书籍
		

	}