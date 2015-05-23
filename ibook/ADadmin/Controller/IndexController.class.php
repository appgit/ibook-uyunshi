<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

    	$this->newbooks();

        $this->hotbooks();

    	$this->display();
    }

    ##私有方法--模块化## 
    private function newbooks(){

        $condition['status'] = 1;

    	$book = M('book')->where($condition)->order('publishdate desc')->select();
    	 // dump($book);
    	$this->assign('newbooks',$book);
    }

    private function hotbooks(){

        $condition['ishotsell'] = true;

        $book = M('book')->where($condition)->order('publishdate desc')->select();
         // dump($book);
        $this->assign('hotbooks',$book);
    }

    // end of ##
}