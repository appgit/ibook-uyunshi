<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

//签到 控制器
class UsercenterController extends Controller {
    public function index(){

        // $this->display();
        redirect('Usercenter/myinfo');
    }


    public function myinfo(){

        if(!session('_userid')){
            $this->error('请先登录',U('Login/index'),1);
            //redirect(U('Login/index'),1,'请先登录');   //浏览器点击后退不会出现像 $this->error这样的画面

        }

        utf();

        $myinfo = M('upc');

        $req['userid'] = session('_userid');

        /*   有关的个人信息通过join得到   */
        $ret = $myinfo->join('__USERINFO__ ON __UPC__.Id = __USERINFO__.upcid')
        ->join('__COIN__ ON __USERINFO__.id = __COIN__.userid')
        ->field('username,tel,email,regdate,lastlogindate,addr,number,vip,maxbooks,truename,income,outcome')
        ->where($req)->select();

        // dump($ret);

        $this->assign('myinfo',$ret);

        $this->a(1);   //注册一个true 

        $this->display('index');
    }

    public function buyorders(){

        $myorders = M('orders');

        $req['userid'] = session('_userinfoid');

        $req['class'] = 1;  //0卖 1买
        // $req['ishandled'] = 0;


        /*   有关的个人信息通过join得到   */
        $ret = $myorders
        /*userinfo表*/->join('__USERINFO__ ON __ORDERS__.userid = __USERINFO__.Id')
        /*book表*/->join('__BOOK__ ON __BOOK__.Id = __ORDERS__.bookid')
        /*book class表*/->join('__BOOKCLASS__ ON __BOOK__.classid = __BOOKCLASS__.Id')
        ->where($req)->select();

        $this->assign('myorders',$ret);

// dump($ret);

        $this->a(2);

        $this->display('index');
    }

    public function saleorders(){

        $myorders = M('orders');

        $req['userid'] = session('_userinfoid');

        $req['class'] = 0;  //0卖 1买
        // $req['ishandled'] = 0;


        /*   有关的个人信息通过join得到   */
        $ret = $myorders
        /*userinfo表*/->join('__USERINFO__ ON __ORDERS__.userid = __USERINFO__.Id')
        /*book表*/->join('__BOOK__ ON __BOOK__.Id = __ORDERS__.bookid')
        /*book class表*/->join('__BOOKCLASS__ ON __BOOK__.classid = __BOOKCLASS__.Id')
        ->where($req)->select();

        $this->assign('mysaleorders',$ret);

        $this->a(3);

        $this->display('index');
    }

    public function psd(){
        
        $this->a(4);
        $this->display('index');
    }

    public function updatepasswd(){

        $passwdori = $_POST['passwdori'];

        $upc = M('upc');

        $req['Id'] = session('_userid');

        $req['passwd'] = $passwdori;

        if(!$upc->where($req)->find()){
            $this->error('原密码不正确!');
        }

        $passwd = $_POST['passwd'];

        $passwd_confirm = $_POST['passwd_confirm'];

        if($passwd === $passwd_confirm){

            if(strlen($passwd)<6){

                $this->error('密码长度不能小于6');
            }
            else{
                
                
                $up_passwd['passwd'] = $passwd;

                $req['Id']=session('_userid');

                if($upc->where($req)->save($up_passwd)){

                    $this->success('密码修改成功！');
                }else{

                    $this->error('对不起，操作失败!');
                }

            }
        }else{
            $this->error('确认密码不一致！');
        }

    }

    private function a($tag){

        $this->assign('tag'.$tag,true);   //前台用来标记
    }

    
}
