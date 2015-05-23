<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
require_once MODULE_PATH."Common/common.php";

//商品列表页面
class ProductsController extends Controller {

	public function index(){

		$form_page = $_SERVER['HTTP_REFERER'];


			$list_num = 7;/*每页显示数量*/
			if(session('?_view_grid')){
				
				$list_num = 8;/*宫格布局的每页显示数量*/
			}


		if(isset($_GET['sp'])){	/*传超类*/
			$spname = $_GET['sp'];

			$classify = "btypename";	/*分类列出大类*/
			$classify_name['sptypename'] = $spname;
			$this->assign('which_type','b');
		}

		if(isset($_GET['b'])){	/*传大类*/
			$bname = $_GET['b'];

	 		$classify = "stypename";/*分类列出小类*/
	 		$classify_name['btypename'] = $bname;
	 		$this->assign('which_type','s');
		}

		if(isset($_GET['s'])){	/*传小类*/
			$sname = urldecode($_GET['s']);

			$_sql['stypename'] = $sname;/*where条件*/
			$_btypename = D('TypeView')->where($_sql)->find();

			$classify = "stypename";/*分类列出小类*/
			$classify_name['btypename'] = $_btypename['btypename'];
			$this->assign('which_type','s');
		}

		/*注册分类*/
		$this->assign('classify',D('TypeView')->where($classify_name)->group($classify)->select());
		$this->assign('type_name',$classify);


		if(isset($_GET['wd'])){	/*传搜索关键字*/
			$wd = urldecode($_GET['wd']);
		}

		if(isset($_GET['seller'])){	/*传卖家*/
			$seller = urldecode($_GET['seller']);
		}

		$shangpin = D('ShangpinView');

		// dump($shangpin->select());echo "<hr />";
		if($_GET['type'] == 2){
			session('_isnew',2);
			;/*全部商品*/
			$type_url = '/type/2';
			$this->assign('active_a','active');

		}else{
			if( $_GET['type'] == 1 ){

				$req['isnew'] = 1;	
				$type_url = '/type/1';
				session('_isnew',1);
				$this->assign('active_c','active');

			}else{
				$req['isnew'] = 0;	/*默认值*/
				session('_isnew',0);
				$this->assign('active_b','active');
			}
		}
		
		if(isset($wd)){		/*搜索*/

			$like = '%';
			$searchkey  = preg_split('//u',$wd, -1, PREG_SPLIT_NO_EMPTY);
			foreach ($searchkey as $value) {
				$like.=$value.'%';
			}
			$req['name'] = array('like',$like);
			$wd_url = '/wd/'.$wd;
		}
		else if(isset($seller)){	/*该卖家的其它产品*/

			$req['username'] = $seller;
			$seller_url = '/seller/'.$seller;
		}
		else{		
			if(isset($sname)){		/*查询小类*/
				$req['stype'] = $sname;
				$s_url = '/s/'.$sname;
			}
			else if(isset($bname)){		/*查询大类*/
				$req['btype'] = $bname;
				$b_url = '/b/'.$bname;
			}
			else if(isset($spname)){	/*查询超大类*/

				if ($spname === "__debug") {
					$req = '1';
					$list_num = 9999;
				}else{
					$req['sptype'] = $spname;
				}
				$sp_url = '/sp/'.$spname;
			}
			else{
				$errormsg = "oops~ 没有相应商品... 请从正确入口查看商品 ^_^ ";
			}
		}
		// return;


	if(!isset($errormsg)){

			$req['ishandled'] = 1;
			$pages =ceil(count($shangpin->where($req)->select())/$list_num);/*总页数*/
			
			$page = intval($_GET['page']);
			$page = $page <= 0 ? 1 : $page;
			$page = $page > $pages ? $pages : $page;
			
			$sort = $_GET['sortby'];	/*排序规则*/

			switch ($sort) {
				case 'chat':
					$sort = 'chatcount desc';
					$sortby_url = '/sortby/chat';
					$this->assign('sort_active2','active');
					break;
				case 'price':
					$sort = 'price';
					$sortby_url = '/sortby/price';
					$this->assign('sort_active3','active');
					break;
				case 'latest':
					$sort = 'publishdate desc';
					$sortby_url = '/sortby/latest';
					$this->assign('sort_active4','active');
					break;
				default:
					$sort = 'id';
					$sortby_url = '/sortby/default';
					$this->assign('sort_active1','active');
					break;
			}
			$shangpin = $shangpin->where($req)->page($page,$list_num)->order($sort)->select();

			$this->assign('shangpin',$shangpin);
			// dump($shangpin);

			if(!$shangpin){
				$errormsg = "oops~ 没有该商品 ...";
			}else{
				$this->assign('page',$page);
				$this->assign('pages',$pages);
			}
	}
		/*传搜索关键字、卖家username、超类、大类、小类*/
		$url_argv_base = $wd_url.$seller_url.$sp_url.$b_url.$s_url;

		/*类别按钮*/
		$this->assign('type_url1',__CONTROLLER__.'/index/type/2'.$url_argv_base);
		$this->assign('type_url2',__CONTROLLER__.'/index'.$url_argv_base);
		$this->assign('type_url3',__CONTROLLER__.'/index/type/1'.$url_argv_base);


		if(isset($_GET['page'])){
			$this_page = '/page/'.$page;
		}

		/*加上类别*/
		$url_argv = $type_url.$url_argv_base;

		/*排序按钮的url*/
		$this->assign('sortby_latest',__CONTROLLER__.'/index'.$url_argv.'/sortby/latest'.$this_page);
		$this->assign('sortby_price',__CONTROLLER__.'/index'.$url_argv.'/sortby/price'.$this_page);
		$this->assign('sortby_chat',__CONTROLLER__.'/index'.$url_argv.'/sortby/chat'.$this_page);
		$this->assign('sortby_default',__CONTROLLER__.'/index'.$url_argv.'/sortby/default'.$this_page);

		/*分页除page参数外的url参数*/
		$this->assign('base_url',__CONTROLLER__.'/index'.$url_argv.$sortby_url);
		$this->assign('errormsg',$errormsg);
		$this->display();
	}

// 九宫格布局
	public function grid(){
		if($_SERVER['HTTP_REFERER']!=null){

			if($_GET['show'] == 'true'){
				session('_view_grid',true);
				session('_view_grid_active','active');
			}else{
				session('_view_grid',null);
				session('_view_grid_active',null);
			}
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}else{
			dump('不要走后门');
		}
	}

