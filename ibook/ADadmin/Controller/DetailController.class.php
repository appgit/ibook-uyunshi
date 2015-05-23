<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class DetailController extends Controller {

    public function index(){

    	$id = $_GET['id'];

    	$condition['Id'] = $id;

    	$condition['status'] = 1;

    	$book = M('book')->where($condition)->select();

    	if($book){

    		$this->assign('book',$book);

    		$this->display();

    	}
    }


    public function addShopcar(){

        $userid = session('_userid');

        $userinfoid = session('_userinfoid');

        $bookid = $_POST['id'];

        $count = $_POST['count'];

        if(!$userid){       //没登陆写到cookie中

            $shopcar = cookie('_shopcar');

            $shopcar[$bookid] = 0 + $count;

            cookie('_shopcar',$shopcar);
            // dump(cookie('_shopcar'));
            $this->success('成功加入了购物车',U('Index/index'),2);

        }else{      //已登录的改数据库的购物车信息

            $shoppingcart = M('shoppingcart');
            // dump($userinfoid);
            // exit;
            $data['bookid'] = $bookid;
            $data['userid'] = $userinfoid;

            if($shoppingcart->where($data)->find()){

                $updcount['count'] = $count;    //更新数量
                $shoppingcart->where($data)->save($updcount);

             }else{

                $data['count'] = $count;
                // dump($data);
                $shoppingcart->add($data);

             }

            $this->success('成功加入了购物车',U('Shopcar/index'),2);
        }

        
        //dump($_SESSION);
    }

}