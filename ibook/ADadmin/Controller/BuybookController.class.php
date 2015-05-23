<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class BuybookController extends Controller {

    public function index(){
        
        $book = M('book');

        $req['status'] = 1;

        $book_sel = $book->where($req)->select();



        $this->assign('books',$book_sel);
        $this->display();
        }    
}