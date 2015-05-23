<?php 
	namespace Home\Model;
	use Think\Model\ViewModel;
	class HelporderViewModel extends ViewModel{

	   public $viewFields = array(
	        'userinfo'=>array('id','username','tel','email','regdate','addr','number','vip','isseller','truename','status','lastlogindate','maxsell','signupdate','coin','isqq'), 
	        'avatar'=>array('path'=>'avatar', '_on'=>'avatar.uid=userinfo.id'),
	        'helporder'=>array('id'=>'helporderid','name','description','publishdate','view','publictel','_on'=>'helporder.userid=userinfo.id'),
	      );
	}
 ?>
