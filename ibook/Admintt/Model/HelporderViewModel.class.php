<?php
namespace Admintt\Model;
use Think\Model\ViewModel;

class HelporderViewModel extends ViewModel {

		public $viewFields = array(     
     'Helporder'=>array('id','name','publishdate','description'), 
	 'Userinfo'=>array('username','truename','tel','addr','email', '_on'=>'Helporder.userid=Userinfo.Id'),  
	);


}