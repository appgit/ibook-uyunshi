<?php
// 本类由系统自动生成，仅供测试用途


namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

class RegisterController extends Controller {

    public function _initialize(){

        common_initial();
    }

    public function index(){

        if(session('?_userinfoid')){

            redirect(home_url());
        }
        #echo date('Y-m-d H:i:s',time()+24*60*60);
        
        $this->display();
    }

/*处理注册*/
    public function doReg(){

        $cnt = session('_regcnt') + 1;

        session('_regcnt',$cnt);  


    	$userinfo = D('Userinfo');
    	$userinfo->create();

        /*用户注册的邮箱的地址*/
        $email_href = 'mail.'.substr($userinfo->email, strpos($userinfo->email, '@')+1);

    	if(!$userinfo->getError()){	//userinfo数据输入合法
            $userinfo->token = md5($userinfo->username.$userinfo->passwd.time());//创建激活码
            $userinfo->token_exptime = time()+24*60*60;
            $userinfo->status = 0;
            $userinfo->regdate = time();

                //发邮件
                // echo "<script>alert('请稍后，邮件发送中...')</script>";

                $success = $this->mail($userinfo->username,$userinfo->email,$userinfo->token);

                if($success){   //成功发送邮件，写入数据

                    $uid = $userinfo->add();

                    $avatar_add['uid'] = $uid;

                    M('avatar')->add($avatar_add);

                    $Text['title'] = "恭喜，注册成功";

                    $Text['h3'] = "注册成功，快去邮箱激活一下吧！ <b>(别忘记检查垃圾箱哦)</b>";

                    $Text['url'] = "http://".$email_href;

                    $Text['urltext'] = "点击这里";

                    $this->assign('Text',$Text);
                    
                    $this->display('Register/success');
                    
                }else{
                    
    			    $Text['title'] = "注册失败";

                    $Text['h3'] = "注册失败，邮件发送出错，请重试";

                    $Text['url'] = U('Register/index');

                    $Text['urltext'] = "返回";

                    $this->assign('Text',$Text);
                    
                    $this->display('Register/success');
                }

    	}else{
            // dump($_POST);return;
    		$this->error(($userinfo->getError()));
            return;
    	}
    }


    public function verify(){
    	verify();
    }

/*用户激活*/
    public function active(){

        utf();

        $code =  $_GET['activecode'];

        // 关联更新需要传入原始表的某一个数据的更新才能更新!!!!
        $condition['token'] = $code;    //根据激活码select
        
        $user = M('Userinfo');

        $result = $user->where($condition)->find();

        if(!$result){

            $this->error('非法的参数！');
            
        }else{  //有该激活码

            if($result['status'] == 1){

                    $this->error('您已成功激活过，请用账号直接登录！',home_url(true),1);

                }

            if($result['token_exptime']-time() > 0 ){

                $data['status'] = 1; 

                $user->where($condition)->save($data);

                $Text['title'] = "激活成功";

                $Text['h3'] = "亲~ 恭喜您激活成功，优云网欢迎您的加入 :-)";

                $Text['url'] = U('Index/index');

                $Text['urltext'] = "返回首页";

                $this->assign('Text',$Text);

                $this->display('Register/success');

            }else{
                
                $user->delete($result['id']);

                $this->error("验证码已过期，请重新注册！\n2秒后跳转到注册页面",U('Register/index'),2);

            }
        }
      
    }

/*发邮件*/
    private function mail($username,$email,$activecode) {

        $result = sendEmail($username,$email,$activecode);

        return $result;

    }

/*检查邮箱是否注册*/
    public function checkEmail(){

        $email = $_POST['email'];
        $data['status'] = isEmailExist($email);
        $this->ajaxReturn($data);
    }

/*检查用户名是否注册*/
    public function checkUser(){

        $username = $_POST['username'];
        $data['status'] = isUserExist($username);
        $this->ajaxReturn($data);

    }

/*qq用户信息绑定*/
    public function qquser(){

        if(session('?firstqqlogin')){

            $sql['username'] = I('post.username');

            $sql['email'] = I('post.email');

            /*更新处理*/

            session('firstqqlogin',null);
        }

        redirect(home_url());   /*跳回home*/
    }
    
}