	public function hot(){
			

		$shangpin = D('ShangpinView');

		$req['status'] = 1;	/*热卖状态*/
		$req['ishandled'] = 1;

		if($_GET['type'] == 2){
			;/*全部商品*/
			$type_url = '/type/2';
			$this->assign('active_a','active');

		}else{
			if( $_GET['type'] == 1 ){

				$req['isnew'] = 1;	
				$type_url = '/type/1';
				$this->assign('active_c','active');

			}else{
				$req['isnew'] = 0;	/*默认值*/
				$this->assign('active_b','active');
			}
		}

			$list_num = 2;/*每页显示数量*/
			
			if(session('?_view_grid')){
				
				$list_num = 8;/*每页显示数量*/
			}

			$pages =ceil(count($shangpin->where($req)->select())/$list_num);/*总页数*/
			
			$page = intval($_GET['page']);
			$page = $page <= 0 ? 1 : $page;
			$page = $page > $pages ? $pages : $page;
			
			$sort = $_GET['sortby'];	/*排序规则*/

			switch ($sort) {
				case 'chat':
					$sort = 'chatcount desc';
					$sortby_url = '/sortby/chat';
					$this->assign('sort_active2','active');
					break;
				case 'price':
					$sort = 'price';
					$sortby_url = '/sortby/price';
					$this->assign('sort_active3','active');
					break;
				case 'latest':
					$sort = 'publishdate desc';
					$sortby_url = '/sortby/latest';
					$this->assign('sort_active4','active');
					break;
				default:
					$sort = 'id';
					$sortby_url = '/sortby/default';
					$this->assign('sort_active1','active');
					break;
			}
			$shangpin = $shangpin->where($req)->page($page,$list_num)->order($sort)->select();

			$this->assign('shangpin',$shangpin);
			// dump($shangpin);

			if(!$shangpin){
				$errormsg = "oops~ 没有该商品 ...";
			}else{
				$this->assign('page',$page);
				$this->assign('pages',$pages);
			}
	
		$url_argv_base = '';

		/*类别按钮*/
		$this->assign('type_url1',__CONTROLLER__.'/hot/type/2'.$url_argv_base);
		$this->assign('type_url2',__CONTROLLER__.'/hot'.$url_argv_base);
		$this->assign('type_url3',__CONTROLLER__.'/hot/type/1'.$url_argv_base);


		if(isset($_GET['page'])){
			$this_page = '/page/'.$page;
		}

		/*加上类别*/
		$url_argv = $type_url.$url_argv_base;

		/*排序按钮的url*/
		$this->assign('sortby_latest',__CONTROLLER__.'/hot'.$url_argv.'/sortby/latest'.$this_page);
		$this->assign('sortby_price',__CONTROLLER__.'/hot'.$url_argv.'/sortby/price'.$this_page);
		$this->assign('sortby_chat',__CONTROLLER__.'/hot'.$url_argv.'/sortby/chat'.$this_page);
		$this->assign('sortby_default',__CONTROLLER__.'/hot'.$url_argv.'/sortby/default'.$this_page);

		/*分页除page参数外的url参数*/
		$this->assign('base_url',__CONTROLLER__.'/hot'.$url_argv.$sortby_url);
		$this->assign('errormsg',$errormsg);
		$this->display('index');
	}

	public function bargin(){

	}


	// 搜索
	public function search(){
		$key = $_GET['searchkey'];

		/*type=2列出全部商品*/
		redirect(U('Products/index',"type=2&wd=$key",''),0,'');
	}


	public function test(){

		dump(D('TypeView')->where(1)->select());return;

		dump($_SESSION);
			$req['ishandled'] = 1;
			$shangpin = D('ShangpinView');
			$ret = $shangpin->field('id,name,chatcount,price')->order('id')->page(1,3)->select();
			$ret = array_sort($ret,'chatcount','desc');
			dump($ret);

	}
}