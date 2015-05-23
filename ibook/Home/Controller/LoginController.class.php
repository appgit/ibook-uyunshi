<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";
class LoginController extends Controller {

    public function _initialize(){
        
        common_initial();
    }

    public function index(){

        if(session('?_userinfoid')){

            redirect(home_url());
        }
        // dump($_SESSION);

        // $this->display('Login:index');    //若是被调用的时候，dispaly需要操作名以免混淆模板渲染

        if(session('?_temp_errorinfo')){

            $this->assign('error',session('_temp_errorinfo'));
            session('_temp_errorinfo',null);
        }

        /*来自页面*/
        $from_page = $_SERVER['HTTP_REFERER'];

        if($from_page){

            preg_match('/index.php.*/',$from_page,$url);
            $url = substr($url[0], 15);
        }

        if(!$url){
            $url = 'Index';
        }
        session('_via',$url);

        $this->display();
    }

    /*处理登录*/
    public function login(){

        $cnt = session('_logincnt') + 1;

        session('_logincnt',$cnt);

        $username = $_POST['username'];

        $passwd = $_POST['passwd'];

        $code = $_POST['code'];
        // dump($_POST);return;

        if(isset($code)){

            if(!check_verify($code)){

                $errorinfo = '验证码错误!';
                session('_temp_errorinfo',$errorinfo);
                redirect(U('Login/index','via='.$_POST['via']),0,'');
            }
        }
        $ret = loginCheck($username,$passwd);

        if($ret === 1){

            $errorinfo = '密码错误!';

        }else if($ret === 0){

            if(!$_POST['username']){

                $errorinfo = '请输入用户名!';

            }else{

                $errorinfo = '用户不存在!';
            }

        }else if($ret === 2){

            $errorinfo ='请先去邮箱激活！'; 
        }

        else{

            // dump($ret);return;
            $arr = array(   //session 信息
                '_loginuser' => $ret['username'],
                '_userinfoid' => $ret['id'],
                '_lastlogindate' => $ret['lastlogindate'],
                );

            set_session($arr); //session写入

            $avatar = M('avatar')->where('uid='.session('_userinfoid'))->find();

            session('_useravatar',$avatar['path']);

            if($_POST['autologin']){        //免登陆

                $hash = md5(session('_userinfoid').time());

                $data['token_exptime'] = time()+3600*24*7;
                $data['userid'] = session('_userinfoid');
                $data['verify'] = $hash;

                cookie('_verify',$hash,3600*24*7);

                $condition['userid'] = session('_userinfoid');

                $autologin = M('autologin');

                if($autologin->where($condition)->find()){

                    $autologin->save($data);

                }else{
                    
                    $autologin->add($data);
                }

                // return;
            }

            //更新最后登录时间
            $userinfo = M('userinfo');

            $req['id'] = session('_userinfoid');

            $update['lastlogindate'] = time();

            $userinfo->where($req)->save($update);


            // dump($_POST);
            // dump($_SESSION);exit();
            $from_page = base64_decode($_POST['via']);

            // dump($from_page);return;

            if(A($from_page) == false){

                $from_page = 'Index';
            }

            $from_page.='/index';

            session('_logincnt',null);

            $this->success('登录成功！走起~','../'.session('_via'),2);

            session('_via',null);

            return;

        }
            session('_temp_errorinfo',$errorinfo);

            redirect(U('Login/index','via='.$_POST['via'],''),0,'请先去邮箱激活！');
    }

    /*登出*/
    public function out(){

        /*clear autologin*/
        $autologin['verify'] = cookie('_verify');
        
        $alogin_user = M('autologin')->where($autologin)->delete();

        $arr = array(   //session 信息
                '_loginuser' => null,
                '_userinfoid' => null,
                '_lastlogindate' => null,
                '_isseller' => null,
                '_logincnt' => null,
                );

        set_session($arr); //session清除


        redirect(U('Index/index'));
    }


    //验证码 img的 src是此操作
    public function verify(){   

        verify();
    }

    public function _empty($name){  

        $this->show("对不起页面没找到 :( 
            <br/><br/><a href='".U('Index/index')."'>返回首页</a>");    
     }

    private function mlogin(){  //模态登录

        utf();

        $isajax = $_POST['value'];

        if($isajax){    
            
            $uri = T('Login/mlogin');   //dump($uri);

            $html = file_get_contents($uri);

            // dump(__DOMIN__.__MODULE__);

            $html = str_replace("http://localhost/ibook/index.php/Home",__DOMIN__.__MODULE__,$html);

            echo( $html );

        }else{

                $this->index();
        }
        return;

        // $home = A('Index'); $home->index();  //访问Index控制器下面的index操作

    }

}