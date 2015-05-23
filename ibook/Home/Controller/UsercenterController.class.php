<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";


class UsercenterController extends Controller {

/*构造函数*/
   public function _initialize(){

        common_initial();

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

        redirect(U("Usercenter/myinfo",''));
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

        $user['userid'] = session('_userinfoid');

        $total_publish = count(M('shangpin')->where($user)->select());

        /*超过最大数*/
        if($total_publish >= get_user()['maxsell']){

            session('_over_total',true);

            redirect(U("Usercenter/publishgoods",''));
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


            /*上传过程中有图片*/
            if ($_FILES['image']['error'] === 0) {

                $_hasimage = true;  /*标记为有图片上传*/

                $info = $upload->uploadOne($_FILES['image']);/*处理上传图片*/

                if(!$info) {// 上传错误提示信息        

                    $this->error($upload->getError());

                }
            }
            //dump($info) ;

            $shangpin->description = '<pre><p>'.trim(htmlentities($_POST['description'], ENT_QUOTES)).'</p></pre>';

            $req['stypename'] = $_POST['stype'];

            $req['isnew'] = $_POST['isnew'];

            $stype = D('TypeView')->where($req)->find();

            $stypeid = $stype['stypeid'];

            $shangpin->userid = session('_userinfoid');

            $shangpin->publishdate = time();

            $shangpin->stypeid = $stypeid;  

            $shangpin->duedate = time() + 3600 * 24 * 182;  /*半年*/

            // dump($_hasimage) ;return;

            if( isset($_hasimage) ){    /*有图片*/

                $shangpin->image = $info['savepath'].$info['savename'];

            }else{
                
                $shangpin->image = '/goodsimage/index.jpg';
            }


			if(isset($_hasimage)){   /*有图片上传则处理图片压缩*/

                $tempstring =THINK_PATH;

                $rootpath = substr($tempstring, 0,-9);
            
                $image = new \Think\Image(); 
                
                $image->open($rootpath.'uploads'.$info['savepath'].$info['savename']);

                // 设置比例为240,320的缩略图并覆盖掉原有的图片
                $image->thumb(240,320,\Think\Image::IMAGE_THUMB_FIXED)->save($rootpath.'uploads'.$info['savepath'].$info['savename']);

                /*加水印*/
                $image->water($rootpath.'uploads/uyunshi.png',\Think\Image::IMAGE_WATER_NORTHWEST,70)->save($rootpath.'uploads'.$info['savepath'].$info['savename']); 

                $image->thumb(145, 160,\Think\Image::IMAGE_THUMB_FIXED)->save($rootpath.'uploads'.$info['savepath'].$info['savename']."!145x160");

                $image->thumb(70, 82,\Think\Image::IMAGE_THUMB_FIXED)->save($rootpath.'uploads'.$info['savepath'].$info['savename']."!thumb");
            }
				
            // dump($stype['isnew']);dump($_POST['isnew']);return;

            /*防止刻意修改只能是新品的商品的isnew字段，它的isnew只能为1*/
            if( ($stype['isnew'] != $_POST['isnew']) && $stype['isnew'] ==1 ){   

                $this->error('发布失败-新品类中不允许出现二手商品',U('Usercenter/publishgoods'),3);return;
            }

            if( ($stype['isnew'] != $_POST['isnew']) && $stype['isnew'] ==0 ){   

                $this->error('发布失败-二手类中不允许出现新品商品',U('Usercenter/publishgoods'),3);return;
            }

            if($shangpin->add()){

                $this->success('发布成功',U('Usercenter/haspubpros'),3);return;

            }else{
                
                $this->error('产生未知错误，发布失败',U('Usercenter/publishgoods'),3);return;
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

        redirect(U("Usercenter/publishgoods",''));
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

    if( $newprice < 0 ){
        
        $newprice = 0;
    }

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

            redirect(U("Usercenter/myinfo",''));
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

   redirect(U("Usercenter/myinfo",''));


  // $user->save($sql);
}

/*删除已发布商品*/
public function delpros(){

    $id = $_POST['id'];

    $del['id'] = $id;
    $del['userid'] = session('_userinfoid');

    $shangpin = M('shangpin');

    $img_pos = $shangpin->where($del)->find();

    // return;
    if($shangpin->where($del)->delete()){

        if($img_pos['image'] !='/goodsimage/index.jpg'){

            unlink('./uploads'.$img_pos['image']);

            unlink('./uploads'.$img_pos['image'].'!145x160');

            unlink('./uploads'.$img_pos['image'].'!thumb');
        }

        $data['status']=true;

    }else{
        
        $data['status']=false;
    }
        $this->ajaxReturn($data);

}

/*删除订单*/
public function delorders(){

    if(AJAX){

        $id = I('post.id');

        $del['id'] = $id;

        $del['sid'] = session('_userinfoid');

        if(M('orders')->where($del)->delete()){

            $data['status']=true;

        }else{
            
            $data['status']=false;
        }
        
        $this->ajaxReturn($data);
    }
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
        
        redirect(U("Usercenter/publishgoods"));
    }

}


/*修改头像*/
public function changeavatar(){

    $user = M('avatar')->where('uid='.session('_userinfoid'))->find();

    $this->assign('user',$user);

    $this->assign('cur_changeavatar_active','active');

    $this->assign('cur_changeavatar',true);

    $this->display('index');
}

/*ajax上传头像图片*/
public function ajaxUpload(){

    $upload = new \Think\Upload();// 实例化上传类    

        $upload->maxSize   = 1024*1024*2 ;// 设置附件上传大小 2M

        $upload->exts      = array('jpg','jpeg','png',"JPG","Jpg","PNG","JPEG");// 设置附件上传类型    

        $upload->savePath  = '/avatar/'; // 设置附件上传目录   

        $info = $upload->uploadOne($_FILES['image']);

        if(!$info) {// 上传错误提示错误信息        

            $upload_error =  $upload->getError();

            $arr = array(
                "message" => $upload_error,
                "error_code" => 1,
                "success" => false
            );

        }else{// 上传成功  //dump($info) ;

            session('_temp_avatar_url',$info['savepath'].$info['savename']);
            
            $arr = array(
                "image" => __ROOT__.'/uploads'.$info['savepath'].$info['savename'],
                "message" => "头像保存成功",
                "error_code" => 0,
                "success" => true
            );
        }

        $json = json_encode($arr);
            
        $html = "<textarea data-type=\"application/json\">$json</textarea>";

        echo $html;


}

/*裁剪*/
public function doCropAvatar(){

    if(IS_POST){

       $crop = explode(',',I('crop'));

       // var_dump($crop);

        $tempstring =THINK_PATH;
        
        $rootpath = substr($tempstring, 0,-9);

        $image_url = $rootpath.'uploads'.session("_temp_avatar_url");

        $image = new \Think\Image();
        
        $image->open($image_url);

        $w = $image->width(); // 返回图片的宽度

        $h = $image->height(); // 返回图片的高度

        // echo "$image_url"." \n";

        // echo "图片原始宽度：$w"." \n";

        // echo "图片原始高度：$h"." \n";

        // echo "图片起始位置x: ".$w*$crop[0]." \n";

        // echo "图片起始位置y: ".$h*$crop[1]." \n";

        // echo "宽度：".$w*$crop[2]." \n";

        // echo "高度：".$h*$crop[3]." \n";


        $new_w = $w*$crop[2];
        
        $new_h = $h*$crop[3];
        
        $from_x = $w*$crop[0];
        
        $from_y = $h*$crop[1];

        if($new_w <= 70){

            $arr = array(
                'info' => "图片太小", 
                'status' => 0
            );

            $this->ajaxReturn($arr);
        }

        $image->crop($new_w , $new_h , $from_x , $from_y)->save($image_url);

        $image->thumb(70,70)->save($image_url); /*生成图片大的放前面*/

        $image->thumb(60,60)->save($image_url."!x60");  

        $image->thumb(45,45)->save($image_url."!x45");

        $data['path'] = 'uploads'.session('_temp_avatar_url');

        M('avatar')->where('uid='.session('_userinfoid'))->save($data);

        session('_useravatar',$data['path']);

        session('_temp_avatar_url',null);

        $arr = array(
                    'info' => "图片保存成功", 
                    'status' => 1,
                    'url' => __CONTROLLER__
                );

        $this->ajaxReturn($arr);
        
    }
}


//没用的
public function ok(){   

    utf();
    // session_dump();

    $m = M('userinfo');
    dump( $m->getByUsername("Billowton") );
    echo $m->truename;

    $m->getByUsername("zhan");
    echo $m->truename;
    
    return;



    // $data['path'] = "1";
    // dump(M('avatar')->where('uid='.session('_userinfoid'))->save($data));
    

    $a = preg_split("/,/","hel ,dsfjl,sdfklaf");
    dump($a);

    $tempstring =THINK_PATH;
    $rootpath = substr($tempstring, 0,-9);
    echo "$rootpath";
    echo("<hr/>");

    $sql['uid']=21;
    $sql['sid'] =19;
    dump(M("orders")->where($sql)->order('id desc')->find());

    return;

}

/*下架*/
public function undercarriage(){

    $page = I('get.page');

    $sql['id'] = I('get.id');

    $sql['userid'] = session('_userinfoid');

    $sql['ishandled'] = 1;

    $shangpin = M('shangpin');

    $ret = $shangpin->where($sql)->find();

    if($ret){

        $shangpin->ishandled = -1 ; /*软删除*/

        $shangpin->save();
    }

    redirect(U('Usercenter/haspubpros','page='.$page));
}

/*上架*/
public function upcarriage(){

    $page = I('get.page');

    $sql['id'] = I('get.id');

    $sql['userid'] = session('_userinfoid');

    $shangpin = M('shangpin');

    $ret = $shangpin->where($sql)->find();

    if($ret){

        $shangpin->ishandled = 1 ;  

        $shangpin->save();
    }

    redirect(U('Usercenter/haspubpros','page='.$page));

}


}
