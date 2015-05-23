<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class ShopcarController extends Controller {

   public function index(){

      $userid = session('_userid');

      $userinfoid = session('_userinfoid');

      $shopcar = cookie('_shopcar');
      //dump($shopcar);
      //exit;
      if( !$userid){
         // redirect(U("Login/index"),2,'请先登录');
         $this->error('请先登录','Login',1);
      }else{

         $shoppingcart = D('Shoppingcart');
         // dump($user->find($userid));
         // exit;
         if($shopcar){  //没登陆之前有cookie的，现在登录了就将cookie中的信息加写入购物车数据库

            $data['userid'] = $userinfoid;

            foreach ($shopcar as $key => $val) {

               $data['bookid'] = $key;

               if($shoppingcart->where($data)->find()){  //该条记录已经在数据库中

                   $updcount['count'] = $val;    //更新数量

                   $shoppingcart->where($data)->save($updcount);

                }else{  //该条数据没有在数据库中

                   $data['count'] = $val;

                   $shoppingcart->add($data);
                }
            }
            cookie('_shopcar',null);
         }   
         
         //cookie 处理过了，直接读吧

         $condition['userid'] = $userinfoid;
         
         $myshopcar = $shoppingcart->where($condition)->relation(true)->select();
         // dump($myshopcar);
         // exit();
         $this->assign('myshopcar',$myshopcar);

      }
      $this->display();
   }


   public function del(){  //删除购物车商品

    $bookid = $_GET['bid'];

    $shoppingcart = M('Shoppingcart');

    $condition['bookid'] = $bookid;

    $shoppingcart->where($condition)->delete();

    redirect(U('Shopcar/index'));

   }
}