<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";
class PurchaseController extends Controller {

    public function index(){

        if(session('_shopcartotal')==0){

            $this->error('快去买几本书吧! :)',U('Index/index'));
        }
        
        $userinfoid = session('_userinfoid');

        $shoppingcart = D('Shoppingcart');

        $req['userid'] = $userinfoid; //where条件

          $books = $shoppingcart->where($req)->relation(true)->select();

          $order = M('orders');

          $order_data['userid'] = $userinfoid;

          // dump(count($books));exit;

          $success_num = 0;

          foreach ($books as $key => $val) {

                $order_data['bookid'] = $val['bookid'];

                $order_data['userid'] = $userinfoid;

                $order_data['price'] = $val['book']['price'];

                $order_data['count'] = $val['count'];
                
                $order_data['orderdate'] = date('Y-m-d H:i:s',time());

                $order_data['ishandled'] = 0;

                $order_data['class'] = 1;

                $order_data['message'] = '倒时候再加吧 -.-||';

                // dump($order_data);

            $orders_id = $order->add($order_data);

            if($orders_id){ //订单创建成功,删除购物车对应的记录

                $del_data['userid'] = $userinfoid;

                $del_data['bookid'] = $val['bookid'];
                
                $shoppingcart->where($del_data)->delete();

                $success_num += 1;

            }

          // dump($books);

            // dump($val['book']['price']);
              
          }
          if($success_num < count($books) ){

            $this->error( "count($books)-$success_num条订单处理失败",U('Shopcar/index'),2);
          }else{

            $this->success('订单创建成功',U('Index/index'),1);
          }

        // $this->display();
    }

}