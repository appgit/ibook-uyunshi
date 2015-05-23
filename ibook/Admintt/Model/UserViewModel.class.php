<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class UserViewModel extends ViewModel {

		public $viewFields = array(
		 'Coin'=>array('userid','income','outcome'),  
		'Userinfo'=>array('Id','truename','tel','addr','email','vip','number','_on'=>'Coin.userid=Userinfo.Id'),    
        'Upc'=>array('username','_on'=>'Userinfo.upcid=Upc.Id'), 
	
	);


}