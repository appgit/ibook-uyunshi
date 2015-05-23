<?php
// 本类由系统自动生成，仅供测试用途
namespace ADadmin\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";
class LoginController extends Controller {
    public function index(){
        $this->display();
    }
    public function login(){

        $username = $_POST['username'];

        $passwd = $_POST['passwd'];

     
        $ret = loginCheck($username,$passwd);

        if($ret === 1){

                   $arr['status'] = 'passwderror';
                  echo json_encode($arr); 

        }else if($ret === 0){

               $arr['status'] = 'notexist';
                  echo json_encode($arr); 

        }else if($ret === 2){
             $arr['status'] = "notactive";
                  echo json_encode($arr); 
        }
        else{
            //dump($ret);

            $userinfo = M('userinfo');

            $condition['upcid']= $ret["Id"];

            $userinfoid = $userinfo->where($condition)->find();   

            $userinfoid = $userinfoid['id']; //获取对应的userinfo的Id

            $arr = array(
                'loginuser' => $username,
                'userid' => $ret['Id']
                );

            session('_loginuser',$username);

            session('_userid',$ret['Id']);

            session('_userinfoid',$userinfoid);

             $arr['status'] = "loginsucess";
                  echo json_encode($arr); 
        }
    }


    public function out(){

    
        session('_loginuser',null);

        session('_userid',null);

        session('_userinfoid',null);

        session('_shopcartotal',null);

        redirect(U('Index/index'));
    }


    public function verify(){
        verify();
    }
}