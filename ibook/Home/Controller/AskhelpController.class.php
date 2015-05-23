<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

/*发布求助*/
class AskhelpController extends Controller {

	public function _initialize(){

		common_initial();
	}

	public function index(){

		$list_num = 7;/*每页显示数量*/

		$pages =ceil(count(M('helporder')->select())/$list_num);/*总页数*/          
		$page = intval($_GET['page']);
		$page = $page <= 0 ? 1 : $page;
		$page = $page > $pages ? $pages : $page;

		$helporders = D("HelporderView")->page($page,$list_num)->order('publishdate desc')->select();

		/*分页*/
	 	$this->assign('page',$page);
	 	$this->assign('pages',$pages);
		$this->assign('base_url',__CONTROLLER__.'/index');

		$this->assign('helporders',$helporders);

		$this->display();
	}

	/*发布求助信息*/
	public function help(){

		go_login(); //判断用户有无登录，无则跳到登陆页

		$this->display('help');

		if(session("?_temp_error_askhelp")){

			echo_error(session("_temp_error_askhelp"));

			session("_temp_error_askhelp",null);

		}

	}


	/*处理求助信息*/
	public function handle(){

		go_login(); //判断用户有无登录，无则跳到登陆页

		if(isset($_POST["name"])&&isset($_POST["description"])){

			$name = substr(I('post.name'),0,32*3);	/*限长32位*/

			$desc = substr(I("post.description"),0,200*3);	/*限长200位*/

			$sep_time = 10;/*间隔时间*/

			$lastorder = M('helporder')->where("userid=".session('_userinfoid'))->order('id desc')->find();

			/*小于10分钟*/
			if( time()-$lastorder['publishdate'] <= 60*$sep_time ){

				$left_time = 10-date('i',time()-$lastorder['publishdate']);/*距离发布下一条求助时间*/

				session('_temp_error_askhelp',"oops~ 亲，10分钟之内只能发布一条求助信息哦，".($sep_time-$left_time)."分钟前您刚发布了一条求助信息，请".$left_time."分钟后再试");

				redirect(U("Askhelp/help",'',''));

			}else{

				if($name==''){

					$this->error('亲~请输入求助名称！',U('Askhelp/help'),1);
				}

				$sql['userid'] = session('_userinfoid');
				$sql['name'] = $name;
				$sql['publictel'] = !!$_POST['isopentel'];
				$sql['publishdate'] = time();
				$sql['description'] = $desc == '' ? '无' : $desc;
				$sql['duedate'] = time()+180*24*3600;

				M('helporder')->add($sql);

				$this->success('发布成功',U('Askhelp/index'),1);
			}

		}else{

			redirect(U("Askhelp/help",'',''));
		}

	}

/*更新浏览量*/
	public function updateView(){

		if(IS_AJAX){

			$helporder = M('helporder');

			$ret = $helporder->find(I('post.id'));

			$sql['id'] = $ret['id'];
			$sql['view'] = $ret['view'] + 1;

			$helporder->save($sql);

			if($ret['publictel'] == 0){

				$field_str = 'name,description,email';/*不公开电话*/

			}else{

				$field_str = 'name,description,email,tel';
			}

			$this->ajaxReturn(D('HelporderView')->where('helporder.id='.$ret['id'])->field($field_str)->find());
		
			// echo $helporder->getLastSql();
		}
	}

}