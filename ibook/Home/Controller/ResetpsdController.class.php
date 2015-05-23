<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

//忘记密码
class ResetpsdController extends Controller {
    
    public function index(){ 

        if(session('_mail_cnt') >= 3){

            $this->assign('verify',true);   //输入邮箱三次则显示验证码
        }

    	$this->display();
        
    }

     //判断输入用户名和邮箱，以及发送修改密码链接的邮件
    public function resetpasswd(){

            // $req['username'] = $_POST['username'];
            $req['email'] = $_POST['email'];
            $req['isqq'] = 0;

            $email_href = 'mail.'.substr($req['email'], strpos($req['email'], '@')+1);

            $_mail_cnt = session('_mail_cnt');

            if($_mail_cnt >= 3){

                $code = $_POST['code'];

                if(!check_verify($code)){

                     $this->error('验证码错误',U('index'),1);
                 }
            }

            session('_mail_cnt',$_mail_cnt+1);

            $user = M('userinfo')->where($req)->find();


            // dump($user);

            if(!$user){

                $this->error('该Email没有注册过!',U('index'),1);

            }else{

                $resetpasswd = M('resetpasswd');

                $verify = md5($user['username'].date('Y-m-d'));

                $data['token'] = $verify;

                $data['token_exptime'] = time() + 24 * 3600;

                $data['userinfoid'] = $user['id'];

                $where['token'] = $verify;

                if($ret = $resetpasswd->where($where)->find()){

                    if($ret['token_exptime'] > (time()+24*3600-60) ){

                        $this->error('操作过于频繁，请一分钟后重试'); //表单提交间隔不能低于1,U('index'0,1)秒
                    }

                    $ret['error'] = 0;

                    $ret['token_exptime'] = time() + 24 * 3600;

                    $resetpasswd->where($where)->save($ret);

                }else{

                    $resetpasswd->add($data);
                }

                $email = $req['email'];

                $is_mail_ok = sendEmail($user['username'],$email,$verify,1);

                if($is_mail_ok){

                    $Text['title'] = "重置密码成功";

                    $Text['h3'] = "重置密码的链接已发送至您的邮箱，快去邮箱看看吧";

                    $Text['url'] = "http://".$email_href;

                    $Text['urltext'] = "点击这里";

                    $this->assign('Text',$Text);

                    $this->display('Register/success');

                }else{

                    $Text['title'] = "出错了";

                    $Text['h3'] = "对不起，邮件发送失败";

                    $Text['url'] = U('Resetpsd/index');

                    $Text['urltext'] = "返回上一页";

                    $this->assign('Text',$Text);
                    
                    $this->display('Register/success');
                }
            }
    }

    //设置新密码
    public function setnewpasswd(){

        $newpasswd = $_POST['newpasswd'];

        $psd_confirm = $_POST['psd_confirm'];

	    $resetpasswd = M('resetpasswd');

        /*-------提交到该操作时的处理*/
        if( isset($newpasswd) && isset($psd_confirm) ){	

            $psd_val = passwd_verify($newpasswd,$psd_confirm);

            if($psd_val === 1){

                $this->error('确认密码不一致');

            }else if($psd_val === 2){

                $this->error('密码长度小于6位');

            }else if($psd_val === 3){

                $modify['error'] = 1;/*设置为过期，不可用*/

                $update_arr['id'] =session('_resetpsdid');

                $resetpasswd->where($update_arr)->save($modify);

                $upc = M('userinfo');

                $this_user = $resetpasswd->where($update_arr)->find();

                $upc_req['id'] = $this_user['userinfoid'];
                $upc_req['isqq'] = 0;

                $upc_newpass['passwd'] = md5($newpasswd);

                // dump($upc_req);

                // dump($upc->where($upc_req)->select());return;
                $upc->where($upc_req)->save($upc_newpass);

                $this->success('恭喜，密码修改成功，快去登录吧!',home_url(true),2);

                session('_resetpsdid',null);
            }


        //访问该操作时的处理
        }else{

            $update_arr['token'] = $_GET['verify'];

	        $resetpsd = $resetpasswd->where($update_arr)->find();

	        // dump($resetpsd);
            // return;

            if(!$resetpsd || $resetpsd['token_exptime'] < time() || $resetpsd['error'] == 1){

                $this->error('链接已失效',home_url(),1);

	        }else{  //ok,显示修改密码的地方

                $upc = M('userinfo');

                $upc_ret = $upc->find($resetpsd['id']);

                $arr = array(

                        '_resetpsdid'   => $resetpsd['id']
                    );

                set_session($arr);

                $this->display();
	        }

	    }
    }


    public function verify(){   

        verify(16);
    }

    //  public function aaa(){
    //     $Text['title'] = "重置密码成功";
    //     $Text['h3'] = "重置密码的链接已发送至您的邮箱，快去邮箱看看吧";
    //     $Text['url'] = "http://".$email_href;
    //     $Text['urltext'] = "点击这里";
    //     $this->assign('Text',$Text);
    //     $this->display('Register/success');
    // }
}
