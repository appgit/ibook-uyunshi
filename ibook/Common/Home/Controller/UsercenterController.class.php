<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";


class UsercenterController extends Controller {

/*构造函数*/
   public function _initialize(){

        go_login(); //判断用户有无登录，无则跳到登陆页

        //判断用户是否是已成为了卖家
        $user = get_user();  

        if($user['isseller'] == 1){

            session('_isseller',true);

            $sql['sid'] = session('_userinfoid');
            $sql['isread'] = 0;

            $this->assign('notread_chat',count(M('orders')->where($sql)->select()));
        }else{
            
            session('_isseller',false);
        }
    }


    public function index(){
        redirect(U("Usercenter/myinfo",'',''));
    }

    public function chatmanage(){

        $this->_if_not_seller();/*还不是卖家，不能访问此操作*/

        $this->assign('cur_chat','active');

        $myorders = D('OrdersView');

        $user['sellerid'] = session('_userinfoid');

        $list_num = 7;/*每页显示数量*/

        $pages =ceil(count($myorders->where($user)->select())/$list_num);/*总页数*/
            
        $page = intval($_GET['page']);
        $page = $page <= 0 ? 1 : $page;
        $page = $page > $pages ? $pages : $page;


        $total_num = count($myorders->where($user)->select());   /*总订单数*/
        /*未读放前面，按时间降序*/
        $orders = $myorders->where($user)->page($page,$list_num)->order('createtime desc')->select();
        $user['isread'] = 0;
        $notread_num = count($myorders->where($user)->select()); /*未读订单数*/
        $this->assign('orders',$orders);
        $this->assign('seller',session('_loginuser'));
        // dump($orders);
        $this->assign('total_num',$total_num);
        $this->assign('notread_num',$notread_num);

        /*分页*/
        $this->assign('page',$page);
        $this->assign('pages',$pages);
        $this->assign('base_url',__CONTROLLER__.'/chatmanage');

        $this->display('index');
    }

