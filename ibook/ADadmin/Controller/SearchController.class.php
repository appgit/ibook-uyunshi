<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
class SearchController extends Controller {
    public function index(){

    	$this->display();
    }

    //关键词搜索
    public function search(){
    	if(!isset($_REQUEST['searchkey'])||$_REQUEST['searchkey']==null||trim($_REQUEST['searchkey'])==''){
    		$this->error('请输入关键词!');
    	}
    	
    	//echo  $_REQUEST['searchkey'];
    	$page = 1;
        if(isset($_REQUEST['page'])){
    		$page = $_REQUEST['page'];
    	}
    	$likesql = '%';
    	$searchkeys  = preg_split('//u',$_REQUEST['searchkey'], -1, PREG_SPLIT_NO_EMPTY);  //获得关键词
    	foreach ($searchkeys as $value) {
    		$likesql.=$value.'%';
    	}
    	  // 模糊查询条件
    	//echo $likesql.$value.'%';
    	$condition['status'] =1;
    	  $condition['bookname'] = array('like',$likesql); //模糊查询
    	$m = M('Book');
    	$count =count($m->where($condition)->select()); //计算总条数
    	$pages = ceil($count/15); //总页数
    	$books = $m->limit(15)->page($page)->where($condition)->select();
    //	echo $searchkey;
    	if($count==0){
    		$arr['books'] = '0';
                  
    		
    	}else {
    		$arr['books'] = $books;
    	}
    	$arr['searchkey'] = $_REQUEST['searchkey'];
    	$arr['pages']=  $pages;
    	
    	echo json_encode($arr); 
    	// dump($book);
    	
    	
    }

    // end of ##
}