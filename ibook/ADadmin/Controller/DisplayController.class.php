<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
class DisplayController extends Controller {
    public function index(){
         if(!isset($_GET['bookid'])){
    		$this->error('没有找到此书，或者已经出售完了。请查找其他书籍');
    	}
    	$bookid = $_GET['bookid'];
    	$m = M('Book');
    	$book = $m->find($bookid);
    	if(!$book){
    		$this->error('没有找到此书，或者已经出售完了。请查找其他书籍');
    	}
        $this->assign('book',$book);
    	
    	$this->display();
    }

}