    /*发布商品*/
    public function publishgoods(){
        
        if(session('_isseller')==false){
            $this->assign('beseller',true);
        }

        $this->assign('cur_baobei','active');

        $sptype = M('sptype')->select();
        $this->assign('sptype',$sptype);
        $this->display('index');

        if(session('?_temp_error_beseller')){
            echo_error(session('_temp_error_beseller'));
            session('_temp_error_beseller',null);
        }

        if(session('?_over_total')){
            echo_error("Oops~亲，网站暂时只提供最多发布20条商品信息，后期网站进度更新将会通知您。若您现在还想再发布，可以进入已发布宝贝里面先删除几件不重要的商品");
            session('_over_total',null);
        }
        
    }

/*处理发布商品*/
    public function pubpros(){

        $this->_if_not_seller();/*还不是卖家，不能访问此操作*/

      // 同意条款
        // if(!session('?_isseller')){

        //     $uri = T('PublicModule/beseller');

        //     $html = file_get_contents($uri);

        //     $this->ajaxReturn($html);
        // }

        //发布商品


        $user['userid'] = session('_userinfoid');
        $total_publish = count(M('shangpin')->where($user)->select());

        if($total_publish >= get_user()['maxsell']){
            session('_over_total',true);
            redirect(U("Usercenter/publishgoods",'',''));
        }


            $shangpin = D('Shangpin');

            if(!$shangpin->create()){

                session('_publish_cnt',session('_publish_cnt')+1);/*发错一次，计数加1*/

                $this->error($shangpin->getError(),'publishgoods',2);
            }
            $result =  pubproCheck();
            if($result!== true){
                $this->error($result);
            }

            $upload = new \Think\Upload();// 实例化上传类    

            $upload->maxSize   = 1024*1024*2 ;// 设置附件上传大小 2M
            $upload->exts      = array('jpg','jpeg','png',"JPG","Jpg","PNG","JPEG");// 设置附件上传类型    
            $upload->savePath  = '/test/'; // 设置附件上传目录   
            // $upload->saveName = array('date','Y-m-d'); 

            $info = $upload->uploadOne($_FILES['image']);

            if(!$info) {// 上传错误提示错误信息        

                $this->error($upload->getError());
            }else{// 上传成功  //dump($info) ;

                $shangpin->description = '<pre><p>'.trim(htmlentities($_POST['description'], ENT_QUOTES)).'</p></pre>';

                $req['stypename'] = $_POST['stype'];
                $stype = D('TypeView')->where($req)->find();
                // dump($stype);
                $stypeid = $stype['stypeid'];
                $shangpin->userid = session('_userinfoid');
                $shangpin->publishdate = time();
                $shangpin->stypeid = $stypeid;  
                $shangpin->image = $info['savepath'].$info['savename'];
                $shangpin->duedate = time() + 3600 * 24 * 182;

				
				///**压缩图片代码*/
				$tempstring =THINK_PATH;
				$rootpath = substr($tempstring, 0,-9);

				$image = new \Think\Image(); 
				$image->open($rootpath.'uploads'.$info['savepath'].$info['savename']);
				// 按照原图的比例生成一个最大为350*350的缩略图并覆盖掉原有的图片
				$image->thumb(350, 350)->save($rootpath.'uploads'.$info['savepath'].$info['savename']);
				///**压缩图片代码*/
                 $image2 = new \Think\Image(); 
				 // 在图片左上角添加水印（水印文件位于./logo.png） 水印图片的透明度为50 并保存为water.jpg
				 $image2->open($rootpath.'uploads'.$info['savepath'].$info['savename'])->water($rootpath.'uploads/uyunshi.png',\Think\Image::IMAGE_WATER_NORTHWEST,70)->save($rootpath.'uploads'.$info['savepath'].$info['savename']); 
				
				
                // dump($stype['isnew']);dump($_POST['isnew']);return;
                /*防止刻意修改只能是新品的商品的isnew字段，它的isnew只能为1*/
                if( ($stype['isnew'] != $_POST['isnew']) && $stype['isnew'] ==1 ){   

                    $this->error('发布失败-新品类中不允许出现二手商品',U('Usercenter/publishgoods'),3);return;
                }
                if($shangpin->add()){

                    $this->success('发布成功',U('Usercenter/haspubpros'),3);return;
                }else{
                    
                    $this->success('发布失败',U('Usercenter/publishgoods'),3);return;
                }
            }
    }


/*成为卖家*/
    public function beseller(){

        $sql['truename'] = $_POST['truename'];
        $sql['number'] = $_POST['number'];
        $sql['isseller'] = 1;

        if($sql['truename'] == ''|| $sql['number'] == ''){

            session('_temp_error_beseller','请正确输入！');
        }else{

            $user['id'] = session('_userinfoid');

            if(M('userinfo')->where($user)->save($sql)){

            }   
        }

        redirect(U("Usercenter/publishgoods",'',''));
    }

/*个人中心-已发布*/
    public function haspubpros(){

        $this->_if_not_seller();/*还不是卖家，不能访问此操作*/

        $this->assign('cur_haspub','active');

        $pro = D('ShangpinView');

        $userid = session('_userinfoid');

        $req['userid'] =  $userid;

        // echo "$pro_nums";

        /*每页显示数量*/
        $list_num = 7;

        $pages =ceil(count($pro->where($req)->select())/$list_num);/*总页数*/
            
        $page = intval($_GET['page']);
        $page = $page <= 0 ? 1 : $page;
        $page = $page > $pages ? $pages : $page;

        $pro_info = $pro->where($req)->page($page,$list_num)->order('publishdate desc')->select();
        // dump($pro_info);

/*分页*/
        $this->assign('page',$page);
        $this->assign('pages',$pages);
        $this->assign('base_url',__CONTROLLER__.'/haspubpros');


        $this->assign('mypubpros',$pro_info);

        $this->display('index');

    }


/*个人信息*/
    public function myinfo(){
        // dump($_SESSION);return;

        $user = get_user();

        $user['regdate'] = date('Y-m-d',$user['regdate']);

        if(!session('?_lastlogindate')){

            $user['lastlogindate'] = get_datetime($user['lastlogindate']);  //自动登录的情况

        }else{

            if(session('_lastlogindate') == 0){
            
                $user['lastlogindate'] = '没有历史登录信息';
            }else{

                $user['lastlogindate'] = get_datetime(session('_lastlogindate'));
            }
        }
        // dump($user);return;

        $this->assign('myinfo',$user);

        $this->assign('cur_myinfo','active');
        $this->display('index');

        /*来自modifyInfo的错误消息*/
        if(session('?_error_modify')){

            echo_error(session('_error_modify'));
            session('_error_modify',null);
        }
    }

/*修改价格*/
public function modifyPrice(){
    // echo date('h:m:s');return;
    // var_dump($_POST);return;

    $id = $_POST['id'];
    $newprice = $_POST['newprice'];

    /*修改的值是否为数字*/
    if(!is_numeric($newprice)){
        echo "0";return;
    }
    /*修改现价还是原价*/
    $type = $_POST['type'];
    // echo $id;
    $sql['userid'] = session('_userinfoid');
    $sql['id'] = $id;
    $pro = M('shangpin');

    if($pro->where($sql)->find()){
        if($type==0){
            $pro->price = $newprice;
        }else{
            $pro->costprice = $newprice;
        }
        $ret = $pro->where($sql)->save();
    }

    if($ret){
        echo "1";
    }else{
        echo "0";
    }
    // var_dump($_SESSION);
}


public function modifyInfo(){

    $tel = $_POST['tel'];
    $addr = $_POST['addr'];

    if(isset($_POST['qq'])){
        
        $qq = $_POST['qq'];
        $sql['number'] = $qq;
    }
    // $truename = $_POST['truename'];

/*过滤*/

// dump($_POST);return;
    if( $qq ){
        if(!is_numeric( $qq ) ){
            session('_error_modify','请填写正确的qq号码');
            redirect(U("Usercenter/myinfo",'',''));
        }
    }
    if( !is_numeric( $tel ) ){
         session('_error_modify','请填写正确的电话号码');
    }else{
            $sql['tel'] = $tel;
            $sql['addr'] = $addr;
            // $sql['truename'] = $truename;

            $select['id'] = session('_userinfoid');

           $ret = M('userinfo')->where($select)->save($sql);


           if($ret === false){
            // dump(get_user());
            session('_error_modify','oops~ 修改失败了');
           }
    }

   redirect(U("Usercenter/myinfo",'',''));


  // $user->save($sql);
}

/*删除已发布商品*/
public function delpros(){
    $id = $_POST['id'];

    $del['id'] = $id;
    $del['userid'] = session('_userinfoid');

        // return;
    if(M('shangpin')->where($del)->delete()){
        $data['status']=true;
    }else{
        
        $data['status']=false;
    }
        $this->ajaxReturn($data);

}

/*标记为已读*/
public function setHasread(){

    $sql['id'] = $_POST['id'];
    $sql['sid'] = session('_userinfoid');

    $upd['isread'] = 1;
    $data['status'] = 0;
    if(M('orders')->where($sql)->save($upd)){
        $data['status'] = 1;/*成功更改*/
    }
    $this->ajaxReturn($data);


}

    public function verify(){
        verify();
    }

    /*如果还不是卖家*/
    public function _if_not_seller(){

        if(!session('_isseller')){
            
            redirect(U("Usercenter/publishgoods",'',''));
        }

    }

    public function ok(){   //没用的
        utf();
$sql['uid']=21;
$sql['sid'] =19;
dump(M("orders")->where($sql)->order('id desc')->find());

        return;

        dump(get_user());return;

        dump($_SESSION);return;
        $sql['sid'] = 3;dump(D('OrdersView')->where($sql)->select());return;
        dump(D('UserinfoView')->where(1)->select());return;
        echo "<hr/>";
        // dump(get_stypeid());return;
       $shangpin = M('shangpin');

       $data['userid'] = 3;
       $data['count'] = 99;
       $data['publishdate'] = time();
       $data['stypid'] = get_stypeid();
       $data['name'] ='你好';

       // $shangpin->add($data);

       dump($shangpin->select());
       // dump(get_type());
       echo "<hr/>";
       // dump(D('TypeView')->select());

    }


    
}
