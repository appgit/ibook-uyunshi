<?php 
	namespace Home\Model;
	use Think\Model\ViewModel;
	class UserinfoViewModel extends ViewModel{

	   public $viewFields = array(
	        'userinfo'=>array('id','username','passwd','tel','email','regdate','addr','number','vip','isseller','truename','status','token','token_exptime','lastlogindate','maxsell','signupdate','coin','isqq'), 
	        'avatar'=>array('path'=>'avatar', '_on'=>'avatar.uid=userinfo.id'),
	      );
	}
 ?>
