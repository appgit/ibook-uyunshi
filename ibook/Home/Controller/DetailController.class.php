<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class DetailController extends Controller {

	public function _initialize(){

		common_initial();
	}

	public function index(){

		// dump($_COOKIE);

		/*不让用户直接改浏览器id编号就能访问数据库里面的商品信息*/
		$seller = $_GET['seller'];

		$id = $_GET['id'];

		$sql['id'] = $id;

		$sql['username'] = $seller;

		$sql['ishandled'] = 1;

		$shangpin = D('ShangpinView');

		$cur_pro = $shangpin->where($sql)->find();

		if(!$cur_pro){

			$this->error('亲~，没找到该商品！');

			return;

		}else{

			$cur_pro['publishdate'] = date('Y-m-d',$cur_pro['publishdate']);

			$this->assign('shangpin',$cur_pro);

			$sql['id'] = array('neq',$sql['id']);

			$other_pros = $shangpin->where($sql)->order('publishdate desc')->field("id,name,price,image,username")->limit(6)->select();

			$this->assign('other_pros',$other_pros);
		}

		$this->display();
	}

	public function chat(){

		$req['username'] = $_POST['seller'];

		$userinfo = D('UserinfoView')->where($req)->find();

		if($userinfo){

			$userinfo['regdate'] = date('Y-m-d',$userinfo['regdate']);

			echo ("<div class='ichat-body clearfix'>
					<div class='left mail-wp'>
						<p>将您的信息发送给卖家？</p>
						<br>
						<p> 卖家将会与你联系， </p>
						<p>你也可以主动地与卖家联系...</p>");
						if(session('?_userinfoid')){
							echo("<textarea class='desc' name='desc' placeholder='给卖家的留言 (可不填)...' maxlength='200'></textarea>");
						}else{
							echo("<textarea class='desc' name='desc' placeholder='给卖家的留言( 需先登录 )...' maxlength='200'></textarea>");
						}
						echo("<div class='send-msg'>
							<a id='id_".$_POST['id']."--seller_".$userinfo['id']."' class='send-really button-style1'>确认发送</a>
							<img style='display:none;' src='".__ROOT__."/public/images/home/facebook_loader.gif' alt='邮件发送中...' />
						</div>
					</div>
					<div class='left seller-info'>
						<div class='clearfix'>
							<h3>卖家基本信息</h3>
							<img class='left' src='".__ROOT__.'/'.$userinfo['avatar']."' alt=''>
							<div class='left text'>
								<p>卖家用户名：".$userinfo['username']."</p>
								<p>".$userinfo['regdate']." 加入</p>
								<p>手机：".$userinfo['tel']."   </p>
								<p>邮箱：".$userinfo['email']."</p>
								<p>QQ: ".$userinfo['number']."</p>
							</div>
						<a target='_blank' href='http://wpa.qq.com/msgrd?v=3&uin=".$userinfo['number']."&site=qq&menu=yes' class='qq-chat'><i class='icon'></i>通过腾讯QQ交谈</a>
					</div>
				   </div>");
		}else{
			echo false;
		}
	}
	/*处理确认发送*/
	public function doSent(){

		if(!session('?_userinfoid')){

			$data['status'] = 0;

			$data['message'] = "亲~ 您还没登录哦  <a href='".__MODULE__."/Login' class='go-login'>此处登录</a>";

			$this->ajaxReturn($data);

		}else{

			$sql['spid'] = I('post.id');

			$sql['uid'] = session('_userinfoid');/*用户id*/

			$sql['sid'] = I('post.seller');/*卖家id*/

			if($_POST['desc'] == ''){

				$_POST['desc'] = '无';
			}

			if($sql['uid'] == $sql['sid']){	/*不让自己给自己下订单*/

				$data['status'] = 3;

				$data['message'] = 'Oops~ 亲爱的商家，这是您发布的宝贝，请不要给自己下订单哦！';

				$this->ajaxReturn($data);
			}

			$ret = M('orders')->where($sql)->order('id desc')->find();

			if($ret){/*当天已经创建了该订单*/

				if(date('Y-m-d',$ret['createtime']) == date('Y-m-d',time())){

					$data['status'] = 2;

					$data['message'] = '亲~ 您今天已经购买过此宝贝，请耐心等待商家联系您哦~';

					$this->ajaxReturn($data);
				}
			}

			$sql['createtime'] = time();

			$sql['description'] = htmlentities($_POST['desc']);

			/*生成订单*/

			if(M('orders')->add($sql)){

				/*更新约谈次数*/
				$chat_count = M('shangpin');

				$chat['id'] = $sql['spid'];/*更新商品约谈次数*/

				$shangpin = $chat_count->where($chat)->find();

				$update['chatcount'] = $shangpin['chatcount'] + 1;

				$chat_count->where($chat)->save($update);

				/*返回结果*/
				$data['status'] = 1;

				$data['message'] = '恭喜您，订单创建成功！请耐心等待商家联系您~';

				$user_sell = M('userinfo')->where('id='.$sql['sid'])->find();

				sendEmail($user_sell['username'],$user_sell['email'],$shangpin,2);

				$this->ajaxReturn($data);

			}else{
				
				$data['status'] = 4;

				$data['message'] = '对不起，订单创建失败！';

				$this->ajaxReturn($data);
			}	
		}
	}
	public function test(){

		echo __CONTROLLER__;
		echo date('Y-m-d',1401010217);
		// echo time(date('Y-m-d'));
	}

}