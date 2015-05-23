<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class JiaoyiViewModel extends ViewModel {

	public $viewFields = array(     
     'Accountdetail'=>array('id','createtime','transtype','score','desctext','status'),
	  'Userinfo'=>array('truename','tel','_on'=>'Accountdetail.userid=Userinfo.id'),  
	);


}